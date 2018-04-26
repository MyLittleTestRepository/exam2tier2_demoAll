<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

//check user auth
if(!$USER->IsAuthorized())
	return;

//clear params
foreach($arParams as $key=>$val)
{
	$val=trim($val);
	if(is_numeric($val))
		$val=intval($val);
	$arParams[$key]=$val;
}

//check params
if(!((is_numeric($arParams['NEWS_IBLOCK_ID']) and $arParams['NEWS_IBLOCK_ID']>0)
and (is_string($arParams['NEWS_LINK_CODE']) and strlen($arParams['NEWS_LINK_CODE'])>0)
and (is_string($arParams['UF_CODE']) and strlen($arParams['UF_CODE'])>0)))
	return;

$myID=$USER->GetID();
//start cache
if($this->StartResultCache(false,$myID))
{
	//get my type
	$arFilter=['ACTIVE'=>'Y',
			   'ID'=>$myID,
			   '!'.$arParams['UF_CODE']=>false,
			   ];
	
	$arSelect=[];
	$arSelect['SELECT']=[$arParams['UF_CODE']];
	$arSelect['FIELDS']=['ID','LOGIN'];
	
	$Res=$USER->GetList($by = "id",$order = "asc",$arFilter,$arSelect);
	
	if($Res->SelectedRowsCount()<1)
	{
		$this->AbortResultCache();
		return;
	}
	
	$myType=$Res->Fetch()[$arParams['UF_CODE']];
	
	
	//get all my type authors
	$arFilter=['ACTIVE'=>'Y',
			   $arParams['UF_CODE']=>$myType,
			   ];
	
	$arSelect=[];
	$arSelect['FIELDS']=['ID','LOGIN'];
	
	$Res=$USER->GetList($by = "id",$order = "asc",$arFilter,$arSelect);
	
	if($Res->SelectedRowsCount()<1)
	{
		$this->AbortResultCache();
		return;
	}
	
	while($user=$Res->Fetch())
		$arResult['USER'][$user['ID']]=$user;
	
	
	//get news for this user
	$arFilter=['ACTIVE'=>'Y',
			   'PROPERTY_'.$arParams['NEWS_LINK_CODE']=>array_keys($arResult['USER']),
			   ];
	
	$arSelect=['ID',
			   'NAME',
			   'DATE_ACTIVE_FROM',
			   'IBLOCK_ID'];

	$Res=CIBlockElement::GetList(array('id'=>'asc'),$arFilter,false,false,$arSelect);
	
	if($Res->SelectedRowsCount()<1)
	{
		$this->AbortResultCache();
		return;
	}

	while($news=$Res->GetNextElement(true,false))
	{
		$fields=$news->GetFields();		
		
		//set fields
		$arResult['NEWS'][$fields['ID']]=$fields;
		
		$arAuthors=$news->GetProperty($arParams['NEWS_LINK_CODE'])['VALUE'];

		if(in_array($myID, $arAuthors))
			continue;
		
		//set link
		foreach($arAuthors as $userID)
		{
			if(empty($arResult['USER'][$userID]['ID']))
				continue;
			
			$arResult['USER'][$userID]['NEWS'][$fields['ID']]=$fields['ID'];
		}
	}
	
	unset($arResult['USER'][$myID]);

	//news count
	if(count($arResult['NEWS'])>0)
		$arResult['COUNT']=count($arResult['NEWS']);

	$this->setResultCacheKeys(['COUNT']);
	$this->includeComponentTemplate();
}
//end cache
if(!empty($arResult['COUNT']))
	$APPLICATION->SetTitle(GetMessage('COUNT').$arResult['COUNT']);