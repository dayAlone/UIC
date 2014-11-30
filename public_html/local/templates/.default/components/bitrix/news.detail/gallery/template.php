<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="gallery">
	<div class="gallery__title">
		<span>фотогалерея</span>
	</div>
	<div class="gallery__slider">
    <?foreach ($arResult['PHOTOS'] as $img):?><div class="gallery__item"><a href="<?=$img['value']?>" rel="prettyPhoto[]" style="background-image: url(<?=$img['small']?>)"></a></div><? endforeach;?>
    </div>
</div>
