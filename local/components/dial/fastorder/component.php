<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Config\Option,
	Bitrix\Sale,
	Bitrix\Sale\Order,
	Bitrix\Main\Application,
	Bitrix\Sale\DiscountCouponsManager;
if (!Loader::IncludeModule('sale'))
	die();
if (!Loader::IncludeModule('catalog'))
	die();
global $USER, $APPLICATION;

$sid = Bitrix\Main\Context::getCurrent()->getSite();
$currencyCode = Option::get('sale', 'default_currency', 'RUB');



if ($_POST['ajax-fastorder'] && isset($_POST['id'])) {
	$APPLICATION->RestartBuffer();
	if (!$USER->IsAuthorized()) {
		$rsUser = CUser::GetByLogin($_POST['email']);
		if ($arUser = $rsUser->Fetch()) {
			$user_id = $arUser["ID"];
		} else {
			$CUser = new CUser;
			$names = explode(' ', $_POST['name']);
			$password = randString(8);
			$arFields = array(
				"LOGIN" => $_POST['email'],
				"EMAIL" => $_POST['email'],
				"LAST_NAME" => $names[0],
				"NAME" => $names[1],
				"SECOND_NAME" => $names[2],
				"PERSONAL_PHONE" => $_POST['phone'],
				"PASSWORD" => $password,
				"CONFIRM_PASSWORD" => $password,
				"GROUP_ID" => array(5)
			);
			$user_id = $CUser->Add($arFields);
			if (intval($user_id) > 0) {
				$result['success'][] = 'Для проверки статуса заказа для Вас создан аккаунт. Логин: '.$_POST['email'].', пароль - '.$password.'.';
			} else {
				$result['errors'][] = 'Ошибка: '.$CUser->LAST_ERROR;
			}
		}
	} else {
		$user_id = $USER->GetID();
	}
	if (intval($user_id) > 0) {
		// CModule::IncludeModule("catalog");
		// CModule::IncludeModule("sale");
		// $arFields = array(
			// "LID" => SITE_ID,
			// "PERSON_TYPE_ID" => 1,
			// "USER_ID" => $user_id,
			// "CURRENCY" => CSaleLang::GetLangCurrency(SITE_ID),
			// "USER_DESCRIPTION" => isset($_POST['email']) ? 'ФИО: '.$_POST['name'].'; E-mail: '.$_POST['email'].'; Телефон: '.$_POST['phone'].'; Комментарии: '.$_POST['comments'] : $_POST['comments']
		// );

		//CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
		//Add2BasketByProductID($_POST['id'], $_POST['quantity']);
        //$ORDER_ID = CSaleOrder::Add($arFields);
		//CSaleBasket::OrderBasket($ORDER_ID);
		
		
	$rsUser = CUser::GetByID($user_id);
	$arUser = $rsUser->Fetch();
	$id = $_POST['id'];
	$quantity = $_POST['quantity'];
	

		
		
		
		
		$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), $sid);

		if ($item = $basket->getExistsItem('catalog', $id)) {
			$item->setField('QUANTITY', $item->getQuantity() + $quantity);
		} else {
			$item = $basket->createItem('catalog', $id);
			$item->setFields(array(
				'QUANTITY' => $quantity,
				'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
				'LID' => $sid,
				'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
			));
		}
		$basket->save();
		$order = Order::create($sid, $user_id);
		$order->setPersonTypeId(1);
		$basket = Sale\Basket::loadItemsForFUser(\CSaleBasket::GetBasketUserID(), $sid)->getOrderableItems();

		$order->setBasket($basket);

		/*Shipment*/
		$shipmentCollection = $order->getShipmentCollection();
		$shipment = $shipmentCollection->createItem();
		$shipment->setFields(array(
			'DELIVERY_ID' => 2,
			'DELIVERY_NAME' => 'Самовывоз',
			'CURRENCY' => $order->getCurrency()
		));


		$shipmentItemCollection = $shipment->getShipmentItemCollection();

		foreach ($order->getBasket() as $item)
		{
			$shipmentItem = $shipmentItemCollection->createItem($item);
			$shipmentItem->setQuantity($item->getQuantity());
		}


		/*Payment*/
		$paymentCollection = $order->getPaymentCollection();
		$extPayment = $paymentCollection->createItem();
		$extPayment->setFields(array(
			'PAY_SYSTEM_ID' => 1,
			'PAY_SYSTEM_NAME' => 'Наличный расчет',
			'SUM' => $order->getPrice()
		));

		/**/
		$order->doFinalAction(true);

		$propertyCollection = $order->getPropertyCollection();

		$propertyCollection = $order->getPropertyCollection();


		foreach ($propertyCollection->getGroups() as $group)
		{

			foreach ($propertyCollection->getGroupProperties($group['ID']) as $property)
			{

				$p = $property->getProperty();
				if( $p["CODE"] == "FIO")	$property->setValue($arUser['NAME']);
				if( $p["CODE"] == "PHONE")	$property->setValue($arUser['PERSONAL_PHONE']);

			}
		}



		$order->setField('CURRENCY', $currencyCode);
		$order->setField('COMMENTS', 'Заказ в 1 клик. ');
		$order->save();
		$ORDER_ID = $order->GetId();
		
		
		$result['success'][] = 'Ваш заказ принят, его номер - '.$ORDER_ID.'. Менеджер свяжется с вами в ближайшее время.';
	}
	echo json_encode($result, JSON_UNESCAPED_UNICODE);
	die();
}
$this->IncludeComponentTemplate();