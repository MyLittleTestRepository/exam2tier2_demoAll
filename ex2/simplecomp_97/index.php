<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 97");
?><?$APPLICATION->IncludeComponent(
	"custom:simplecomp_97.exam", 
	".default", 
	array(
		
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>