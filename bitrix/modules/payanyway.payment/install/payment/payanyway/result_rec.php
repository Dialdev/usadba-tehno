<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// this is for Pay Url script only
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

$bCorrectPayment = true;
$changePayStatus = false;
$responseCode = 500;
$arOrder = null;

$MNT_TRANSACTION_ID = $_REQUEST['MNT_TRANSACTION_ID'];
$mntPaymentId = 0;
if (strpos($MNT_TRANSACTION_ID, "_") !== false) {
    $transactionIdArray = explode("_", $MNT_TRANSACTION_ID);
    $MNT_TRANSACTION_ID = intval($transactionIdArray[0]);
    $mntPaymentId = intval($transactionIdArray[1]);
}

/* orderId для старой схемы оформления заказа */
if (!($arOrder = CSaleOrder::GetByID(IntVal($MNT_TRANSACTION_ID))) &&
    !($arOrder = CSaleOrder::GetByID(IntVal($_REQUEST['orderId']))))
{
    $bCorrectPayment = false;
}

if ($arOrder) {
    CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);
}

if ($bCorrectPayment) {
    if (isset($_REQUEST['MNT_ID']) && isset($_REQUEST['MNT_TRANSACTION_ID']) && isset($_REQUEST['MNT_AMOUNT']) && isset($_REQUEST['MNT_CURRENCY_CODE']) && isset($_REQUEST['MNT_TEST_MODE']) && isset($_REQUEST['MNT_SIGNATURE']))  {
        if (_checkSignature()) {
            $amount = (float) $_REQUEST['MNT_AMOUNT'];
            if ( !isset($_REQUEST['MNT_COMMAND']) ) {
                $arFields = array(
                    "PS_STATUS" => "Y",
                    "PS_STATUS_CODE" => "200",
                    "PS_STATUS_DESCRIPTION" => "",
                    "PS_STATUS_MESSAGE" => GetMessage('PAYANYWAY_PAYMENT_CONFIRMED'),
                    "PS_SUM" => $_REQUEST['MNT_AMOUNT'],
                    "PS_CURRENCY" => $_REQUEST['MNT_CURRENCY_CODE'],
                    "PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
                );

                $useSeparatePay = false;
                // check class \Bitrix\Sale\Order for old versions of sale module
                if ($mntPaymentId > 0 && class_exists('\Bitrix\Sale\Order')) {
                    $orderId = $arOrder["ID"];
                    /** @var \Bitrix\Sale\Order $order */
                    $order = \Bitrix\Sale\Order::load($orderId);
                    if ($order === null)
                    {
                        $data = \Bitrix\Sale\Internals\OrderTable::getRow(array(
                            'select' => array('ID'),
                            'filter' => array('ACCOUNT_NUMBER' => $orderId)
                        ));
                        $order = \Bitrix\Sale\Order::load($data['ID']);
                        $orderId = $data['ID'];
                    }

                    $payment = $order->getPaymentCollection()->getItemById($mntPaymentId);
                    if ($payment) {
                        CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"], '', array(), $payment->getFieldValues());
                        $aDesc = array(
                            "In Process" => array(GetMessage("SASP_IP"), GetMessage("SASPD_IP")),
                            "Delayed" => array(GetMessage("SASP_D"), GetMessage("SASPD_D")),
                            "Approved" => array(GetMessage("SASP_A"), GetMessage("SASPD_A")),
                            "PartialApproved" => array(GetMessage("SASP_PA"), GetMessage("SASPD_PA")),
                            "PartialDelayed" => array(GetMessage("SASP_PD"), GetMessage("SASPD_PD")),
                            "Canceled" => array(GetMessage("SASP_C"), GetMessage("SASPD_C")),
                            "PartialCanceled" => array(GetMessage("SASP_PC"), GetMessage("SASPD_PC")),
                            "Declined" => array(GetMessage("SASP_DEC"), GetMessage("SASPD_DEC")),
                            "Timeout" => array(GetMessage("SASP_T"), GetMessage("SASPD_T")),
                        );

                        $payment->setField('PAID', 'Y');
                        $order->save();
                        $useSeparatePay = true;
                        // get order data
                        $getArrOrder = CSaleOrder::GetByID($orderId);
                        // https://dev.1c-bitrix.ru/api_help/sale/classes/csaleorder/csaleorder__getbyid.5cbe0078.php
                        if (is_array($getArrOrder)) {
                            // add a new transaction to Bitrix
                            $arTransaction = array(
                                'USER_ID' => $getArrOrder['USER_ID'],
                                'AMOUNT' => $_REQUEST['MNT_AMOUNT'],
                                'CURRENCY' => $_REQUEST['MNT_CURRENCY_CODE'],
                                'DEBIT' => 'Y',
                                'DESCRIPTION' => '(PayAnyWay) moneta.ru operation ID: ' . $_REQUEST['MNT_OPERATION_ID'],
                                'ORDER_ID' => $getArrOrder['ID'],
                                'EMPLOYEE_ID' => $getArrOrder['RESPONSIBLE_ID'],
                                'TRANSACT_DATE' => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)))
                            );
                            // https://dev.1c-bitrix.ru/api_help/sale/classes/csaleusertransact/csaleusertransact.add.php
                            CSaleUserTransact::Add($arTransaction);
                        }
                    }
                }

                CSaleOrder::Update($arOrder["ID"], $arFields);
                CSaleOrder::PayOrder($arOrder["ID"], "Y");
                if ( !$useSeparatePay || (isset($GLOBALS["SALE_CORRESPONDENCE"]["CHANGE_ORDER_STATUS"]["VALUE"]) && $GLOBALS["SALE_CORRESPONDENCE"]["CHANGE_ORDER_STATUS"]["VALUE"] == 'Y') ) {
                    CSaleOrder::StatusOrder($arOrder["ID"], "P");
                }

                // SUCCESS
                $responseCode = 200;
                $changePayStatus = true;
            }
            else {
                switch($_REQUEST['MNT_COMMAND']) {
                    case "CHECK":
                        if ($arOrder["CANCELED"] == "Y" || $arOrder["PAYED"] == "Y")
                            $responseCode = 500;
                        else
                            $responseCode = 402;
                        break;
                    case "CANCELLED_CREDIT":
                        // отмена зачисления
                        if (CSaleOrder::CancelOrder($arOrder["ID"], "Y", GetMessage('PAYANYWAY_PAYMENT_CANCELED')))
                            $responseCode = 200;
                        break;
                    default:
                        $responseCode = 200;
                        break;
                }
            }
        }
    }
}

$APPLICATION->RestartBuffer();

header("Content-type: application/xml");
echo _getXMLResponse($responseCode);
// some users trying to show footer in the /result.php
// do exit for all of them
exit;

function _checkSignature() {
	$params = '';
	if (isset($_REQUEST['MNT_COMMAND'])) $params .= $_REQUEST['MNT_COMMAND'];
	$params .= $_REQUEST['MNT_ID'] . $_REQUEST['MNT_TRANSACTION_ID'];
	if (isset($_REQUEST['MNT_OPERATION_ID'])) $params .= $_REQUEST['MNT_OPERATION_ID'];
	if (isset($_REQUEST['MNT_AMOUNT'])) $params .= $_REQUEST['MNT_AMOUNT'];
	$params .= $_REQUEST['MNT_CURRENCY_CODE'];
	if (isset($_REQUEST['MNT_SUBSCRIBER_ID'])) $params .= $_REQUEST['MNT_SUBSCRIBER_ID'];
	$params .= $_REQUEST['MNT_TEST_MODE'];
	$signature = md5($params . CSalePaySystemAction::GetParamValue("DATA_INTEGRITY_CODE", ""));
	if (strcasecmp($signature, $_REQUEST['MNT_SIGNATURE'] ) == 0) {
		return true;
	}
	return false;
}

function _getXMLResponse($resultCode)
{
	$signature = md5($resultCode . $_REQUEST['MNT_ID'] . $_REQUEST['MNT_TRANSACTION_ID'] . CSalePaySystemAction::GetParamValue("DATA_INTEGRITY_CODE", ""));
	$result = '<?xml version="1.0" encoding="UTF-8" ?>';
	$result .= '<MNT_RESPONSE>';
	$result .= '<MNT_ID>' . $_REQUEST['MNT_ID'] . '</MNT_ID>';
	$result .= '<MNT_TRANSACTION_ID>' . $_REQUEST['MNT_TRANSACTION_ID'] . '</MNT_TRANSACTION_ID>';
	$result .= '<MNT_RESULT_CODE>' . $resultCode . '</MNT_RESULT_CODE>';
	$result .= '<MNT_SIGNATURE>' . $signature . '</MNT_SIGNATURE>';
	$result .= '</MNT_RESPONSE>';
	return $result;
}
