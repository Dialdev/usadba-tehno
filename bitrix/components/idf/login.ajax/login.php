<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;

$arAuthResult = $USER->Login($_POST['login'], $_POST['password']);

if (!empty($arAuthResult['MESSAGE'])) 
{
	print_r($arAuthResult['MESSAGE']);	
}
else
{
	echo "ok";
}
?>