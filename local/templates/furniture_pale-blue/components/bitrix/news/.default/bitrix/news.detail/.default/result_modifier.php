<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(is_numeric($arParams['CAN_IBLOCK_ID']) and $arParams['CAN_IBLOCK_ID']>0)
{
	$Res=CIBlockElement::GetList('',['ACTIVE'=>'Y',
									'IBLOCK_ID'=>$arParams['CAN_IBLOCK_ID'],
									'PROPERTY_LINK'=>$arParams['ELEMENT_ID']
									],false,false,['NAME']);
	if($Res->SelectedRowsCount())
	{
		$arResult['CANONICAL']=$Res->Fetch()['NAME'];
		$this->__component->setResultCacheKeys(['CANONICAL']);
	}
}

//ajax
$arResult['REPORT_URL']=$APPLICATION->GetCurPage().'?report';

if($arParams['AJAX_REPORT'] == 'Y')
	$arResult['REPORT_URL'] = 'javascript:void(0)';