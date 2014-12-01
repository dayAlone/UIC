<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('График обучения');
$APPLICATION->SetPageProperty('hide_shedule', 'true');
global $shedule;
$shedule = array(">=PROPERTY_START"=>date('Y-m-d')." 00:00:00");
$APPLICATION->IncludeComponent(
  "bitrix:news.list", 
  "shedule",
  array(
    "IBLOCK_ID"   => 4,
    "NEWS_COUNT"  => "10",
    "FILTER_NAME" => "shedule",
    "SORT_BY1"    => "PROPERTY_START",
    "SORT_ORDER1" => "ASC",
    "DETAIL_URL"  => "/press/#ELEMENT_CODE#/",
    "CACHE_TYPE"  => "A",
    "SET_TITLE"   => "N",
    "MORE_TEXT"   => "полный график обучения",
    "PROPERTY_CODE"  => array("START", "END", "GROUPS"),
    "MORE_LINK"   => "/shedule/",
    "CLASS"       => "courses"
  ),
  false
);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>