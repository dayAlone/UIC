<div class="directions-list">
<?
global $ID;
$ID = false;
function showItems($items)
{
  foreach ($items as $item):
      global $ID;
      if($_REQUEST['ELEMENT_CODE']==$item['CODE'])
        $ID = $item['CODE'];
    ?>
    <div class="directions-list__item <?=($_REQUEST['ELEMENT_CODE']==$item['CODE']?"directions-list__item--open":"")?>" id="<?=$item['CODE']?>">
      <a href="#" class="directions-list__trigger">
        <?=svg('arrow-right')?>
        <?=$item['NAME']?>
      </a>
      <div class="directions-list__content <?=($_REQUEST['ELEMENT_CODE']==$item['CODE']?"directions-list__content--open":"")?>">
        <div class="row">
          <div class="col-xs-2">
          <?if(strlen($item['PROPERTIES']['CODE']['VALUE']['TEXT'])>0):?>
            <div class="directions-list__code">
              <div class="directions-list__label">Код<br>профессии</div>
              <div class="directions-list__value"><?=$item['PROPERTIES']['CODE']['VALUE']?></div>
            </div>
          <?endif;?>
          <a class="directions-list__application" data-target="#checkType" data-toggle="modal" href="#checkType" data-id="<?=$item['ID']?>"><?=svg('application')?><br>заполнить заявку <br>на этот <br>курс</a>
          </div>
          <div class="col-xs-10">
          <?
          if(count($item['PROPERTIES']['DATA']['VALUE'])==1 && strlen($item['PROPERTIES']['DATA']['VALUE'][0]['p_theory'])>0 && strlen($item['PROPERTIES']['DATA']['VALUE'][0]['p_practice'])==0 && strlen($item['PROPERTIES']['DATA']['VALUE'][0]['p_total'])==0 && strlen($item['PROPERTIES']['DATA']['VALUE'][0]['p_exam'])==0):?>
              <div class="row">
                <div class="col-xs-12">
                  <div class="directions-list__label">количество часов по программе</div>
                  <div class="directions-list__value"><?=$item['PROPERTIES']['DATA']['VALUE'][0]['p_theory']?></div>
                </div>
              </div>
              <?if(strlen($item['PROPERTIES']['DESCRIPTION']['VALUE']['TEXT'])>0):?>
              <div class="directions-list__divider directions-list__divider--small"><span></span></div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="directions-list__label directions-list__label--black">Примечание</div>
                  <div class="directions-list__description"><?= htmlspecialchars_decode($item['PROPERTIES']['DESCRIPTION']['VALUE']['TEXT'])?></div>
                </div>
              </div>
              <?endif;?>
            </div>
          </div>
          <?else:?>
            <?foreach ($item['PROPERTIES']['DATA']['VALUE'] as $prop):
            ?>
            <?if(strlen($prop['p_title'])>0):?><div class="directions-list__section-title"><?=$prop['p_title']?></div><?endif;?>
            <div class="row">
              <?if(strlen($prop['p_theory'])>0):?>
                <div class="col-xs-3">
                  <div class="directions-list__label"><?=($prop['p_check']!='Y'?"Теория":"Теоретическое<br>обучение")?></div>
                  <div class="directions-list__value"><?=$prop['p_theory']?></div>
                </div>
                <?endif;?>
                <?if(strlen($prop['p_practice'])>0):?>
                <div class="col-xs-3">
                  <div class="directions-list__label"><?=($prop['p_check']!='Y'?"Практика":"производственное<br>обучение")?></div>
                  <div class="directions-list__value"><?=$prop['p_practice']?></div>
                </div>
                <?endif;?>
                <?if(strlen($prop['p_total'])>0):?>
                <div class="col-xs-3">
                  <div class="directions-list__label">Всего<?=($prop['p_check']!='Y'?"":"<br>&nbsp;")?></div>
                  <div class="directions-list__value"><?=$prop['p_total']?></div>
                </div>
                <?endif;?>
                <?if(strlen($prop['p_exam'])>0):?>
                <div class="col-xs-3">
                  <div class="directions-list__label">Экзамен<?=($prop['p_check']!='Y'?"":"<br>&nbsp;")?></div>
                  <div class="directions-list__value"><?=$prop['p_exam']?></div>
                </div>
                <?endif;?>
            </div>
            <?endforeach;?>
              </div>
            </div>
            <?if(strlen($item['PROPERTIES']['DESCRIPTION']['VALUE']['TEXT'])>0):?>
            <div class="directions-list__divider <?=(count($item['PROPERTIES']['DATA']['VALUE'])==1?"directions-list__divider--top":"")?>"><span></span></div>
            <div class="row">
              <div class="col-xs-2">
                <div class="directions-list__label directions-list__label--black">Примечание</div>
              </div>
              <div class="col-xs-10">
                <div class="directions-list__description"><?= htmlspecialchars_decode($item['PROPERTIES']['DESCRIPTION']['VALUE']['TEXT'])?></div>
              </div>
            </div>
            <?endif;?>
        <?endif;?>
      </div>
    </div>
  <?endforeach;
}
if(isset($arResult['DATA']))
  foreach($arResult['DATA'] as $item):
      $open = false;
      foreach ($item['ITEMS'] as $z)
        if($z['CODE']==$_REQUEST['ELEMENT_CODE'])
          $open = true;
    ?>
      <div class="directions-list__section <?=($open?"directions-list__section--open":"")?>" id="<?=$item['CODE']?>">
        <a href="#" class="directions-list__trigger">
          <?=svg('arrow-right')?>
          <?=$item['NAME']?>
        </a>
        <div class="directions-list__content  <?=($open?"directions-list__content--open":"")?>">
          <? showItems($item['ITEMS']);?>
        </div>
      </div>
    <?
  endforeach;
else
  showItems($arResult['ITEMS']);
?>
</div>
<?$this->SetViewTarget('footer');?>
<div id="checkType" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content modal-content--white"><a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
      <div class="types">
        <div class="types__title">
          Выберите тип слушателя
        </div>
        <div class="row">
          <div class="col-xs-6">
            <a href="/application/" class="types__item">Юридическое лицо</a>
          </div>
          <div class="col-xs-6">
            <a href="/application/individual/" class="types__item types__item--red">Физическое лицо</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?if(strlen($ID)>0):?>
<script>
  $(function(){
    offset = $("#<?=$ID?>").offset()
    $('body').velocity("scroll", {'offset': offset.top});
  })
</script>
<?endif?>
<?$this->EndViewTarget();?>