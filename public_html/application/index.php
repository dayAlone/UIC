<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Заявка на обучение');
$APPLICATION->SetPageProperty('body_class', "application");?>
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
</form>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>