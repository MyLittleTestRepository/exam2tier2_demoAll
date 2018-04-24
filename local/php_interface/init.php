<?
//def
define('PRODUCTS_IBLOCK_ID',2);
define('SERVICES_IBLOCK_ID',3);
define('METATAGS_IBLOCK_ID',6);
define('ADMINS_GID',1);
define('CONTENT_EDITORS_GID',5);

if(file_exists($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/MyEventHandler.php'))
	include_once $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/MyEventHandler.php';
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/MyAgents.php'))
	include_once $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/MyAgents.php';

function mydebug($asastr,$asadie=false,$asafname='')
{
	$asafile=$_SERVER['DOCUMENT_ROOT'].'/debug_'.$asafname.'.txt';
	$asadata=date('H:i:s').PHP_EOL.mydump($asastr);
	file_put_contents($asafile,$asadata);
	if($asadie) die();
}