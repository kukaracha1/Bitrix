<?

global $USER;

// test Unactivate

//input
// $section = 10;
$id = $_POST['id'];
$active = ($_POST['active'] == 'Y')? 'N' : 'Y';

// UPDATE TEST
$el = new CIBlockElement;

// $PROP = array();
// $PROP['ACTIVE'] = "N";  // �������� � ����� 12 ����������� �������� "�����"

$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // ������� ������� ������� �������������
  // "IBLOCK_SECTION" => $section,          // ������� ����� � ����� �������
  // "PROPERTY_VALUES"=> $PROP,
  // "NAME"           => "�������",
  "ACTIVE"         => $active,            // �������
  // "PREVIEW_TEXT"   => "����� ��� ������ ���������",
  // "DETAIL_TEXT"    => "����� ��� ���������� ���������",
  // "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
  );

$PRODUCT_ID = $id;  // �������� ������� � ����� (ID) 2
$res = $el->Update($PRODUCT_ID, $arLoadProductArray);
// var_dump($arLoadProductArray);
// var_dump($res);
DIE;
// ------- UPDATE TEST
