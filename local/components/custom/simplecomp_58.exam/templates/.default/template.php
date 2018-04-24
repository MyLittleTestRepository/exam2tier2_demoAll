<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?if(empty($arResult))
	return;?>
<ul><?$count=0?>
<?foreach($arResult['NEWS'] as $newsID=>$news):?>
	<li>
		<?$sectionsNames=[]?>
		<?foreach($news['LINK'] as $sectionID):?>
			<?$sectionsNames[]=$arResult['SECTIONS'][$sectionID]['NAME']?>
		<?endforeach?>
		<b><?=$news['NAME']?></b> - <?=$news['DATE_ACTIVE_FROM']?> (<?=implode(', ',$sectionsNames)?>)
		<ul>
			<?foreach($news['LINK'] as $sectionID):?>
				<?foreach($arResult['SECTIONS'][$sectionID]['ITEMS'] as $productID):?>
				<?$count++;
				$this->AddEditAction($productID+$count, $arResult['PRODUCTS'][$productID]['ADD_LINK'],
									 CIBlock::GetArrayByID($arResult['PRODUCTS'][$productID]["IBLOCK_ID"], "ELEMENT_ADD"));
				$this->AddEditAction($productID+$count, $arResult['PRODUCTS'][$productID]['EDIT_LINK'],
									 CIBlock::GetArrayByID($arResult['PRODUCTS'][$productID]["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($productID+$count, $arResult['PRODUCTS'][$productID]['DELETE_LINK'],
									   CIBlock::GetArrayByID($arResult['PRODUCTS'][$productID]["IBLOCK_ID"], "ELEMENT_DELETE"),
									   array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<li id="<?=$this->GetEditAreaId($productID+$count);?>">
						<?=$arResult['PRODUCTS'][$productID]['NAME']?>
						- <?=$arResult['PRODUCTS'][$productID]['PROPERTY_PRICE_VALUE']?>
						- <?=$arResult['PRODUCTS'][$productID]['PROPERTY_MATERIAL_VALUE']?>
						- <?=$arResult['PRODUCTS'][$productID]['PROPERTY_ARTNUMBER_VALUE']?>
					</li>
				<?endforeach?>
			<?endforeach?>
		</ul>
	</li>
<?endforeach?>
</ul>