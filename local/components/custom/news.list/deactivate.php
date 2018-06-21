<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

	global $USER;
	$userID = $USER->GetId();
	

	if ($userID == null)
		error('You are not authorized to access this page');

	if (CModule::IncludeModule("iblock"))
	{
		//input
		$id = $_POST['id'];
		$REL_BLOCK_CODE = $_POST['REL_BLOCK_CODE'];
		$REL_BLOCK_PROP = $_POST['REL_BLOCK_PROP'];

		// $id = 20;	// DEBUG
		$arSelect = Array("ID", "NAME", "ACTIVE", "PROPERTY_".$REL_BLOCK_CODE);
		$arFilter = array(
				'ID' => $id
			);
		$resAct = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		// die;
		while ($ob = $resAct->GetNextElement())
		{
			$arFields = $ob->GetFields();  
			
			// we have partner_id, so check if user is the same as in partner's prop
			$arFilterPartner = array(
				'ID' => $arFields['PROPERTY_'.$REL_BLOCK_CODE.'_VALUE']
			);
			$arSelectPartner = array('PROPERTY_'.$REL_BLOCK_CODE.'_'.$REL_BLOCK_PROP);
			$resPar = CIBlockElement::GetList(Array(), $arFilterPartner, false, Array(), $arSelectPartner);
			
			while ($obpar = $resPar->GetNextElement())
			{
				$arFieldsPartner = $obpar->GetFields();  
				if ( $arFieldsPartner['PROPERTY_'.$REL_BLOCK_CODE.'_'.$REL_BLOCK_PROP.'_VALUE'] != $userID)
					error('Access denied!');
			}
			
			// if we here - everything is all right. set the active value
			$active = ($arFields['ACTIVE'] == 'Y')? 'N' : 'Y';
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
			echo json_encode($result, JSON_UNESCAPED_UNICODE);

		}
		else
			error('cannot set property "active"');
	}
	else
		error('server error');

	
	
	function error($msg)
	{
		// ShowError($msg);
		$result['status'] = $msg;
		echo json_encode($result, JSON_UNESCAPED_UNICODE);

		header('HTTP/1.1 404 Not Found');
		die;

	}
