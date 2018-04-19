<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

//clear params
foreach($arParams as $key=>$val)
{
	$val=trim($val);
	if(is_numeric($val))
		$val=intval($val);
	$arParams[$key]=$val;
}

//check params
if(!(is_numeric($arParams['PRODUCTS_IBLOCK_ID']) and $arParams['PRODUCTS_IBLOCK_ID']>0
	 and is_numeric($arParams['FIRMS_IBLOCK_ID']) and $arParams['FIRMS_IBLOCK_ID']>0
	 and is_string($arParams['PRODUCTS_LINK_CODE']) and strlen($arParams['PRODUCTS_LINK_CODE'])>0))
	return;

if($this->StartResultCache(false,$USER->GetUserGroupString()))
{
	
	//get linked products
	$arFilter=['ACTIVE'=>'Y',
			   'IBLOCK_ID'=>$arParams['PRODUCTS_IBLOCK_ID'],
			   '!PROPERTY_'.$arParams['PRODUCTS_LINK_CODE']=>false
			   ];
	
	$arSelect=['ID',
			   'NAME',
			   'DETAIL_PAGE_URL',
			   ];
	
	$Res=CIBlockElement::GetList( '', $arFilter, false, false, $arSelect);
	
	$Res->SetUrlTemplates($arParams['DETAIL_URL_TEMPLATE']);
	
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}

	while($item=$Res->GetNextElement(true,false))
	{
		$fields=$item->GetFields();
		$arResult['PRODUCTS'][$fields['ID']]=$fields;
		$arResult['PRODUCTS'][$fields['ID']]['PROPERTY']=$item->GetProperties();
		if(is_array($arResult['PRODUCTS'][$fields['ID']]['PROPERTY'][$arParams['PRODUCTS_LINK_CODE']]['VALUE']))
			foreach($arResult['PRODUCTS'][$fields['ID']]['PROPERTY'][$arParams['PRODUCTS_LINK_CODE']]['VALUE'] as $firmID)
					$arResult['FIRM'][$firmID]['LINK'][$fields['ID']]=$fields['ID'];
		else
		{
			$firmID=$arResult['PRODUCTS'][$fields['ID']]['PROPERTY'][$arParams['PRODUCTS_LINK_CODE']]['VALUE'];
			$arResult['FIRM'][$firmID]=$firmID;
		}
	}

	
	//get firm for links
	$arFilter=['ACTIVE'=>'Y',
			   'IBLOCK_ID'=>$arParams['FIRMS_IBLOCK_ID'],
			   'ID'=>array_keys($arResult['FIRM']),
			   ];
	
	$arSelect=['ID',
			   'NAME',
			   ];
	
	$Res=CIBlockElement::GetList( '', $arFilter, false, false, $arSelect);
		
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}

	while($item=$Res->Fetch())
		$arResult['FIRM'][$item['ID']]=array_merge($item,$arResult['FIRM'][$item['ID']]);

	if(count($arResult['FIRM'])>0)
		{
			$arResult['COUNT']=count($arResult['FIRM']);
			$this->setResultCacheKeys(['COUNT']);
		}
	
	$this->includeComponentTemplate();
}

if(!empty($arResult['COUNT']))
	$APPLICATION->SetTitle(GetMessage('COUNT').$arResult['COUNT']);