<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


// var_dump($arResult['PROPERTIES']['PARTNER_AT']);
$partner = $arResult['PROPERTIES']['PARTNER_AT'];

$iblock_id = $partner['LINK_IBLOCK_ID'];
$element_id = $partner['VALUE'];

// IT WORKS
//BY DISPLAY_PROPERTIES
$rsName = CIBlockElement::GetById($element_id);
while($ob = $rsName->GetNext()) {
	$VALUE['DISPLAY_VALUE'] =$ob['NAME'];
	$VALUE['NAME'] =$ob['IBLOCK_NAME'];
	$VALUE['ID'] = $ob['ID'];
	$VALUE['CODE'] = $ob['IBLOCK_CODE'];
	
	$arResult['DISPLAY_PROPERTIES'][] =$VALUE;
}

// BY DETAIL_TEXT
$rsProps = CIBlockElement::GetProperty($iblock_id, $element_id);
$i=0;
while($ob = $rsProps->GetNext()) {
	if ($ob['ID'] != 48)
	{
		$VALUE = $ob;
		$VALUE['DISPLAY_VALUE'] = $ob['VALUE'];
		$VALUES[] = $VALUE;
	}
}

// var_dump($arResult['DETAIL_TEXT']);
if ($arResult['DETAIL_TEXT_TYPE'] === 'html' )
{
	$arResult['DETAIL_TEXT'] .='<p>';
}
foreach ($VALUES as $VALUE)
{

		$arResult['DETAIL_TEXT'] .= '<b>'.$VALUE['NAME'] . ':</b> <br>' . $VALUE['DISPLAY_VALUE'] . '<br>';
	
}
if ($arResult['DETAIL_TEXT_TYPE'] === 'html' )
{
	$arResult['DETAIL_TEXT'] .='</p>';
}

// var_dump($arResult['DETAIL_TEXT']);



