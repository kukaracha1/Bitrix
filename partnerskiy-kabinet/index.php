<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("����������� �������");
global $USER;

// get id of current user
$userID = $USER->GetId();

$partnerID = (isset($_GET['partner']))? (int)$_GET['partner'] : (int)(1);

// get partner's id by user id
global $MiblockId, $MpartnerProperty;
$MiblockId = 4;
$MpartnerProperty = 'PARTNER_AT';
	
GLOBAL $arrFilter;
$arrFilter = array(
	"PROPERTY"=>array($MpartnerProperty => array(
		
	)),
	"ACTIVE" => ""
);
	
$arrFilterId = array(
	'IBLOCK_ID' => $MiblockId,
	'PROPERTY_48' => $userID
);

$i = 0;
$rsName = CIBlockElement::GetList("",$arrFilterId);
while($ob = $rsName->GetNext()) {
	if ($partnerID == 0)
		$arrFilter['PROPERTY'][$MpartnerProperty][] = $ob['ID'];
	// compose list of partners for result_modifier
	$PARTNERS[$i]['IBLOCK_NAME'] = $ob['IBLOCK_NAME'];
	$PARTNERS[$i]['NAME'] = $ob['NAME'];
	$PARTNERS[$i]['ID'] = $ob['ID'];
	
	$i++;
}

  if (count($PARTNERS) == 0)
 {
	// you have no access to this section
	ShowError("Access denied!!!");
 }
 else
 {
	// you have rights => show the catalog
	// if not set or wrong
	 if ($partnerID > count($PARTNERS) )
	 {
		 ShowError("Index of partner was out of rage!");
		 $partnerID = 1;
	 }
	
	// compose filter for component 'section'
	if ($partnerID != 0)
	{
		$arrFilter['PROPERTY'][$MpartnerProperty][] = $PARTNERS[$partnerID-1]['ID'];
		$APPLICATION->SetTitle("����������� ������� - " . $PARTNERS[$partnerID-1]['NAME']);
	}

	// echo '<br>TEST: SECTION<br>';
	
	
	
	$APPLICATION->IncludeComponent("bitrix:news.list", "personal_cabinet", Array(
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_MODE" => "Y",	// �������� ����� AJAX
		"IBLOCK_TYPE" => "catalog",	// ��� ��������������� ����� (������������ ������ ��� ��������)
		"IBLOCK_ID" => "2",	// ��� ��������������� �����
		"NEWS_COUNT" => "4",	// ���������� �������� �� ��������
		"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
		"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
		"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
		"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
		"FILTER_NAME" => "arrFilter",	// ������
		"FIELD_CODE" => array(
			"ACTIVE"
		),
		"FILTER_FIELD_CODE" => array(	// ����
			0 => "name",
			1=> "operator"
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "PARTNER_AT"
		),
		"PROPERTY_CODE" => array(	// ��������
			0 => "NEWPRODUCT",
			1 => "MATERIAL",
			2 => "MANUFACTURER",
			3 => "ARTNUMBER",
			4 => "COLOR",
			5 => "BRAND_REF"
		),
		"CHECK_DATES" => "N",	// ���������� ������ �������� �� ������ ������ ��������
		"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
		"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
		"SET_META_KEYWORDS" => "Y",	// ������������� �������� ����� ��������
		"SET_META_DESCRIPTION" => "Y",	// ������������� �������� ��������
		"SET_LAST_MODIFIED" => "Y",	// ������������� � ���������� ������ ����� ����������� ��������
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
		"PARENT_SECTION" => "",	// ID �������
		"PARENT_SECTION_CODE" => "",	// ��� �������
		"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
		"CACHE_TYPE" => "A",	// ��� �����������
		"CACHE_TIME" => "3600",	// ����� ����������� (���.)
		"CACHE_FILTER" => "Y",	// ���������� ��� ������������� �������
		"CACHE_GROUPS" => "Y",	// ��������� ����� �������
		"DISPLAY_TOP_PAGER" => "Y",	// �������� ��� �������
		"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
		"PAGER_TITLE" => "������",	// �������� ���������
		"PAGER_SHOW_ALWAYS" => "Y",	// �������� ������
		"PAGER_TEMPLATE" => "",	// ������ ������������ ���������
		"PAGER_DESC_NUMBERING" => "Y",	// ������������ �������� ���������
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
		"PAGER_SHOW_ALL" => "Y",	// ���������� ������ "���"
		"PAGER_BASE_LINK_ENABLE" => "N",	// �������� ��������� ������
		"SET_STATUS_404" => "Y",	// ������������� ������ 404
		"SHOW_404" => "Y",	// ����� ����������� ��������
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",	// Url ��� ���������� ������ (�� ��������� - �������������)
		"PAGER_PARAMS_NAME" => "arrPager",	// ��� ������� � ����������� ��� ���������� ������
		"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
		"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
		"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
		"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
		"SET_TITLE" => "N",	// ������������� ��������� ��������
		"SET_BROWSER_TITLE" => "N",	// ������������� ��������� ���� ��������
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
		"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
		"SECTION_URL" => "partnerskiy-kabinet",
		"PARTNERS" => $PARTNERS,
		"PARTNER_ID" => $partnerID
	),
	false
);
	/*
	echo '<br><hr><br>';

	$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "personal_cabinet",
    Array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
        "BASKET_URL" => "/personal/basket.php",
        "BRAND_PROPERTY" => "BRAND_REF",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "PROP",
        "ENLARGE_PROP" => "NEWPRODUCT",
        "FILTER_NAME" => "arrFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
        "IBLOCK_ID" => "2",
        "IBLOCK_TYPE" => "catalog",
        "INCLUDE_SUBSECTIONS" => "Y",
        "LABEL_PROP" => array("NEWPRODUCT"),
        "LABEL_PROP_MOBILE" => array(),
        "LABEL_PROP_POSITION" => "top-left",
        "LAZY_LOAD" => "Y",
        "LINE_ELEMENT_COUNT" => "3",
        "LOAD_ON_SCROLL" => "N",
        "MESSAGE_404" => "",
        "MESS_BTN_ADD_TO_BASKET" => "� �������",
        "MESS_BTN_BUY" => "������",
        "MESS_BTN_DETAIL" => "���������",
        "MESS_BTN_LAZY_LOAD" => "�������� ���",
        "MESS_BTN_SUBSCRIBE" => "�����������",
        "MESS_NOT_AVAILABLE" => "��� � �������",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "������",
        "PAGE_ELEMENT_COUNT" => "9",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array("BASE"),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array("NEWPRODUCT","MATERIAL"),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array("NEWPRODUCT",""),
        "PROPERTY_CODE_MOBILE" => array(),
        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
        "RCM_TYPE" => "personal",
        "SECTION_CODE" => "",
        "SECTION_ID" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_URL" => "partnerskiy-kabinet",
        "SECTION_USER_FIELDS" => array("",""),
        "SEF_MODE" => "N",
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SHOW_ALL_WO_SECTION" => "Y",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_FROM_SECTION" => "N",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
		// partners' data for result_modifier
		// "SHOW_TOP_ELEMENTS" => "N",
		"SHOW_DEACTIVATED" => "Y",
		"PARTNERS" => $PARTNERS,
		"PARTNER_ID" => $partnerID
		)
	);
	*/
};
?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>