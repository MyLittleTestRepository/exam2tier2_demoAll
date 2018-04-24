<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p>Фильтр: <a href="<?=$APPLICATION->GetCurDir().'?F'?>"><?=$APPLICATION->GetCurDir().'?F'?></a></p>
<p>Время кэша: <?=date('H:i:s')?></p>
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
						<?=implode(' - ',$arResult['PRODUCTS'][$productID])?>
					</li>
				<?endforeach?>
			<?endforeach?>
		</ul>
	</li>
<?endforeach?>
</ul>