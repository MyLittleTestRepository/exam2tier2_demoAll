<?
AddEventHandler('iblock','OnBeforeIBlockElementUpdate',['MyEventHandler','cancelDeactivate']);

class MyEventHandler
{
	function cancelDeactivate(&$arFields)
	{
		if($arFields['IBLOCK_ID']!=PRODUCTS_IBLOCK_ID)
			return;
		
		if($arFields['ACTIVE']!='N')
			return;
		
		if(!CModule::IncludeModule('iblock'))
			return;
		
		$Res=CIBlockElement::GetList('',['IBLOCK_ID'=>$arFields['IBLOCK_ID'],
										 'ID'=>$arFields['ID'],
										 'ACTIVE'=>'Y'],false,false,['SHOW_COUNTER']);
		
		if(!$Res->SelectedRowsCount())
			return;
		
		$showCounter=$Res->Fetch()['SHOW_COUNTER'];
		if($showCounter<=2)
			return;
		
		global $APPLICATION;
		$APPLICATION->ThrowException('Товар невозможно деактивировать, у него '.$showCounter.' просмотров'); 
		return false;
	}
}