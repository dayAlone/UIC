<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Заявка на обучение');
$APPLICATION->SetPageProperty('body_class', "application");
$APPLICATION->SetPageProperty('show_news', 'true');
$APPLICATION->SetPageProperty('show_courses', 'true');
?>
<form class="application">
  <div class="application__frame">
    <div class="application__frame-title">персональные сведения</div>
    <div class="row">
      <div class="col-xs-10">
        <label for="">фамилия, имя, отчетсво</label>
        <input type="text" name="fio">
      </div>
      <div class="col-xs-2">
        <label for="">дата рождения</label>
        <input type="text" name="bith">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-2">
        <label for="">серия и номер</label>
        <input type="text" name="passport_number">
      </div>
      <div class="col-xs-2">
        <label for="">дата выдачи</label>
        <input type="text" name="passport_date">
      </div>
      <div class="col-xs-8">
        <label for="">кем выдан</label>
        <input type="text" name="passport_who">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <label for="">адрес по прописке (с индексом)</label>
        <input type="text" name="address">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">телефон</label>
        <input type="text" name="phone">
      </div>
      <div class="col-xs-6">
        <label for="">электронная почта</label>
        <input type="text" name="email">
      </div>
    </div>
  </div>
  <div class="application__frame l-margin-bottom">
    <div class="application__frame-title">сведения об обучении</div>
    <div class="row">
      <div class="col-xs-12">
        <select name="programm" class="application__chosen" data-placeholder="Выберите программу обучения">
          <option value=""></option>
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
      <div class="col-xs-12 ">
        <label for="">желаемый срок обучения</label>
        <label class="application__label application__label--small">начало</label>
        <input type="text" name="start" class="application__input application__input--small" placeholder="<?=date('d.m.Y')?>">
        <label class="application__label application__label--small">окончание</label>
        <input type="text" name="end" class="application__input application__input--small" placeholder="<?=date('d.m.Y')?>">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <label for="">Дата предыдущего обучения (повышении квалификации), № удостоверения, уровень допуска, кем выдано (если раннее обучался)</label>
        <input type="text" name="last_date">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-3">
      <label for="" class="application__label application__label--rows">введите, пожалуйста<br>защиный код</label>
    </div>
    <div class="col-xs-3">
      <?
        include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
        $cpt = new CCaptcha();
        $cpt->SetCodeLength(4);
        $cpt->SetCode();
        $code=$cpt->GetSID();
      ?>
      <div class="captcha" style="background-image:url(/include/captcha.php?captcha_sid=<?=$code?>)"></div>
      <input type="hidden" name="captcha_code" value="<?=$code?>">
      <a href="#" class="captcha_refresh">
        <?=svg('refresh')?>
      </a>
    </div>
    <div class="col-xs-3">
      <label class="application__label application__label--small">сюда</label>
      <input type="text"  class="application__input application__input--small">
    </div>
    <div class="col-xs-3">
      <input type="submit" value="отправить заявку">
    </div>
  </div>
</form>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>