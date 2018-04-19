<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"PARENT"=>"BASE",
			"NAME" => GetMessage("PRODUCTS_IBLOCK_ID"),
			"TYPE" => "STRING",
			"DEFAULT"=>"2"
		),
		"FIRMS_IBLOCK_ID" => array(
			"PARENT"=>"BASE",
			"NAME" => GetMessage("FIRMS_IBLOCK_ID"),
			"TYPE" => "STRING",
			"DEFAULT"=>"7"
		),
		"PRODUCTS_LINK_CODE" => array(
			"PARENT"=>"BASE",
			"NAME" => GetMessage("PRODUCTS_LINK_CODE"),
			"TYPE" => "STRING",
			"DEFAULT"=>"FIRMS"
		),
		"DETAIL_URL_TEMPLATE" => array(
			"PARENT"=>"BASE",
			"NAME" => GetMessage("DETAIL_URL_TEMPLATE"),
			"TYPE" => "STRING",
			"DEFAULT"=>"?id=#ELEMENT_ID#"
		),
		"CACHE_TIME" => array(
			"DEFAULT"=>"3600000"
		),
	),
);