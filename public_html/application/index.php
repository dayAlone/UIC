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
  <input type="hidden" name="form" value="ur">
  <input type="hidden" name="group_id" value="5">
  <div class="application__frame">
    <div class="application__frame-title">сведения о компании</div>
    <div class="row">
      <div class="col-xs-12">
        <label >Полное наименование организации</label>
        <input required type="text" name="company">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label >фамилия, имя, отчетсво руководителя</label>
        <input required type="text" name="director">
      </div>
      <div class="col-xs-6">
        <label >на основании какого документы действует</label>
        <input required type="text" name="director_document">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <label >адрес организции (с индексом)</label>
        <input required type="text" name="address">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">
        <label >инн</label>
        <input required type="text" name="inn">
      </div>
      <div class="col-xs-3">
        <label >кпп</label>
        <input required type="text" name="kpp">
      </div>
      <div class="col-xs-3">
        <label >банк</label>
        <input required type="text" name="bank">
      </div>
      <div class="col-xs-3">
        <label >бик</label>
        <input required type="text" name="bik">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label >расчетный счет</label>
        <input required type="text" name="current_account">
      </div>
      <div class="col-xs-6">
        <label >корреспондентский счет</label>
        <input required type="text" name="bank_account">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label >телефон</label>
        <input required type="text" name="phone" data-parsley-pattern="/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}/" data-parsley-trigger="change">
      </div>
      <div class="col-xs-6">
        <label >факс</label>
        <input required type="text" name="fax" data-parsley-pattern="/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}/" data-parsley-trigger="change">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label >ФИО контактного лица</label>
        <input required type="text" name="fio">
      </div>
      <div class="col-xs-6">
        <label >контактный телефон</label>
        <input required type="text" name="contact_phone" data-parsley-pattern="/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}/" data-parsley-trigger="change">
      </div>
    </div>
  </div>
  <div class="application__frame application__frame--short"><div class="application__frame-title">сведения об обучении</div></div>
  <div class="application__tabs">
    <div class="row no-gutter">
      <div class="col-xs-3"><a href="#tab1" class="application__tabs-item application__tabs-item--active">
        <input type="radio" name="type" checked value="1">
        Обучение <br>(повышение квалификации) по программе:</a></div>
      <div class="col-xs-9"><a href="#tab2" class="application__tabs-item ">
        <input type="radio" name="type" value="2">
        Повышение квалификации по программе “методы наразрушающего контроля: автоматизированный ультразвуковой контроль при строительстве объектов промысловых и магистральных газопроводов ОАО ”газпром”</a></div>
    </div>
  </div>
  <div class=" l-margin-bottom application__frame application__tabs-content" id="tab1">
    <div class="row">
      <div class="col-xs-12">
        <select name="programm" required class="application__chosen" data-placeholder="Выберите программу обучения">
          <option value=""></option>
          <?
             $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "select", array(
                "IBLOCK_TYPE"  => "news",
                "IBLOCK_ID"    => "4",
                "TOP_DEPTH"    => "2",
                "CACHE_TYPE"   => "A",
                "TYPE"         => "ur",
                "CACHE_NOTES"  => $_REQUEST['id']
            ),
            false);
          ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-2">
        <label >кол-во человек</label>
        <input required type="text" name="count">
      </div>
      <div class="col-xs-9 col-xs-offset-1">
        <label >желаемый срок обучения</label>
        <label class="application__label application__label--small">начало</label>
        <input required type="text" name="date_start" class="application__input application__input--small" data-provide="datepicker" data-date-format="dd.mm.yyyy" data-date-language="ru" placeholder="<?=date('d.m.Y')?>">
        <label class="application__label application__label--small">окончание</label>
        <input required type="text" name="date_end" class="application__input application__input--small" data-provide="datepicker" data-date-format="dd.mm.yyyy" data-date-language="ru" placeholder="<?=date('d.m.Y')?>">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <label >Дата предыдущего обучения (повышении квалификации), № удостоверения, уровень допуска, кем выдано (если раннее обучался)</label>
        <input required type="text" name="last_education">
      </div>
    </div>
  </div>
  <div class=" l-margin-bottom application__frame application__tabs-content application__tabs-content--disable" id="tab2">
    <div class="row">
      <div class="col-xs-4">
        <label class="application__label application__label--small">на базе установки аузк </label>
      </div>
      <div class="col-xs-8">
        <input type="radio" id="type1" name="base">
        <label class="application__label application__label--small" for="type1" value="argovision">argovision</label>
        <input type="radio" id="type2" name="base">
        <label class="application__label application__label--small" for="type2" value="pipe wizard">pipe wizard</label>
        <input type="radio" id="type3" name="base">
        <label class="application__label application__label--small" for="type3" value="weld star">weld star</label>
      </div>
    </div>
    <div class="application__divider"></div>
    <div class="row">
      <div class="col-xs-6">
        <label >фио слушателя</label>
        <input type="text" name="fio2">
      </div>
      <div class="col-xs-6">
        <label >профессия (должность) слушателя</label>
        <input type="text" name="profession">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label >имеющийся уровень по узк</label>
        <input type="text" name="level">
      </div>
      <div class="col-xs-6">
        <label >номер удостоверения по узк и дата выдачи</label>
        <input type="text" name="number">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <label >опыт работы по узк</label>
        <input type="text" name="skills">
      </div>
      <div class="col-xs-6">
        <label >желаемый срок обучения</label>
        <label class="application__label application__label--small xxs-margin-left">начало</label>
        <input type="text" name="date_start2" class="application__input application__input--small"  data-provide="datepicker" data-date-format="dd.mm.yyyy" data-date-language="ru" placeholder="<?=date('d.m.Y')?>">
        <label class="application__label application__label--small">окончание</label>
        <input type="text" name="date_end2" class="application__input application__input--small"  data-provide="datepicker" data-date-format="dd.mm.yyyy" data-date-language="ru" placeholder="<?=date('d.m.Y')?>">
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
      <label  class="application__label application__label--rows">введите, пожалуйста<br>защиный код</label>
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
      <input required type="hidden" name="captcha_code" value="<?=$code?>">
      <a href="#" class="captcha_refresh">
        <?=svg('refresh')?>
      </a>
    </div>
    <div class="col-xs-3">
      <label class="application__label application__label--small">сюда</label>
      <input required type="text" name="captcha_word" class="application__input application__input--small">
    </div>
    <div class="col-xs-3">
      <input type="submit" value="отправить заявку">
    </div>
  </div>
</form>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>