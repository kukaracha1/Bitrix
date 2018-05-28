<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $USER;

// test Unactivate

//input
$section = 10;
$id = 21;
$active = "N";

// UPDATE TEST
$el = new CIBlockElement;

// $PROP = array();
// $PROP['ACTIVE'] = "N";  // свойству с кодом 12 присваиваем значение "Белый"

$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION" => $section,          // элемент лежит в корне раздела
  // "PROPERTY_VALUES"=> $PROP,
  // "NAME"           => "Элемент",
  "ACTIVE"         => $active,            // активен
  // "PREVIEW_TEXT"   => "текст для списка элементов",
  // "DETAIL_TEXT"    => "текст для детального просмотра",
  // "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
  );

$PRODUCT_ID = $id;  // изменяем элемент с кодом (ID) 2
$res = $el->Update($PRODUCT_ID, $arLoadProductArray);
var_dump($arLoadProductArray);
var_dump($res);
DIE;
// ------- UPDATE TEST
