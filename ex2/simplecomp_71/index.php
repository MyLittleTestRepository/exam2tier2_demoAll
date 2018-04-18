<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 71");
?><?$APPLICATION->IncludeComponent(
	"custom:simplecomp_71.exam", 
	".default", 
	array(
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>