<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?if(empty($arResult))
	return;?>
<ul>
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
					<li>
						<?=$arResult['PRODUCTS'][$productID]['NAME']?>
						- <?=$arResult['PRODUCTS'][$productID]['PROPERTY_PRICE_VALUE']?>
						- <?=$arResult['PRODUCTS'][$productID]['PROPERTY_MATERIAL_VALUE']?>
						- <?=$arResult['PRODUCTS'][$productID]['PROPERTY_ARTNUMBER_VALUE']?>
						(<a href="<?=$arResult['PRODUCTS'][$productID]['DETAIL_PAGE_URL']?>">
							<?=$arResult['PRODUCTS'][$productID]['DETAIL_PAGE_URL']?>
						 </a>)
					</li>
				<?endforeach?>
			<?endforeach?>
		</ul>
	</li>
<?endforeach?>
</ul>