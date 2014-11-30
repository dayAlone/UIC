<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>1):?>
	<?foreach ($arResult['SECTIONS'] as $key => &$item):?>
	<optgroup label="<?=$item['NAME']?>">
		<?foreach ($item['ITEMS'] as $t):?>
			<option value="<?=$t['NAME']?>"><?=$t['NAME']?></option>
		<?endforeach;?>
	</optgroup>
	<?endforeach;?>
<?endif;?>
