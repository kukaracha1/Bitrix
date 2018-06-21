<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


// var_dump($arResult['PROPERTIES']['PARTNER']);
$partner = $arResult['PROPERTIES']['PARTNER'];
// var_dump($partner);

$iblock_id = $partner['LINK_IBLOCK_ID'];
$element_id = $partner['VALUE'];

if ($element_id != '')
{
	// MORE CORRECT - replace getById and getProperty with getList and arSelect
	$detail_text = "";

	$arSelect = Array("ID", "NAME", "IBLOCK_CODE", "IBLOCK_NAME", "PROPERTY_*");
	$arFilter = array(
			'IBLOCK_ID' => $iblock_id,
			'ID' => $element_id
		);
	$rsList = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

	while ($ob = $rsList->GetNextElement())
	{
			$arrFields = $ob->GetFields();

		$VALUE['DISPLAY_VALUE'] =$arrFields['NAME'];
		$VALUE['NAME'] =$arrFields['IBLOCK_NAME'];
		$VALUE['ID'] = $arrFields['ID'];
		$VALUE['CODE'] = $arrFields['IBLOCK_CODE'];
		
		$arResult['DISPLAY_PROPERTIES'][] =$VALUE;
		
		$arrProperties = $ob->GetProperties();
		foreach( $arrProperties as $property)
		{
			if ($property['CODE'] != 'PARTNER_OPERATOR')
				$detail_text .= '<b>'.$property['NAME'] . ':</b> <br>' . $property['VALUE'] . '<br>';

		}
	}

	if ($arResult['DETAIL_TEXT_TYPE'] === 'html' )
	{
		$detail_text = '<p>' . $detail_text . '</p>';
	}

	$arResult['DETAIL_TEXT'] .= $detail_text;

	// var_dump($arResult['DETAIL_TEXT']);
}


