<?if(count($arResult['ITEMS'])>0):?>
<div class="shedule">
    <?foreach ($arResult['ITEMS'] as $item):?>
	  <div class="shedule__item">
	  	<div class="row">
	  		<div class="col-md-2">
	  			<div class="row">
	  				<div class="col-sm-3 col-md-12">
			  			<div class="shedule__label">
			  				Начало
			  			</div>
			  			<div class="shedule__value">
			  				<?=date('d.m.Y', strtotime($item['PROPERTIES']['START']["VALUE"]))?>
			  			</div>
		  			</div>
		  			<div class="col-sm-4 col-md-12">
			  			<div class="shedule__label">
			  				Конец
			  			</div>
			  			<div class="shedule__value">
			  				<?=date('d.m.Y', strtotime($item['PROPERTIES']['END']["VALUE"]))?>
			  			</div>
			  		</div>
	  			</div>
	  			<div class="shedule__divider visible-sm visible-xs"></div>
	  		</div>
	  		<div class="col-md-10">
	  			<div class="shedule__label">
	  				наименование программы (курса) обучения
	  			</div>
	  			<p><a href="/directions/<?=$item['CODE']?>/"><?=$item['NAME']?></a></p>
	  			
	  			<?
	  			foreach ($item['PROPERTIES']['GROUPS']['VALUE'] as $g):?>
	  			<div class="shedule__divider"></div>	
	  			<div class="row shedule__group">
	  				<div class="col-xs-2">
	  					<div class="shedule__label">№ группы</div>
	  					<?=$g['t_number']?>
	  				</div>
	  				<div class="col-xs-3 center">
	  					<div class="shedule__label">Теория</div>
	  					<?=$g['t_theory']?>
	  				</div>
	  				<div class="col-xs-3 center">
	  					<div class="shedule__label">практика</div>
	  					<?=$g['t_practice']?>
	  				</div>
	  				<div class="col-xs-3 center">
	  					<div class="shedule__label">экзамен (зачет)</div>
	  					<?=$g['t_exam']?>
	  				</div>
	  			</div>
	  			<?endforeach;?>
	  		</div>
	  	</div>
	  </div>
	<?endforeach;?>
</div>
<?endif;?>
<?=$arResult["NAV_STRING"]?>