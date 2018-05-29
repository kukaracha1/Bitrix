<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	global $USER;

	if (CModule::IncludeModule("iblock"))
	{
	// test Unactivate
		//input
		$id = $_POST['id'];
		// $id = 6;

		$resAct = CIBlockElement::GetByID($id);
		// die;
		while ($ob = $resAct->GetNext())
		{
			$active = ($ob['ACTIVE'] == 'Y')? 'N' : 'Y';
		}
		// die;
		// UPDATE TEST
		$el = new CIBlockElement;
		

		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
		  "ACTIVE"         => $active,            // активен
		  );

		$PRODUCT_ID = $id;  // измен¤ем элемент с кодом (ID) 2
		$res = $el->Update($PRODUCT_ID, $arLoadProductArray);
		if ($res)
		{
			$result['status'] = 'ok';
			$result['active'] = $active;
		}
		else
		{
			
			$result['status'] = 'cannot set property "active"';
			header('HTTP/1.1 404 Not Found');
		}
	}
	else
	{
		$result['status'] = 'server error';
		header('HTTP/1.1 404 Not Found');
	}

	echo json_encode($result, JSON_UNESCAPED_UNICODE);
