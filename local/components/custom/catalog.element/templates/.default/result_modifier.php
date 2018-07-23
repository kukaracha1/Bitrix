<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// we need get circles (spots) for our set
    $SPOTS = [];

// get list of circles (SET_GOOD relation)
    $setFilter = array(
        'IBLOCK_CODE' => 'set_good',
        'PROPERTY_SET_ID' => $arParams['ELEMENT_ID'] 	// SET id which was gotten above
    );
    
    // get list of SET_GOOD elements for this set
    $rres = CIBlockElement::GetList(
    array(),
    $setFilter,
    false,
    false,
    array(
        'ID', 'IBLOCK_ID', 'PROPERTY_*'
    )
    );

    global $prop_list;
    $prop_list = $arResult['PROPERTIES']['GOOD_LIST'];

    $j = 0;
    while($ob = $rres->GetNextElement())
    {
        $ob_props = $ob->GetProperties();
        $ob_fields = $ob->GetFields();
        
        $SPOTS[$j]['COORD_Y'] = $ob_props['COORD_Y']['VALUE'];
        $SPOTS[$j]['COORD_X'] = $ob_props['COORD_X']['VALUE'];


        $SPOTS[$j]['GOOD_ID'] = get_spot_value($ob_props['PROPERTY_ID']['VALUE']);

        // get good's info

        

        $j++;
    }

    var_dump($SPOTS);

    $arParams['SPOTS'] = $SPOTS;

    function get_spot_value($prop_id)
    {
        global $prop_list;

        $i = array_search($prop_id, $prop_list['PROPERTY_VALUE_ID']);
        $value = $prop_list['VALUE'][$i];

        return $value;
    }
