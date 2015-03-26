<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class="news-item">
	<span class="news-item__frame">
	    <span class="news-item__date"><?=r_date($item['ACTIVE_FROM'])?></span>
	    <?/*<span class="news-item__section"><?=$s['NAME']?></span>*/?>
	</span>
	<div class="news-item__divider"></div>
	<h1 class="news-item__title"><?=$item['NAME']?></h1>
	<div class="news-item__text">
		<?if($item["DETAIL_PICTURE"]):?>
			<img src="<?=$item["DETAIL_PICTURE"]['SRC']?>" class="pull-right news-item__image">
		<?endif;?>
		<?=$item["~DETAIL_TEXT"]?>
	</div>
	<div class="news-item__gallery" data-images='<?=json_encode($item['PROPS']["GALLERY"])?>'>
	<?foreach ($item['PROPS']["GALLERY"] as $img):?>
		<a href="#" class="news-item__small-image" style="background-image: url(<?=$img['small']?>)"></a>
	<?endforeach;?>
	</div>
	<a href="/press/" class="news-item__back"><?=svg('back')?> вернуться к списку новостей</a>
</div>
<?$this->SetViewTarget('title');
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "years_list", array(
        "IBLOCK_TYPE"  => "news",
        "IBLOCK_ID"    => "1",
        "TOP_DEPTH"    => "1",
        "CACHE_TYPE"   => "A",
        "CACHE_NOTES"  => $s['ID']
),
false);
$this->EndViewTarget();?>