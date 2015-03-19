<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Контакты');
//$APPLICATION->SetPageProperty('show_news', 'true');
//$APPLICATION->SetPageProperty('show_courses', 'true');
$APPLICATION->SetPageProperty('body_class', "contacts");?>
<div class="row">
  <div class="col-lg-8">
	  <p><big><nobr><strong>Адрес: </strong>119048, Россия, г. Москва, ул. Усачева, д. 35 стр. 1</nobr><br>
<strong>Телефон: </strong><a href="tel:84956265359">8 (495) 626 53 59</a><br>
<nobr><strong>Директор: </strong>Литвинова Татьяна Александровна - <a href="tel:89160941147">+7 (916) 094 11 47</a></nobr><br>
<nobr><strong>Методист: </strong>Тютюнник Анна Сергеевна - <a href="tel:89267852245">+7 (926) 785 22 45</a></nobr><br>
<strong>Факс: </strong><a href="tel:84992455933">+7 (499) 245 59 33</a><br>
<strong>E-mail: </strong><a href="mailto:tlitvinova@uic-spektr.ru">tlitvinova@uic-spektr.ru</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:atyutyunnik@mnpo-spektr.ru">atyutyunnik@mnpo-spektr.ru</a></big><br></p>
  </div>
  <div class="col-lg-4">
    <div class="xs-left md-right"><a data-toggle="modal" data-target="#Feedback" href="#Feedback" class="no-margin-top button button--big">напишите нам</a></div>
  </div>
</div>
<div id="map" data-coords="55.723171,37.559856" class="xl-margin-top l-margin-bottom"></div>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;load=package.full" type="text/javascript"></script>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>