<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult['CANONICAL']))
	$APPLICATION->SetPageProperty('canonical',$arResult['CANONICAL']);

//ajax
if(isset($_GET['report'])) {	
	if(empty($_GET['report'])) {
		if(!CModule::IncludeModule('iblock'))
			return;
		
		//user name
		if(CUser::IsAuthorized()){
			$user='['.CUser::GetID().']('
			.CUser::GetLogin().') '.CUser::GetFullName();	
		}else
			$user=GetMessage('NOAUTH');
		
		$arFields=['NAME' => 'report',
				   'IBLOCK_ID' => REPORTS_IBLOCK_ID,
				   'DATE_ACTIVE_FROM' => ConvertTimeStamp(time(),'FULL'),
				   'PROPERTY_VALUES' => ['USER' => $user,
										 'LINK_TO_NEWS' => $arParams['ELEMENT_ID']
										 ]
				   ];
		
		$el=new CIBlockElement;
		$reportID = $el->Add($arFields, false, false);
		
		//send data
		if($arParams['AJAX_REPORT']=='Y') {
			$APPLICATION->RestartBuffer();
			echo $reportID;
			die();
		}
		else
			LocalRedirect($APPLICATION->GetCurPage().'?report='.$reportID);
	}
	else
		$reportID = $_GET['report'];
}
?>
<script>
	var button = BX('report_button');
	var text = BX('report_text');
	var reportID = <?=json_encode($reportID)?>;
	var ajax = <?=json_encode($arParams['AJAX_REPORT'])?>;
	var url = <?=json_encode($APPLICATION->GetCurPage())?>;
	
	BX.ready(function(){

		function addID(id){
			if(text.hidden && id){
				text.innerHTML += id;
				text.hidden=false;
			}
		}

		function sendReport(){
			if(text.hidden)
				BX.ajax.get(url+'?report', addID);
		}
		
		if(ajax=='Y')
			BX.bind(button, 'click', sendReport);
		else
			addID(reportID);
	});
</script>