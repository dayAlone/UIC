<?
$arSections = array();
foreach ($arResult['SECTIONS'] as $key => &$item)
	$arSections[$item['ID']] = $item;

$arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y");

$res = CIBlockElement::GetList(Array("IBLOCK_SECTION_ID"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->Fetch()):
	if(!isset($arSections[$ob['IBLOCK_SECTION_ID']]['ITEMS']))
		$arSections[$ob['IBLOCK_SECTION_ID']]['ITEMS'] = array();
	$arSections[$ob['IBLOCK_SECTION_ID']]['ITEMS'][] = $ob;
endwhile;

$arResult['SECTIONS'] = $arSections;
?>
