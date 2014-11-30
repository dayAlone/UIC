<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('section', array('IBLOCK'=>1, 'CODE'=>'news', "NOEMPTY"=>true));
$APPLICATION->SetPageProperty('hide_right', true);
$APPLICATION->SetPageProperty('show_courses', 'true');
require($_SERVER['DOCUMENT_ROOT'].'/include/section.php');
?>
<div class="page__content">
<?

  $APPLICATION->SetPageProperty('body_class', "news");
  if(!isset($_REQUEST['ELEMENT_CODE'])||intval($_GLOBALS['currentCatalogSection'])>0):
    $APPLICATION->SetTitle('Пресс-центр');
    $APPLICATION->IncludeComponent(
    "bitrix:news.list", 
    "news",
    array(
      "IBLOCK_ID"   => 1,
      "NEWS_COUNT"  => "10",
      "SORT_BY1"    => "ACTIVE_FROM",
      "SORT_ORDER1" => "DESC",
      "DETAIL_URL"  => "/press/#ELEMENT_CODE#/",
      "CACHE_TYPE"  => "A",
      "SET_TITLE"   => "N",
      "PARENT_SECTION"  => $_GLOBALS['currentCatalogSection']
    ),
    false
  );
  else:
    $APPLICATION->SetPageProperty('show_news', 'true');
    $APPLICATION->SetPageProperty('page_title', 'Пресс-центр');
    $APPLICATION->IncludeComponent("bitrix:news.detail","detail",Array(
      "IBLOCK_ID"     => 1,
      "ELEMENT_CODE"  => $_REQUEST['ELEMENT_CODE'],
      "CHECK_DATES"   => "N",
      "IBLOCK_TYPE"   => "content",
      "SET_TITLE"     => "Y",
      "CACHE_TYPE"    => "A",
      "PROPERTY_CODE" => array("PHOTOS", "ABOUT", "ADDITIONAL"),
    
    ));
  endif;
  ?>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>