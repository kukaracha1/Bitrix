<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

/*	set the picture property  
	(because it has another property name in news.list:  
		preview_picture instead of detail_picture 
*/
 foreach ($arResult["ITEMS"] as $item)
 for ($i = 0 ; $i < count ($arResult["ITEMS"]) ; $i++)
 {
	// get the item with it's id
	$rsItem = CIBlockElement::GetByID(
		$arResult["ITEMS"][$i]['ID']
	);
	while($ob = $rsItem->GetNext())
	{
		// get it's image id & image's file location
		$tmpFileID = $ob['DETAIL_PICTURE'];
		$tmpFile = CFile::GetFileArray($tmpFileID);
		// write it to result
		$arResult["ITEMS"][$i]['PREVIEW_PICTURE'] = $tmpFile;
	}
 }

 
 /*	fill up partners info, goted in index.php file
 
 */
 global $MiblockId;

for( $i = 0; $i < count($arParams['PARTNERS']) ; $i++)
{
	// adjust variables
	$arParams['PARTNERS'][$i]['INFO'] = array();
	
	$rsName = CIBlockElement::GetProperty( $MiblockId,$arParams['PARTNERS'][$i]['ID']);
	while($ob = $rsName->GetNext()) {
		if ($ob['ID'] != 48)
		{
			// adjust variables
			$PROPERTY = array();
			// compose property info
			$PROPERTY['NAME'] = $ob['NAME'];
			$PROPERTY['VALUE'] = $ob['VALUE'];
			$PROPERTY['ID'] = $ob['ID'];
			// write property to partner
			$arParams['PARTNERS'][$i]['INFO'][] = $PROPERTY;
		}
	}
}
