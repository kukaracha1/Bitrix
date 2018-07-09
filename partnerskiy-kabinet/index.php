<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("����������� �������");


		$APPLICATION->IncludeComponent("custom:news.list", "", Array(
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
			"FILTER_NAME" => "",	// ������
			"FIELD_CODE" => array(
				"ACTIVE"
			),
			"FILTER_FIELD_CODE" => array(	// ����
				0 => "name",
				1=> "operator"
			),
			"FILTER_PROPERTY_CODE" => array(
				0 => "PARTNER"
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
			"MIBLOCK_ID" => 4,
			"REL_BLOCK_CODE" => 'PARTNER',
			"REL_BLOCK_PROP" => 'OPERATOR',
			"SHOW_PARTNERS" => "Y"
		),
		false
	);
	
?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>