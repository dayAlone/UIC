<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Контакты');
$APPLICATION->SetPageProperty('body_class', "contacts");?>
<div class="row">
  <div class="col-sm-8">
    <p><big><strong>Адрес: </strong>Россия, Москва, <nobr>ул. Усачева, 35А</nobr> <br><strong>Телефон: </strong><a href="tel:88002005001 ">8 800 200 500 1</a><br><strong>E-mail: </strong><a href="mailto:info@uic-spektr.ru">info@uic-spektr.ru</a></big><br></p>
  </div>
  <div class="col-sm-4 right">
    <div class="xs-center md-right"><a data-toggle="modal" data-target="#Feedback" href="#Feedback" class="no-margin-top button button--big">напишите нам</a></div>
  </div>
</div>
<div id="map" data-coords="55.723171,37.559856" class="xl-margin-top l-margin-bottom"></div>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;load=package.full" type="text/javascript"></script>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>