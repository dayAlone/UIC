<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$rsSites = CSite::GetByID(SITE_ID);
$arSite  = $rsSites->Fetch();
$APPLICATION->SetTitle($arSite['NAME']);
$APPLICATION->SetPageProperty('body_class', "index");
?>
<div class="row">
	<div class="col-md-4">
		<div class="block block--about" subsidiary data-parent="block--courses" data-factor="1">
			<div class="block__content">
				<h1>Единственный <br>в России учебный центр</h1>
				<h3>в области автоматизированного ультразвукового контроляс применением установок: ARGOVISION, PIPE WIZARD и WELD STAR.</h3>
				<a href="/about/" class="button">О центре</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block block--courses">
			<h2>Ближайшие курсы</h2>
			<?
			global $shedule;
			$shedule = array(">=PROPERTY_START"=>date('Y-m-d')." 00:00:00");
			$APPLICATION->IncludeComponent(
			  "bitrix:news.list", 
			  "news_index",
			  array(
			    "IBLOCK_ID"   => 4,
			    "NEWS_COUNT"  => "3",
			    "FILTER_NAME" => "shedule",
			    "SORT_BY1"    => "PROPERTY_START",
			    "SORT_ORDER1" => "ASC",
			    "DETAIL_URL"  => "/shedule/",
			    "CACHE_TYPE"  => "A",
			    "SET_TITLE"   => "N",
			    "MORE_TEXT"   => "полный график обучения",
			    "PROPERTY_CODE"  => array("START"),
			    "MORE_LINK"   => "/shedule/",
			    "CLASS"       => "courses"
			  ),
			  false
			);?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="col-xs-6">
				<a href="/shedule/" class="block block--shedule" subsidiary data-parent="block--courses" data-factor="3"  data-offset="10">
					<span class="block__content">
						<?=svg('shedule')?><br>
						Расписание обучения
					</span>
				</a>
			</div>
			<div class="col-xs-6">
				<a href="/application/" class="block block--application" subsidiary data-parent="block--courses" data-factor="3"  data-offset="10">
					<span class="block__content">
						<?=svg('application')?><br>
						Заполнить заявку
					</span>
				</a>
			</div>
		</div>

		<div class="block block--counter" subsidiary data-parent="block--courses" data-factor="3"  data-offset="10">
			<div class="block__content">
				<div class="counter">
					<?
						$number = COption::GetOptionString("grain.customsettings","teach_count");
						foreach (str_split($number) as $item):?>
						<span class="counter__number"><?=$item?></span>
					<?endforeach;?>
					<span class="counter__text">Именно столько специалистов мы уже подготовили <br>в нашем центре</span>
				</div>
			</div>
		</div>
		<div class="block block--students" subsidiary data-parent="block--courses" data-factor="3"  data-offset="10">
			<div class="block__content">
				<div class="students">
					<div class="students__item">
						<span class="students__number"><?=COption::GetOptionString("grain.customsettings","teach_program")?></span>
						<span class="students__text">Образовательных программ <br>по рабочим професиям</span>
					</div>
					<div class="students__item">
						<span class="students__number"><?=COption::GetOptionString("grain.customsettings","teach_director")?></span>
						<span class="students__text">дополнительныХ программ <br>для руководителей и специалистов </span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="block block--news">
			<h2>Пресс-центр</h2>
			<?
			$APPLICATION->IncludeComponent(
			  "bitrix:news.list", 
			  "news_index",
			  array(
			    "IBLOCK_ID"   => 1,
			    "NEWS_COUNT"  => "2",
			    "SORT_BY1"    => "ACTIVE_FROM",
			    "SORT_ORDER1" => "DESC",
			    "DETAIL_URL"  => "/press/#ELEMENT_CODE#/",
			    "CACHE_TYPE"  => "A",
			    "SET_TITLE"   => "N",
			    "CLASS"       => "news"
			  ),
			  false
			);?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block block--partners" subsidiary data-parent="block--news" data-factor="1">
			<div class="block__content">
				<h4>Наши выпускники работают на объектах</h4>
				<a href="#">
					<img src="/layout/images/l1.jpg" alt="">
				</a>
				<a href="#">
					<img src="/layout/images/l2.jpg" alt="">
				</a>
			</div>
		</div>
	</div>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>