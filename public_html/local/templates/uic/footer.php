	</div>
	<div class="page__sidebar">
		<div class="page__picture" style="background-image: url(<?=$_GLOBALS['BG_IMAGE']?>)"></div>
		<div class="page__sidebar-content">
			<?if(!$APPLICATION->GetPageProperty('hide_application')):?>
			<a href="/application/" class="block block--application">
				<span class="block__content">
					<?=svg('application')?>
					Заполнить заявку<br>на обучение
				</span>
			</a>
			<?endif;?>
			<?if(!$APPLICATION->GetPageProperty('hide_shedule')):?>
			<a href="/shedule/" class="block block--shedule">
				<span class="block__content">
					<?=svg('shedule')?>
					Расписание<br>обучения
				</span>
			</a>
			<?endif;?>
			<?if($APPLICATION->GetPageProperty('show_courses')):?>
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
			<?endif;?>
			<?if($APPLICATION->GetPageProperty('show_news')):?>
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
				    "CLASS"       => "news",
				    "MORE_LINK"  => "/press/",
				    "MORE_TEXT"  => "Все новости"
				  ),
				  false
				);?>
			</div>
			<?endif;?>
			
		</div>
	</div>
</div>
<?
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>