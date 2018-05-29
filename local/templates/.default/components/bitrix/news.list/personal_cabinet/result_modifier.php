<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

 
 // var_dump($arResult["ITEMS"][0]);
 foreach ($arResult["ITEMS"] as $item)
 for ($i = 0 ; $i < count ($arResult["ITEMS"]) ; $i++)
 {
	 
	$rsItem = CIBlockElement::GetByID(
	// $rsItem = CIBlockElement::GetProperty(
		// 2,
		$arResult["ITEMS"][$i]['ID']
	);
	while($ob = $rsItem->GetNext())
	{
		$tmpFileID = $ob['DETAIL_PICTURE'];
		$tmpFile = CFile::GetFileArray($tmpFileID);
		// var_dump($ob);
		// var_dump($tmpFileID);
		// var_dump($tmpFile);
		$arResult["ITEMS"][$i]['PREVIEW_PICTURE'] = $tmpFile;
	}
 }

