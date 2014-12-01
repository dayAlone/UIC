<?
global $APPLICATION;
$aMenuLinks = $APPLICATION->IncludeComponent("radia:menu.sections","",Array(
        "IS_SEF" => "Y", 
        "SEF_BASE_URL" => "/directions/", 
        "SECTION_PAGE_URL" => "/", 
        "DETAIL_PAGE_URL" => "#ELEMENT_CODE#/", 
        "IBLOCK_TYPE" => "news", 
        "IBLOCK_ID" => "4", 
        "DEPTH_LEVEL" => "3", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "36000" 
    )
);
?>