<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("����������� �������");
global $USER;

// 317 should be changed by user id!
$userID = $USER->GetId();

// i need to get partner's id by user id
$iblockId = 4;
$arrFilterId = array(
	'IBLOCK_ID' => $iblockId,
	'PROPERTY_48' => $userID
 
);
$rsName = CIBlockElement::GetList("",$arrFilterId);
while($ob = $rsName->GetNext()) {
	// we have all partners of our user .
	// actually I should add a tab for each partner 
	
	$elementID[] = $ob['ID'];
	// var_dump($ob);
}
// var_dump($elementID);
 if (count($elementID) == 0)
 {
	// you have no access to this section
	ShowError("Access denied!!!");
 }
 else
 {
	// you have rights => show the catalog
	
		// show partner's info		WILL BE IN THE TEMPLATE
	$i = 0;
	$rsName = CIBlockElement::GetProperty( 4, $elementID[0]);
	while($ob = $rsName->GetNext()) {
		if ($ob['ID'] != 48)
			{
				$PARTNER[$i]['NAME'] = $ob['NAME'];
				$PARTNER[$i]['VALUE'] = $ob['VALUE'];
				$i++;
			}
		// var_dump($ob);
	}
	var_dump($PARTNER);
	
	// $arrFilter = array(
		// // 'PROPERTY_PARTNER_AT' => $elementID[0]
		// // 'PROPERTY_49' => $elementID[0]
	// );
	// var_dump($arrFilter);

	/* $APPLICATION->IncludeComponent("bitrix:catalog", "personal_cabinet", Array(
		"IBLOCK_TYPE" => "partner",	// ��� ���������
			"IBLOCK_ID" => "4",	// ��������
			"TEMPLATE_THEME" => "site",	// �������� ����
			"HIDE_NOT_AVAILABLE" => "N",	// ����������� ������
			"BASKET_URL" => "/personal/cart/",	// URL, ������� �� �������� � �������� ����������
			"ACTION_VARIABLE" => "action",	// �������� ����������, � ������� ���������� ��������
			"PRODUCT_ID_VARIABLE" => "id",	// �������� ����������, � ������� ���������� ��� ������ ��� �������
			"SECTION_ID_VARIABLE" => "SECTION_ID",	// �������� ����������, � ������� ���������� ��� ������
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// �������� ����������, � ������� ���������� ���������� ������
			"PRODUCT_PROPS_VARIABLE" => "prop",	// �������� ����������, � ������� ���������� �������������� ������
			"SEF_MODE" => "Y",	// �������� ��������� ���
			"SEF_FOLDER" => "/catalog/",	// ������� ��� (������������ ����� �����)
			"AJAX_MODE" => "N",	// �������� ����� AJAX
			"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
			"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
			"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
			"CACHE_TYPE" => "A",	// ��� �����������
			"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
			"CACHE_FILTER" => "Y",	// ���������� ��� ������������� �������
			"CACHE_GROUPS" => "Y",	// ��������� ����� �������
			"SET_TITLE" => "Y",	// ������������� ��������� ��������
			"ADD_SECTION_CHAIN" => "Y",
			"ADD_ELEMENT_CHAIN" => "Y",	// �������� �������� �������� � ������� ���������
			"SET_STATUS_404" => "Y",	// ������������� ������ 404
			"DETAIL_DISPLAY_NAME" => "N",	// �������� �������� ��������
			"USE_ELEMENT_COUNTER" => "Y",	// ������������ ������� ����������
			"USE_FILTER" => "Y",	// ���������� ������
			"FILTER_NAME" => "",	// ������
			"FILTER_VIEW_MODE" => "VERTICAL",	// ��� ����������� ������ �������
			"FILTER_FIELD_CODE" => array(	// ����
				0 => "",
				1 => "",
			),
			"FILTER_PROPERTY_CODE" => array(	// ��������
				0 => "",
				1 => "",
			),
			"FILTER_PRICE_CODE" => array(	// ��� ����
				0 => "BASE",
			),
			"FILTER_OFFERS_FIELD_CODE" => array(	// ���� �����������
				0 => "PREVIEW_PICTURE",
				1 => "DETAIL_PICTURE",
				2 => "",
			),
			"FILTER_OFFERS_PROPERTY_CODE" => array(	// �������� �����������
				0 => "",
				1 => "",
			),
			"USE_REVIEW" => "Y",	// ��������� ������
			"MESSAGES_PER_PAGE" => "10",	// ���������� ��������� �� ����� ��������
			"USE_CAPTCHA" => "Y",	// ������������ CAPTCHA
			"REVIEW_AJAX_POST" => "Y",	// ������������ AJAX � ��������
			"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",	// ���� ������������ ����� ����� � ����� �� ��������
			"FORUM_ID" => "11",	// ID ������ ��� �������
			"URL_TEMPLATES_READ" => "",	// �������� ������ ���� (����� - �������� �� �������� ������)
			"SHOW_LINK_TO_FORUM" => "Y",	// �������� ������ �� �����
			"USE_COMPARE" => "N",	// ��������� ��������� �������
			"PRICE_CODE" => array(	// ��� ����
				0 => "BASE",
			),
			"USE_PRICE_COUNT" => "N",	// ������������ ����� ��� � �����������
			"SHOW_PRICE_COUNT" => "1",	// �������� ���� ��� ����������
			"PRICE_VAT_INCLUDE" => "Y",	// �������� ��� � ����
			"PRICE_VAT_SHOW_VALUE" => "N",	// ���������� �������� ���
			"PRODUCT_PROPERTIES" => "",	// �������������� ������, ����������� � �������
			"USE_PRODUCT_QUANTITY" => "Y",	// ��������� �������� ���������� ������
			"CONVERT_CURRENCY" => "N",	// ���������� ���� � ����� ������
			"QUANTITY_FLOAT" => "N",
			"OFFERS_CART_PROPERTIES" => array(	// �������� �����������, ����������� � �������
				0 => "SIZES_SHOES",
				1 => "SIZES_CLOTHES",
				2 => "COLOR_REF",
			),
			"SHOW_TOP_ELEMENTS" => "N",	// �������� ��� ���������
			"SECTION_COUNT_ELEMENTS" => "N",	// ���������� ���������� ��������� � �������
			"SECTION_TOP_DEPTH" => "1",	// ������������ ������������ ������� ��������
			"SECTIONS_VIEW_MODE" => "TILE",	// ��� ������ �����������
			"SECTIONS_SHOW_PARENT_NAME" => "N",	// ���������� �������� �������
			"PAGE_ELEMENT_COUNT" => "15",	// ���������� ��������� �� ��������
			"LINE_ELEMENT_COUNT" => "3",	// ���������� ���������, ��������� � ����� ������ �������
			"ELEMENT_SORT_FIELD" => "desc",	// �� ������ ���� ��������� ������ � �������
			"ELEMENT_SORT_ORDER" => "asc",	// ������� ���������� ������� � �������
			"ELEMENT_SORT_FIELD2" => "id",	// ���� ��� ������ ���������� ������� � �������
			"ELEMENT_SORT_ORDER2" => "desc",	// ������� ������ ���������� ������� � �������
			"LIST_PROPERTY_CODE" => array(	// ��������
				0 => "NEWPRODUCT",
				1 => "SALELEADER",
				2 => "SPECIALOFFER",
				3 => "",
			),
			"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
			"LIST_META_KEYWORDS" => "UF_KEYWORDS",	// ���������� �������� ����� �������� �� �������� �������
			"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",	// ���������� �������� �������� �� �������� �������
			"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",	// ���������� ��������� ���� �������� �� �������� �������
			"LIST_OFFERS_FIELD_CODE" => array(	// ���� �����������
				0 => "NAME",
				1 => "PREVIEW_PICTURE",
				2 => "DETAIL_PICTURE",
				3 => "",
			),
			"LIST_OFFERS_PROPERTY_CODE" => array(	// �������� �����������
				0 => "SIZES_SHOES",
				1 => "SIZES_CLOTHES",
				2 => "COLOR_REF",
				3 => "MORE_PHOTO",
				4 => "ARTNUMBER",
				5 => "",
			),
			"LIST_OFFERS_LIMIT" => "0",	// ������������ ���������� ����������� ��� ������ (0 - ���)
			"SECTION_BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",	// ���������� ������� �������� ��� ������� �� ��������
			"DETAIL_PROPERTY_CODE" => array(	// ��������
				0 => "NEWPRODUCT",
				1 => "MANUFACTURER",
				2 => "MATERIAL",
				3 => "PARTNER"
			),
			"DETAIL_META_KEYWORDS" => "KEYWORDS",	// ���������� �������� ����� �������� �� ��������
			"DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",	// ���������� �������� �������� �� ��������
			"DETAIL_BROWSER_TITLE" => "TITLE",	// ���������� ��������� ���� �������� �� ��������
			"DETAIL_OFFERS_FIELD_CODE" => array(	// ���� �����������
				0 => "NAME",
				1 => "",
			),
			"DETAIL_OFFERS_PROPERTY_CODE" => array(	// �������� �����������
				0 => "ARTNUMBER",
				1 => "SIZES_SHOES",
				2 => "SIZES_CLOTHES",
				3 => "COLOR_REF",
				4 => "MORE_PHOTO",
				5 => "",
			),
			"DETAIL_BACKGROUND_IMAGE" => "BACKGROUND_IMAGE",	// ���������� ������� �������� ��� ������� �� ��������
			"LINK_IBLOCK_TYPE" => "",	// ��� ���������, �������� �������� ������� � ������� ���������
			"LINK_IBLOCK_ID" => "",	// ID ���������, �������� �������� ������� � ������� ���������
			"LINK_PROPERTY_SID" => "",	// ��������, � ������� �������� �����
			"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL �� ��������, ��� ����� ������� ������ ��������� ���������
			"USE_ALSO_BUY" => "Y",	// ���������� ���� "� ���� ������� ��������"
			"ALSO_BUY_ELEMENT_COUNT" => "4",	// ���������� ��������� ��� �����������
			"ALSO_BUY_MIN_BUYES" => "1",	// ����������� ���������� ������� ������
			"OFFERS_SORT_FIELD" => "sort",	// �� ������ ���� ��������� ����������� ������
			"OFFERS_SORT_ORDER" => "desc",	// ������� ���������� ����������� ������
			"OFFERS_SORT_FIELD2" => "id",	// ���� ��� ������ ���������� ����������� ������
			"OFFERS_SORT_ORDER2" => "desc",	// ������� ������ ���������� ����������� ������
			"PAGER_TEMPLATE" => "round",	// ������ ������������ ���������
			"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
			"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
			"PAGER_TITLE" => "������",	// �������� ���������
			"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
			"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// ����� ����������� ������� ��� �������� ���������
			"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
			"ADD_PICT_PROP" => "MORE_PHOTO",	// �������������� �������� ��������� ������
			"LABEL_PROP" => "NEWPRODUCT",	// �������� ����� ������
			"PRODUCT_DISPLAY_MODE" => "Y",	// ����� �����������
			"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",	// �������������� �������� �����������
			"OFFER_TREE_PROPS" => array(	// �������� ��� ������ �����������
				0 => "SIZES_SHOES",
				1 => "SIZES_CLOTHES",
				2 => "COLOR_REF",
				3 => "",
			),
			"SHOW_DISCOUNT_PERCENT" => "Y",	// ���������� ������� ������
			"SHOW_OLD_PRICE" => "Y",	// ���������� ������ ����
			"MESS_BTN_BUY" => "������",	// ����� ������ "������"
			"MESS_BTN_ADD_TO_BASKET" => "� �������",	// ����� ������ "�������� � �������"
			"MESS_BTN_COMPARE" => "���������",	// ����� ������ "���������"
			"MESS_BTN_DETAIL" => "���������",	// ����� ������ "���������"
			"MESS_NOT_AVAILABLE" => "��� � �������",	// ��������� �� ���������� ������
			"DETAIL_USE_VOTE_RATING" => "Y",	// �������� ������� ������
			"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",	// � �������� �������� ����������
			"DETAIL_USE_COMMENTS" => "Y",	// �������� ������ � ������
			"DETAIL_BLOG_USE" => "Y",	// ������������ �����������
			"DETAIL_VK_USE" => "N",	// ������������ ���������
			"DETAIL_FB_USE" => "Y",	// ������������ Facebook
			"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
			"USE_STORE" => "Y",	// ���������� ���� "���������� ������ �� ������"
			"BIG_DATA_RCM_TYPE" => "personal",	// ��� ������������
			"FIELDS" => array(	// ����
				0 => "STORE",
				1 => "SCHEDULE",
			),
			"USE_MIN_AMOUNT" => "N",	// ���������� ������ ������� ���������� ���������� � �������������
			"STORE_PATH" => "/store/#store_id#",	// ������ ���� � �������� STORE (������������ �����)
			"MAIN_TITLE" => "������� �� �������",	// ��������� �����
			"MIN_AMOUNT" => "10",
			"DETAIL_BRAND_USE" => "Y",	// ������������ ��������� "������"
			"DETAIL_BRAND_PROP_CODE" => "BRAND_REF",	// ������� � ��������
			"SIDEBAR_SECTION_SHOW" => "Y",	// ���������� ������ ���� � ������ �������
			"SIDEBAR_DETAIL_SHOW" => "Y",	// ���������� ������ ���� �� ��������� ��������
			"SIDEBAR_PATH" => "/catalog/sidebar.php",	// ���� � ���������� ������� ��� ������ ���������� � ������ �����
			"SEF_URL_TEMPLATES" => array(
				"sections" => "",
				"section" => "#SECTION_CODE#/",
				"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
				"compare" => "compare/",
			)
		),
		false
	); */
	
	/* echo '<br>TEST: SECTION.LIST<br>';
	$APPLICATION->IncludeComponent("bitrix:catalog.section.list","",
	Array(
			"VIEW_MODE" => "TEXT",
			"SHOW_PARENT_NAME" => "Y",
			"IBLOCK_TYPE" => "partner",
			"IBLOCK_ID" => $iblockId,
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"SECTION_URL" => "",
			"COUNT_ELEMENTS" => "Y",
			"TOP_DEPTH" => "2",
			"SECTION_FIELDS" => "",
			"SECTION_USER_FIELDS" => "",
			"ADD_SECTIONS_CHAIN" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_NOTES" => "",
			"CACHE_GROUPS" => "Y"
		)
	); */
	
	echo '<br>TEST: SECTION<br>';
	
	GLOBAL $arrFilter_AT;
	$arrFilter_AT = array(
		"PROPERTY"=>array("PARTNER_AT" => $elementID)
	);
	
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
        "FILTER_NAME" => "arrFilter_AT",
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
        "PAGER_SHOW_ALL" => "N",
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
        "SECTION_URL" => "",
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
        "USE_PRODUCT_QUANTITY" => "N"
    )
);
	


	// show catalog of my clothes
	/* global $arrFilterTop;
	$arrFilterTop = array(
	   'PROPERTY_49' => $elementID
	);

	$APPLICATION->IncludeComponent(
		"bitrix:catalog.top",
		"",
		Array(
			"ACTION_VARIABLE" => "action",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"BASKET_URL" => "/personal/basket.php",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPATIBLE_MODE" => "Y",
			"CONVERT_CURRENCY" => "N",
			"DETAIL_URL" => "",
			"DISPLAY_COMPARE" => "N",
			
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "STRICT",
			"FILTER_NAME" => "arrFilterTop",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "",
			"IBLOCK_TYPE" => "catalog",
			"LINE_ELEMENT_COUNT" => "3",
			"MESS_BTN_ADD_TO_BASKET" => "� �������",
			"MESS_BTN_BUY" => "������",
			"MESS_BTN_DETAIL" => "���������",
			"MESS_NOT_AVAILABLE" => "��� � �������",
			"OFFERS_LIMIT" => "5",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},]",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"PROPERTY_CODE" => array("",""),
			"SECTION_URL" => "",
			"SEF_MODE" => "N",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N",
			"VIEW_MODE" => "SECTION"
		)
	); */
};
?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>