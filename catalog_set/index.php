<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Комплекты");


		$APPLICATION->IncludeComponent("custom:catalog.section", "", Array(

		),
		false
	);
	
?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>