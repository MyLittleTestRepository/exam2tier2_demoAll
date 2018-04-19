<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?if(empty($arResult))
	return;?>
<ul>
<?foreach($arResult['FIRM'] as $firmID=>$firm):?>
	<li>
		<b><?=$firm['NAME']?></b>
		<ul>
			<?foreach($firm['LINK'] as $productID):?>
				<li>
					<?=$arResult['PRODUCTS'][$productID]['NAME']?>
					<?=' - '.$arResult['PRODUCTS'][$productID]['PROPERTY']['PRICE']['VALUE']?>
					<?=' - '.$arResult['PRODUCTS'][$productID]['PROPERTY']['MATERIAL']['VALUE']?>
					<?=' - '.$arResult['PRODUCTS'][$productID]['PROPERTY']['ARTNUMBER']['VALUE']?>
					(<a href="<?=$arResult['PRODUCTS'][$productID]['DETAIL_PAGE_URL']?>">
					<?=$arResult['PRODUCTS'][$productID]['DETAIL_PAGE_URL']?></a>)
				</li>
			<?endforeach?>
		</ul>
	</li>
<?endforeach?>
</ul>