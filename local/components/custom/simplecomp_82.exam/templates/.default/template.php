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
						<?=implode(' - ',$arResult['PRODUCTS'][$productID])?>
					</li>
				<?endforeach?>
			<?endforeach?>
		</ul>
	</li>
<?endforeach?>
</ul>
<?$this->SetViewTarget('price')?>
	<div style="color:red; margin: 34px 15px 35px 15px">
		<p><?=GetMessage('MAX')?></p>
		<p><?=$arResult['MAX']?></p>
		<p><?=GetMessage('MIN')?></p>
		<p><?=$arResult['MIN']?></p>
	</div>
<?$this->EndViewTarget()?>