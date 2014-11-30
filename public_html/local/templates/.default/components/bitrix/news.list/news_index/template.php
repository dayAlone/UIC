<?if(count($arResult['ITEMS'])>0):?>
<div class="<?=$arParams['CLASS']?>">
    <?foreach ($arResult['ITEMS'] as $item):?>
	  <div class="<?=$arParams['CLASS']?>__item">
	    <div class="<?=$arParams['CLASS']?>__date"><span><?=r_date((isset($item['ACTIVE_FROM'])?$item['ACTIVE_FROM']:$item['PROPERTIES']['START']['VALUE']))?></span></div>
	    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="<?=$arParams['CLASS']?>__title"><?=$item['NAME']?></a>
	  </div>
	<?endforeach;?>
	<?if(isset($arParams['MORE_TEXT'])):?>
	<a href="<?=$arParams['MORE_LINK']?>" class="<?=$arParams['CLASS']?>__more"><?=svg('arrow4')?> <?=$arParams['MORE_TEXT']?></a>
	<?endif;?>
</div>
<?endif;?>