<?
AddEventHandler('iblock','OnBeforeIBlockElementUpdate',['MyEventHandler','cancelDeactivate']);
AddEventHandler('main','OnBeforeEventAdd',['MyEventHandler','replaceFeedbackAuthor']);

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
	
	function replaceFeedbackAuthor(&$event, &$lid, &$arFields, &$message_id)
	{
		if($event!='FEEDBACK_FORM')
			return;
		
		global $USER;
		if($USER->IsAuthorized())
			$arFields['AUTHOR']='Пользователь авторизован: '.$USER->GetID().' ('.$USER->GetLogin().') '
			.$USER->GetFirstName().', данные из формы: '.$arFields['AUTHOR'];
		else
			$arFields['AUTHOR']='Пользователь не авторизован, данные из формы: '.$arFields['AUTHOR'];
		
		CEventLog::Log('INFO', 'FEEDBACK_FORM', 'main', 'replace', 'Замена данных в отсылаемом письме - '.$arFields['AUTHOR']);
	}
}