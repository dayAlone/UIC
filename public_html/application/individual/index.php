<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Заявка на обучение');
$APPLICATION->SetPageProperty('body_class', "application");
$APPLICATION->SetPageProperty('show_courses', 'true');
$APPLICATION->SetPageProperty('hide_application', 'true');
?>
<div class="center success hidden">
  <p class="highlight">
    <big>Спасибо!</big><br>
    Заявка успешно отправлена. В скором времени наш специалист с вами свяжется.
  </p>
</div>
<form class="application" data-parsley-validate>
  <input type="hidden" name="form" value="fix">
  <input type="hidden" name="group_id" value="5">
  <div class="application__frame">
    <div class="application__frame-title">персональные сведения</div>
    <div class="row">
      <div class="col-sm-10">
        <label for="">фамилия, имя, отчество</label>
        <input required type="text" name="fio">
      </div>
      <div class="col-sm-2">
        <label for="">дата рождения</label>
        <input required type="text" name="bith" data-provide="datepicker" data-date-format="dd.mm.yyyy" data-date-language="ru">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">
        <label for="">серия и номер</label>
        <input required type="text" name="passport_number">
      </div>
      <div class="col-sm-2">
        <label for="">дата выдачи</label>
        <input required type="text" name="passport_date">
      </div>
      <div class="col-sm-8">
        <label for="">кем выдан</label>
        <input required type="text" name="passport_who">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <label for="">адрес по прописке (с индексом)</label>
        <input required type="text" name="address">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <label for="">телефон</label>
        <input required type="text" name="phone" data-parsley-pattern="/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}/" data-parsley-trigger="change">
      </div>
      <div class="col-sm-6">
        <label for="">электронная почта</label>
        <input required type="email" name="email">
      </div>
    </div>
  </div>
  <div class="application__frame l-margin-bottom">
    <div class="application__frame-title">сведения об обучении</div>
    <div class="row">
      <div class="col-sm-12">
        <select required name="programm" class="application__chosen" data-placeholder="Выберите программу обучения">
          <option value="">Выберите программу обучения</option>
          <?
             $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "select", array(
                "IBLOCK_TYPE"  => "news",
                "IBLOCK_ID"    => "4",
                "TOP_DEPTH"    => "2",
                "CACHE_TYPE"   => "A",
                "TYPE"         => "ind",
                "CACHE_NOTES"  => $_REQUEST['id']
            ),
            false);
          ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 ">
        <label for="">желаемый срок обучения</label>
        <label class="application__label application__label--small">начало</label>
        <input type="text" name="date_start" class="application__input application__input--small"  data-provide="datepicker" data-date-format="dd.mm.yyyy" data-date-language="ru" placeholder="<?=date('d.m.Y')?>">
        <label class="application__label application__label--small">окончание</label>
        <input type="text" name="date_end" class="application__input application__input--small"  data-provide="datepicker" data-date-format="dd.mm.yyyy" data-date-language="ru" placeholder="<?=date('d.m.Y')?>">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <label for="">Дата предыдущего обучения (повышении квалификации), № удостоверения, уровень допуска, кем выдано (если раннее обучался)</label>
        <input required type="text" name="last_education">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-xs-5">
      <label  class="application__label application__label--rows application__label--smallest">введите, пожалуйста<br>защиный код</label>
    </div>
    <div class="col-sm-3 col-xs-7">
      <?
        include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
        $cpt = new CCaptcha();
        $cpt->SetCodeLength(4);
        $cpt->SetCode();
        $code=$cpt->GetSID();
      ?>
      <div class="captcha" style="background-image:url(/include/captcha.php?captcha_sid=<?=$code?>)"></div>
      <input required type="hidden" name="captcha_code" value="<?=$code?>">
      <a href="#" class="captcha_refresh">
        <?=svg('refresh')?>
      </a>
    </div>
    <div class="col-xs-7 col-xs-offset-5 col-sm-4">
      <label class="application__label application__label--small">сюда</label>
      <input required type="text" name="captcha_word" class="application__input application__input--small">
    </div>
    <div class="col-sm-3">
      <input type="submit" value="отправить заявку">
    </div>
  </div>
</form>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>