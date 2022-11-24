<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"personal_link" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("personal_link"),
			"TYPE" => "STRING",
			'DEFAULT' => '/personal/'
		),
	)
);		