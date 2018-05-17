<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнерский кабинет");
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
		"IBLOCK_TYPE" => "partner",	// Тип инфоблока
			"IBLOCK_ID" => "4",	// Инфоблок
			"TEMPLATE_THEME" => "site",	// Цветовая тема
			"HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
			"BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
			"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
			"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
			"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
			"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
			"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
			"SEF_FOLDER" => "/catalog/",	// Каталог ЧПУ (относительно корня сайта)
			"AJAX_MODE" => "N",	// Включить режим AJAX
			"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
			"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
			"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
			"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
			"ADD_SECTION_CHAIN" => "Y",
			"ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
			"SET_STATUS_404" => "Y",	// Устанавливать статус 404
			"DETAIL_DISPLAY_NAME" => "N",	// Выводить название элемента
			"USE_ELEMENT_COUNTER" => "Y",	// Использовать счетчик просмотров
			"USE_FILTER" => "Y",	// Показывать фильтр
			"FILTER_NAME" => "",	// Фильтр
			"FILTER_VIEW_MODE" => "VERTICAL",	// Вид отображения умного фильтра
			"FILTER_FIELD_CODE" => array(	// Поля
				0 => "",
				1 => "",
			),
			"FILTER_PROPERTY_CODE" => array(	// Свойства
				0 => "",
				1 => "",
			),
			"FILTER_PRICE_CODE" => array(	// Тип цены
				0 => "BASE",
			),
			"FILTER_OFFERS_FIELD_CODE" => array(	// Поля предложений
				0 => "PREVIEW_PICTURE",
				1 => "DETAIL_PICTURE",
				2 => "",
			),
			"FILTER_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
				0 => "",
				1 => "",
			),
			"USE_REVIEW" => "Y",	// Разрешить отзывы
			"MESSAGES_PER_PAGE" => "10",	// Количество сообщений на одной странице
			"USE_CAPTCHA" => "Y",	// Использовать CAPTCHA
			"REVIEW_AJAX_POST" => "Y",	// Использовать AJAX в диалогах
			"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",	// Путь относительно корня сайта к папке со смайлами
			"FORUM_ID" => "11",	// ID форума для отзывов
			"URL_TEMPLATES_READ" => "",	// Страница чтения темы (пусто - получить из настроек форума)
			"SHOW_LINK_TO_FORUM" => "Y",	// Показать ссылку на форум
			"USE_COMPARE" => "N",	// Разрешить сравнение товаров
			"PRICE_CODE" => array(	// Тип цены
				0 => "BASE",
			),
			"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
			"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
			"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
			"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
			"PRODUCT_PROPERTIES" => "",	// Характеристики товара, добавляемые в корзину
			"USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
			"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
			"QUANTITY_FLOAT" => "N",
			"OFFERS_CART_PROPERTIES" => array(	// Свойства предложений, добавляемые в корзину
				0 => "SIZES_SHOES",
				1 => "SIZES_CLOTHES",
				2 => "COLOR_REF",
			),
			"SHOW_TOP_ELEMENTS" => "N",	// Выводить топ элементов
			"SECTION_COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"SECTION_TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
			"SECTIONS_VIEW_MODE" => "TILE",	// Вид списка подразделов
			"SECTIONS_SHOW_PARENT_NAME" => "N",	// Показывать название раздела
			"PAGE_ELEMENT_COUNT" => "15",	// Количество элементов на странице
			"LINE_ELEMENT_COUNT" => "3",	// Количество элементов, выводимых в одной строке таблицы
			"ELEMENT_SORT_FIELD" => "desc",	// По какому полю сортируем товары в разделе
			"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки товаров в разделе
			"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки товаров в разделе
			"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки товаров в разделе
			"LIST_PROPERTY_CODE" => array(	// Свойства
				0 => "NEWPRODUCT",
				1 => "SALELEADER",
				2 => "SPECIALOFFER",
				3 => "",
			),
			"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
			"LIST_META_KEYWORDS" => "UF_KEYWORDS",	// Установить ключевые слова страницы из свойства раздела
			"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",	// Установить описание страницы из свойства раздела
			"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",	// Установить заголовок окна браузера из свойства раздела
			"LIST_OFFERS_FIELD_CODE" => array(	// Поля предложений
				0 => "NAME",
				1 => "PREVIEW_PICTURE",
				2 => "DETAIL_PICTURE",
				3 => "",
			),
			"LIST_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
				0 => "SIZES_SHOES",
				1 => "SIZES_CLOTHES",
				2 => "COLOR_REF",
				3 => "MORE_PHOTO",
				4 => "ARTNUMBER",
				5 => "",
			),
			"LIST_OFFERS_LIMIT" => "0",	// Максимальное количество предложений для показа (0 - все)
			"SECTION_BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",	// Установить фоновую картинку для шаблона из свойства
			"DETAIL_PROPERTY_CODE" => array(	// Свойства
				0 => "NEWPRODUCT",
				1 => "MANUFACTURER",
				2 => "MATERIAL",
				3 => "PARTNER"
			),
			"DETAIL_META_KEYWORDS" => "KEYWORDS",	// Установить ключевые слова страницы из свойства
			"DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",	// Установить описание страницы из свойства
			"DETAIL_BROWSER_TITLE" => "TITLE",	// Установить заголовок окна браузера из свойства
			"DETAIL_OFFERS_FIELD_CODE" => array(	// Поля предложений
				0 => "NAME",
				1 => "",
			),
			"DETAIL_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
				0 => "ARTNUMBER",
				1 => "SIZES_SHOES",
				2 => "SIZES_CLOTHES",
				3 => "COLOR_REF",
				4 => "MORE_PHOTO",
				5 => "",
			),
			"DETAIL_BACKGROUND_IMAGE" => "BACKGROUND_IMAGE",	// Установить фоновую картинку для шаблона из свойства
			"LINK_IBLOCK_TYPE" => "",	// Тип инфоблока, элементы которого связаны с текущим элементом
			"LINK_IBLOCK_ID" => "",	// ID инфоблока, элементы которого связаны с текущим элементом
			"LINK_PROPERTY_SID" => "",	// Свойство, в котором хранится связь
			"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL на страницу, где будет показан список связанных элементов
			"USE_ALSO_BUY" => "Y",	// Показывать блок "С этим товаром покупают"
			"ALSO_BUY_ELEMENT_COUNT" => "4",	// Количество элементов для отображения
			"ALSO_BUY_MIN_BUYES" => "1",	// Минимальное количество покупок товара
			"OFFERS_SORT_FIELD" => "sort",	// По какому полю сортируем предложения товара
			"OFFERS_SORT_ORDER" => "desc",	// Порядок сортировки предложений товара
			"OFFERS_SORT_FIELD2" => "id",	// Поле для второй сортировки предложений товара
			"OFFERS_SORT_ORDER2" => "desc",	// Порядок второй сортировки предложений товара
			"PAGER_TEMPLATE" => "round",	// Шаблон постраничной навигации
			"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
			"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
			"PAGER_TITLE" => "Товары",	// Название категорий
			"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
			"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// Время кеширования страниц для обратной навигации
			"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
			"ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
			"LABEL_PROP" => "NEWPRODUCT",	// Свойство меток товара
			"PRODUCT_DISPLAY_MODE" => "Y",	// Схема отображения
			"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительные картинки предложения
			"OFFER_TREE_PROPS" => array(	// Свойства для отбора предложений
				0 => "SIZES_SHOES",
				1 => "SIZES_CLOTHES",
				2 => "COLOR_REF",
				3 => "",
			),
			"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
			"SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
			"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
			"MESS_BTN_COMPARE" => "Сравнение",	// Текст кнопки "Сравнение"
			"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
			"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
			"DETAIL_USE_VOTE_RATING" => "Y",	// Включить рейтинг товара
			"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",	// В качестве рейтинга показывать
			"DETAIL_USE_COMMENTS" => "Y",	// Включить отзывы о товаре
			"DETAIL_BLOG_USE" => "Y",	// Использовать комментарии
			"DETAIL_VK_USE" => "N",	// Использовать Вконтакте
			"DETAIL_FB_USE" => "Y",	// Использовать Facebook
			"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
			"USE_STORE" => "Y",	// Показывать блок "Количество товара на складе"
			"BIG_DATA_RCM_TYPE" => "personal",	// Тип рекомендации
			"FIELDS" => array(	// Поля
				0 => "STORE",
				1 => "SCHEDULE",
			),
			"USE_MIN_AMOUNT" => "N",	// Показывать вместо точного количества информацию о достаточности
			"STORE_PATH" => "/store/#store_id#",	// Шаблон пути к каталогу STORE (относительно корня)
			"MAIN_TITLE" => "Наличие на складах",	// Заголовок блока
			"MIN_AMOUNT" => "10",
			"DETAIL_BRAND_USE" => "Y",	// Использовать компонент "Бренды"
			"DETAIL_BRAND_PROP_CODE" => "BRAND_REF",	// Таблица с брендами
			"SIDEBAR_SECTION_SHOW" => "Y",	// Показывать правый блок в списке товаров
			"SIDEBAR_DETAIL_SHOW" => "Y",	// Показывать правый блок на детальной странице
			"SIDEBAR_PATH" => "/catalog/sidebar.php",	// Путь к включаемой области для вывода информации в правом блоке
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
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_LAZY_LOAD" => "Показать ещё",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Товары",
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
			"MESS_BTN_ADD_TO_BASKET" => "пїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ",
			"MESS_BTN_BUY" => "пїЅпїЅпїЅпїЅпїЅпїЅ",
			"MESS_BTN_DETAIL" => "пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ",
			"MESS_NOT_AVAILABLE" => "пїЅпїЅпїЅ пїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ",
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