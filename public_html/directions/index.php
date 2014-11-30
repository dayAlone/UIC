<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('section', array('IBLOCK'=>4, 'CODE'=>'directions', "NOEMPTY"=>true));
require($_SERVER['DOCUMENT_ROOT'].'/include/section.php');
$APPLICATION->SetPageProperty('show_news', 'true');
//$APPLICATION->SetPageProperty('show_courses', 'true');
?>
<?
  $APPLICATION->SetPageProperty('body_class', "directions");
  if(intval($_GLOBALS['currentCatalogSection'])>0):
    $APPLICATION->SetTitle('Направления обучения');
    $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "directions", array(
        "IBLOCK_TYPE"  => "news",
        "IBLOCK_ID"    => "4",
        "TOP_DEPTH"    => "1",
        "CACHE_TYPE"   => "A",
        "CACHE_NOTES"  => $_GLOBALS['currentCatalogSection']
    ),
    false);
    $APPLICATION->IncludeComponent(
    "bitrix:news.list", 
    "directions",
      array(
        "IBLOCK_ID"      => 4,
        "NEWS_COUNT"     => "10",
        "SORT_BY1"       => "NAME",
        "SORT_ORDER1"    => "ASC",
        "DETAIL_URL"     => "/press/#ELEMENT_CODE#/",
        "CACHE_TYPE"     => "A",
        "SET_TITLE"      => "N",
        "PROPERTY_CODE"  => array("DATA", "DESCRIPTION", "CODE"),
        "PARENT_SECTION" => $_GLOBALS['currentCatalogSection']
      ),
    false
  );
  endif;
  ?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>