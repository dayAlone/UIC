<div class="news-list">
<?
foreach ($arResult['ITEMS'] as $item):?>
  <div class="news-list__item">
  	<span class="news-list__frame">
	    <span class="news-list__date"><?=r_date($item['ACTIVE_FROM'])?></span>
	    <?/*<span class="news-list__section"><?=$arResult['SECTIONS']['PATH'][$item['IBLOCK_SECTION_ID']]?></span>*/?>
	</span>
    <div class="news-list__divider"></div>
    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="news-list__title"><?=$item['NAME']?></a>
    <div class="news-list__text"><?=$item['PREVIEW_TEXT']?></div>
  </div>
<?endforeach;?>
</div>

<?=$arResult["NAV_STRING"]?>
<?$this->SetViewTarget('title');
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "years_list", array(
        "IBLOCK_TYPE"  => "news",
        "IBLOCK_ID"    => "1",
        "TOP_DEPTH"    => "1",
        "CACHE_TYPE"   => "A",
        "CACHE_NOTES"  => $arParams['PARENT_SECTION']
),
false);
$this->EndViewTarget();?>