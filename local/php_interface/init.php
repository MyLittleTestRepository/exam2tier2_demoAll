<?

function mydebug($asastr,$asadie=false,$asafname='')
{
	$asafile=$_SERVER['DOCUMENT_ROOT'].'/debug_'.$asafname.'.txt';
	$asadata=date('H:i:s').PHP_EOL.mydump($asastr);
	file_put_contents($asafile,$asadata);
	if($asadie) die();
}