<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оценка производительности 88");
?>
<p>ex2-88:</p>
<p>/products/index.php	30.68%</p>
<p>delta cache 4kb</p>
</br>
<p>ex2-10:</p>
<p>/products/index.php	20.98%</p>
<p>bitrix:catalog: 0.1151 с</p>
</br>
<p>ex2-11:</p>
<p>/products/index.php	1.9812</p>
<p>bitrix:news.list: 0.0509 с; Запросов: 29 (0.0175 с)</p>
<p>bitrix:catalog.section: 0.1441 с; Запросов: 28 (0.0269 с)</p>
</br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>