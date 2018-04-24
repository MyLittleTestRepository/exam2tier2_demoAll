<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?if(empty($arResult))
	return?>
<ul>
	<?foreach($arResult['USER'] as $arUser):?>
		<li>
			[<?=$arUser['ID']?>] - <?=$arUser['LOGIN']?>
			<ul>
				<?foreach($arUser['NEWS'] as $newsID):?>
					<li>
						<?=$arResult['NEWS'][$newsID]['DATE_ACTIVE_FROM']?> - <?=$arResult['NEWS'][$newsID]['NAME']?>
					</li>
				<?endforeach?>
			</ul>
		</li>
	<?endforeach?>
</ul>