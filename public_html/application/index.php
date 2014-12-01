<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Заявка на обучение');
$APPLICATION->SetPageProperty('body_class', "application");
$APPLICATION->SetPageProperty('show_news', 'true');
$APPLICATION->SetPageProperty('show_courses', 'true');
?>
<form class="application">
  <div class="application__frame">
    <div class="application__frame-title">сведения о компании</div>
    <div class="row">
      <div class="col-xs-12">
        <label for="">полное наименование организации</label>
        <input type="text" name="company">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">фамилия, имя, отчетсво руководителя</label>
        <input type="text" name="director">
      </div>
      <div class="col-xs-6">
        <label for="">на основании какого документы действует</label>
        <input type="text" name="director_document">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <label for="">адрес организции (с индексом)</label>
        <input type="text" name="address">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">
        <label for="">инн</label>
        <input type="text" name="inn">
      </div>
      <div class="col-xs-3">
        <label for="">кпп</label>
        <input type="text" name="kpp">
      </div>
      <div class="col-xs-3">
        <label for="">банк</label>
        <input type="text" name="bank">
      </div>
      <div class="col-xs-3">
        <label for="">бик</label>
        <input type="text" name="bik">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">расчетный счет</label>
        <input type="text" name="current_account">
      </div>
      <div class="col-xs-6">
        <label for="">корреспондентский счет</label>
        <input type="text" name="bank_account">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">телефон</label>
        <input type="text" name="phone">
      </div>
      <div class="col-xs-6">
        <label for="">факс</label>
        <input type="text" name="fax">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">ФИО контактного лица</label>
        <input type="text" name="fio">
      </div>
      <div class="col-xs-6">
        <label for="">контактный телефон</label>
        <input type="text" name="contact_phone">
      </div>
    </div>
  </div>
  <div class="application__frame application__frame--short"><div class="application__frame-title">сведения об обучении</div></div>
  <div class="application__tabs">
    <div class="row no-gutter">
      <div class="col-xs-3"><a href="#tab1" class="application__tabs-item application__tabs-item--active">Обучение <br>(повышение квалификации) по программе:</a></div>
      <div class="col-xs-9"><a href="#tab2" class="application__tabs-item ">Повышение квалификации по программе “методы наразрушающего контроля: автоматизированный ультразвуковой контроль при строительстве объектов промысловых и магистральных газопроводов ОАО ”газпром”</a></div>
    </div>
  </div>
  <div class=" l-margin-bottom application__frame application__tabs-content" id="tab1">
    <div class="row">
      <div class="col-xs-12">
        <select name="programm" class="application__chosen" data-placeholder="Выберите программу обучения">
          <option value=""></option>
          <?
             $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "select", array(
                "IBLOCK_TYPE"  => "news",
                "IBLOCK_ID"    => "4",
                "TOP_DEPTH"    => "2",
                "CACHE_TYPE"   => "A"
            ),
            false);
          ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-2">
        <label for="">кол-во человек</label>
        <input type="text" name="count">
      </div>
      <div class="col-xs-9 col-xs-offset-1">
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
  <div class=" l-margin-bottom application__frame application__tabs-content application__tabs-content--disable" id="tab2">
    <div class="row">
      <div class="col-xs-4">
        <label class="application__label application__label--small">на базе установки аузк </label>
      </div>
      <div class="col-xs-8">
        <input type="radio" id="type1">
        <label class="application__label application__label--small" for="type1">argovision</label>
        <input type="radio" id="type2">
        <label class="application__label application__label--small" for="type2">pipe wizard</label>
        <input type="radio" id="type3">
        <label class="application__label application__label--small" for="type3">weld star</label>
      </div>
    </div>
    <div class="application__divider"></div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">фио слушателя</label>
        <input type="text" name="fio">
      </div>
      <div class="col-xs-6">
        <label for="">профессия (должность) слушателя</label>
        <input type="text" name="count">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">имеющийся уровень по узк</label>
        <input type="text" name="fio">
      </div>
      <div class="col-xs-6">
        <label for="">номер удостоверения по узк и дата выдачи</label>
        <input type="text" name="count">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label for="">опыт работы по узк</label>
        <input type="text" name="count">
      </div>
      <div class="col-xs-6">
        <label for="">желаемый срок обучения</label>
        <label class="application__label application__label--small xxs-margin-left">начало</label>
        <input type="text" name="start" class="application__input application__input--small" placeholder="<?=date('d.m.Y')?>">
        <label class="application__label application__label--small">окончание</label>
        <input type="text" name="end" class="application__input application__input--small" placeholder="<?=date('d.m.Y')?>">
      </div>
    </div>
    <small>
      Требования, предъявляемые к дефектоскопистам (специалистам), направленным на курсы повышения квалификации по автоматизированному ультразвуковому контролю:<br>
      - специалисты должны быть аттестованны в соответствии с ПБ 03-440-02 «Правилами аттестации персонала в области неразрушающего  контроля» по ультразвуковому методу НК на 2 уровень допуска;<br>
      - иметь опыт работы не менее 3 лет в области НК;<br>
      - рекомендуется иметь среднее профессиональное или высшее профильное образование.<br>
    </small>
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