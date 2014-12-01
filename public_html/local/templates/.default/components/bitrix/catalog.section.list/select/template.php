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

<?$this->SetViewTarget('title');?>
<span class="dropdown">
	<?if($arParams['TYPE']=="ur"):?>
	<a href="#" class="dropdown__trigger"><span class="dropdown__text dropdown__text--white">от юридического лица</span><?=svg('arrow')?></a>
	<?else:?>
	<a href="#" class="dropdown__trigger"><span class="dropdown__text dropdown__text--white">от физического лица</span><?=svg('arrow')?></a>
	<?endif;?>
	<span class="dropdown__frame">
		<a href="/application/" <?=($arParams["TYPE"]=='ur'?'style="display:none"':'')?> class="dropdown__item">от юридического лица</a>
		<a href="/application/individual/" <?=($arParams["TYPE"]=='ind'?'style="display:none"':'')?> class="dropdown__item">от физического лица</a>
	</span>
	<select class="dropdown__select">
		<option value="/application/">от юридического лица</option>
		<option value="/application/individual/">от физического лица</option>
	</select>
</span>
<?$this->EndViewTarget();?>