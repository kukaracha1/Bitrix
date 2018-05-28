<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

/*
* $arParams['PARTNERS'] should be complement by description & conditions
*
*
*/

// var_dump($arResult['ITEMS']);
// var_dump($arParams['PARTNERS']);

// echo '<br>TEST: MODIFIER<br>';
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
/*
var_dump($arParams['PARTNERS']);
foreach($arParams['PARTNERS'] as $partner)
{
	echo $partner['ID'];
	var_dump($partner['INFO']);
}
die;
*/

