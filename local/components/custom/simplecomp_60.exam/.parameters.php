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
		"NEWS_IBLOCK_ID" => array(
			"PARENT"=>"BASE",
			"NAME" => GetMessage("NEWS_IBLOCK_ID"),
			"TYPE" => "STRING",
			"DEFAULT"=>"1"
		),
		"PRODUCTS_LINK_CODE" => array(
			"PARENT"=>"BASE",
			"NAME" => GetMessage("PRODUCTS_LINK_CODE"),
			"TYPE" => "STRING",
			"DEFAULT"=>"UF_NEWS_LINK"
		),
		"NAV_COUNT" => array(
			"PARENT"=>"BASE",
			"NAME" => GetMessage("NAV_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT"=>"1"
		),
		"CACHE_TIME" => array(
			"DEFAULT"=>"3600000"
		),
	),
);