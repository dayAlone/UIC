<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
?>
<div class="directions-tabs">
		<?foreach ($arResult['SECTIONS'] as $key => &$item):
        ?>
		<a href="<?=$item['SECTION_PAGE_URL']?>" class="directions-tabs__item <?=($arParams['CACHE_NOTES']==$item['ID']?"directions-tabs__item--active":"")?>">
            <span class="directions-tabs__title"><?=$item['NAME']?></span>
    	</a>
    	<?endforeach;?>
</div>
<?endif;?>