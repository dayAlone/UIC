<?
$arSections = array();
foreach ($arResult['ITEMS'] as $item)
	if($arParams['PARENT_SECTION'] != $item['IBLOCK_SECTION_ID'])
		$arSections[] = $item['IBLOCK_SECTION_ID'];

if(count($arSections)>0):
	$arFilter = Array('IBLOCK_ID'=>$arResult['ID'], 'ID'=>$arSections);
	$raw = CIBlockSection::GetList(Array('SORT'=>'ASC'), $arFilter, true);
	$arSections = array();

	while($item = $raw->GetNext())
		$arSections[$item['ID']] = $item;
	foreach ($arResult['ITEMS'] as $item):
		if(!isset($arSections[$item['IBLOCK_SECTION_ID']]['ITEMS']))
			$arSections[$item['IBLOCK_SECTION_ID']]['ITEMS'] = array();
		$arSections[$item['IBLOCK_SECTION_ID']]['ITEMS'][] = $item;
	endforeach;
	
	$arResult['DATA'] = $arSections;

endif;

?>