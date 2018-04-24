<?
function CheckUserCount()
{	
	$time=time();
	$timeOld=COption::GetOptionInt('main', 'lastUserCheckTime');
	
	//first start
	if($timeOld<1)
	{
		COption::SetOptionInt('main', 'lastUserCheckTime', $time);
		return;
	}
	
	$days=intval(($time-$timeOld)/(24*3600));

	//get new users
	$newUsersCount=CUser::GetList(${"DATE_REGISTER"}, ${"DESC"},
								  ['DATE_REGISTER_1'=>ConvertTimeStamp($timeOld,'FULL')],
								  ['FIELDS'=>['ID']])->SelectedRowsCount();

	if(!$newUsersCount)
		return;

	//get admins
	$resAdmins=$USER->GetList(${"ID"}, ${"ASC"},
							  ['GROUPS_ID'=>ADMINS_GID,
							   'ACTIVE'=>'Y',
							   '!EMAIL'=>false],
							  ['FIELDS'=>['EMAIL']]);

	if(!$resAdmins->SelectedRowsCount())
		return;

	//get mails
	$arMails=[];
	while($user=$resAdmins->Fetch())
		$arMails[]=$user['EMAIL'];

	if(count($arMails)<1)
		return;

	COption::SetOptionInt('main', 'lastUserCheckTime', $time);

	//send mails
	foreach($arMails as $email)
		CEvent::Send('NEW_USER_COUNT', SITE_ID, ['EMAIL'=>$email,
												 'COUNT'=>$newUsersCount,
												 'DAYS'=>$days], "N");
	
	return'CheckUserCount();';
}