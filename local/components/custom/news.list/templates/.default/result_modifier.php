<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

/*	set the picture property  
	(because it has another property name in news.list:  
		preview_picture instead of detail_picture 
*/
	if (count($arResult['ITEMS']) > 0)
	{
		// sort the Items on ID (because getlist will sort it)
		usort($arResult["ITEMS"], "cmp");		// cmp - comparing function (define in the end)
		 
		// define filters and select
		$arSelect = Array("ID", "DETAIL_PICTURE");
		$arFilter = array(
				'ID' => array()
			);

			// compose the ids' list
		 foreach ($arResult["ITEMS"] as $item)
			$arFilter['ID'][] = $item['ID'];

		$resItm = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		// die;
		$i = 0;
		while ($ob = $resItm->GetNextElement())
		{
			$arFields = $ob->GetFields();  
			// var_dump($arFields);
			$tmpFileID = $arFields['DETAIL_PICTURE'];
			$tmpFile = CFile::GetFileArray($tmpFileID);
			// write it to result
			$arResult["ITEMS"][$i]['PREVIEW_PICTURE'] = $tmpFile;

			$i++;
		}

	}
//	fill up partners info
	$MiblockId = $arParams['MIBLOCK_ID'];
	$REL_BLOCK_CODE = $arParams['REL_BLOCK_CODE'];
	$REL_BLOCK_PROP = $arParams['REL_BLOCK_PROP'];

	// sort the Items on ID (because getlist will sort it)
	usort($arParams['PARTNERS'], "cmp");		// cmp - comparing function (define in the end)
	 
	// define filters and select
	$arSelect = Array("PROPERTY_*");
	$arFilter = array(
			'IBLOCK_ID' => $MiblockId,
			'ID' => array()
		);

		// compose the ids' list
	foreach ($arParams['PARTNERS'] as $item)
		$arFilter['ID'][] = $item['ID'];
	// var_dump($arFilter);
	
	$resPar = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	$i = 0;
	while ($ob = $resPar->GetNextElement())
	{
		// $arFields = $ob->GetFields();  
		// // var_dump($arFields);
		$arrProperties = $ob->GetProperties();
		// var_dump($arrProperties);

		// adjust variables
		$arParams['PARTNERS'][$i]['INFO'] = array();
		
		foreach( $arrProperties as $prop)
		{	
			if ($prop['CODE'] != $REL_BLOCK_PROP)
			{
				// adjust variables
				$PROPERTY = array();
				// compose property info
				$PROPERTY['NAME'] = $prop['NAME'];
				$PROPERTY['VALUE'] = $prop['VALUE'];
				$PROPERTY['CODE'] = $prop['CODE'];
				$PROPERTY['ID'] = $prop['ID'];

				// write property to partner
				$arParams['PARTNERS'][$i]['INFO'][] = $PROPERTY;
			}
		}
		$i++;
	}



function cmp($a, $b)
{
	if ((int)$a["ID"] == (int)$b["ID"]) {
        return 0;
    }
    return ((int)$a["ID"] < (int)$b["ID"]) ? -1 : 1;
}
