<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="gallery">
	<div class="gallery__title">
		<span>фотогалерея</span>
	</div>
	<div class="gallery__slider" data-images='<?=json_encode($arResult['PHOTOS'])?>'>
    <?foreach ($arResult['PHOTOS'] as $key=>$img):?><div class="gallery__item" data-index="<?=$key?>"><a href="#" style="background-image: url(<?=$img['small']?>)"></a></div><? endforeach;?>
    </div>
</div>
