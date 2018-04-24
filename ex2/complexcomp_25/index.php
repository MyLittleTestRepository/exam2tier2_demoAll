<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Комплексный компонент 25");
?><?$APPLICATION->IncludeComponent(
	"custom:complexcomp_25.exam", 
	".default", 
	array(
		
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>