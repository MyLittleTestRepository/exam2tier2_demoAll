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

//nav
$arNavParams = null;
$arNavigation = null;
if(isset($arParams['NAV_COUNT']) && $arParams['NAV_COUNT']>0)
{
	$arNavParams = ["nPageSize" => $arParams["NAV_COUNT"]];
	$arNavigation = CDBResult::GetNavParams($arNavParams);
	
}

//check params
if(!($arParams['PRODUCTS_IBLOCK_ID']>0 and $arParams['NEWS_IBLOCK_ID']>0 and strlen($arParams['PRODUCTS_LINK_CODE'])>3))
	return;

if($this->StartResultCache(false, [$arNavParams, $arNavigation]))
{
	//get sections
	$arFilter=['ACTIVE'=>'Y',
			   'IBLOCK_ID'=>$arParams['PRODUCTS_IBLOCK_ID'],
			   '!'.$arParams['PRODUCTS_LINK_CODE']=>false
			   ];
	
	$arSelect=['ID',
			   'NAME',
			   $arParams['PRODUCTS_LINK_CODE']
			   ];
	
	$Res=CIBlockSection::GetList('', $arFilter, false, $arSelect, false);
	
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}
	
	while($section=$Res->Fetch())
	{
		$arResult['SECTIONS'][$section['ID']]['NAME']=$section['NAME'];
		foreach($section[$arParams['PRODUCTS_LINK_CODE']] as $newsID)
			$arResult['NEWS'][$newsID]['LINK'][$section['ID']]=$section['ID'];
	}
	
	
	//get news
	$arFilter=['ACTIVE'=>'Y',
			   'IBLOCK_ID'=>$arParams['NEWS_IBLOCK_ID'],
			   'ID'=>array_keys($arResult['NEWS'])
			   ];
	
	$arSelect=['ID',
			   'NAME',
			   'DATE_ACTIVE_FROM'
			   ];
	
	$Res=CIBlockElement::GetList('', $arFilter, false, $arNavParams, $arSelect);
	
	$arResult["NAV_STRING"] = $Res->GetPageNavString('Страница');
	
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}
	
	while($news=$Res->Fetch())
	{
		$arResult['NEWS'][$news['ID']]['NAME']=$news['NAME'];
		$arResult['NEWS'][$news['ID']]['DATE_ACTIVE_FROM']=$news['DATE_ACTIVE_FROM'];
	}
	
	//nav fix links
	if(!empty($arNavParams))
	{
		$arSectionsID=[];
		//удаляем пустые новости
		foreach($arResult['NEWS'] as $newsID=>$news)
			if(isset($news['NAME']))
				foreach($news['LINK'] as $sectionID)
					$arSectionsID[$sectionID]=$sectionID;
			else
				unset($arResult['NEWS'][$newsID]);
		//удаляем лишние секции
		foreach($arResult['SECTIONS'] as $sectionID=>$section)
			if(!in_array($sectionID, $arSectionsID))
				unset($arResult['SECTIONS'][$sectionID]);
	}
	
	//get products
	$arFilter=['ACTIVE'=>'Y',
			   'IBLOCK_ID'=>$arParams['PRODUCTS_IBLOCK_ID'],
			   'SECTION_ID'=>array_keys($arResult['SECTIONS'])
			   ];
	
	$arSelect=['ID',
			   'NAME',
			   'IBLOCK_SECTION_ID',
			   'PROPERTY_PRICE',
			   'PROPERTY_MATERIAL',
			   'PROPERTY_ARTNUMBER',
			   ];
	
	$Res=CIBlockElement::GetList('', $arFilter, false, false, $arSelect);
	
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}
	
	while($product=$Res->Fetch())
	{
		$id=$product['ID'];
		$arResult['SECTIONS'][$product['IBLOCK_SECTION_ID']]['ITEMS'][$id]=$id;
		foreach($product as $key=>$val)
			if(substr($key,-2,2)=='ID')
				unset($product[$key]);
		$arResult['PRODUCTS'][$id]=$product;
	}
	
	if(count($arResult['PRODUCTS'])>0)
		{
			$arResult['COUNT']=count($arResult['PRODUCTS']);
			$this->setResultCacheKeys(['COUNT']);
		}
	
	$this->includeComponentTemplate();
}

if(!empty($arResult['COUNT']))
	$APPLICATION->SetTitle(GetMessage("TITLE").$arResult['COUNT']);