<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("���������");


		$APPLICATION->IncludeComponent("custom:catalog.section", "", Array(

		),
		false
	);
	
?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>