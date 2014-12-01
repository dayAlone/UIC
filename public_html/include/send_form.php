<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$err = array();

if (!$GLOBALS['APPLICATION']->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_code"]))
	$err['required'][] = 'captcha_word';

if ($err) {
	$result['status'] = 'error';
	$result['errors'] = $err;
} 
else
	$result['status'] = 'ok';

if($result['status'] == 'ok') {
		
		require './mail/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->isSendmail();
		$mail->CharSet = 'UTF-8';

		if($_REQUEST['form'] == 'ur'):
		ob_start();
		?>
<table border="0" cellpadding="10" style="font-size:13px">
	<tr>
		<td colspan="4"><h2>Cведения о компании</h2></td>
	</tr>
	<tr>
		<td colspan="4">
			Полное наименование организации: <?=$_REQUEST["company"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Фамилия, имя, отчетсво руководителя: <?=$_REQUEST["director"]?>
		</td>
		<td colspan="2">
			На основании какого документы действует: <?=$_REQUEST["director_document"]?>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			Адрес организции (с индексом): <?=$_REQUEST["address"]?>
		</td>
	</tr>
	<tr>
		<td>
			ИНН: <?=$_REQUEST["inn"]?>
		</td>
		<td>
			КПП: <?=$_REQUEST["kpp"]?>
		</td>
		<td>
			Банк: <?=$_REQUEST["bank"]?>
		</td>
		<td>
			БИК: <?=$_REQUEST["bik"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Расчетный счет: <?=$_REQUEST["current_account"]?>
		</td>
		<td colspan="2">
			Корреспондентский счет: <?=$_REQUEST["bank_account"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Телефон: <?=$_REQUEST["phone"]?>
		</td>
		<td colspan="2">
			Факс: <?=$_REQUEST["fax"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			ФИО контактного лица: <?=$_REQUEST["fio"]?>
		</td>
		<td colspan="2">
			Контактный телефон: <?=$_REQUEST["contact_phone"]?>
		</td>
	</tr>
	<tr>
		<td colspan="4"><h2>Cведения об обучении</h2></td>
	</tr>
	<?if($_REQUEST['type']==1):?>
		<tr>
			<td colspan="4">
				Обучение (повышение квалификации) по программе: <?=$_REQUEST['programm']?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				Кол-во человек: <?=$_REQUEST["count"]?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				Желаемый срок обучения. начало.: <?=$_REQUEST["date_start"]?>
			</td>
			<td colspan="2">
				Окончание: <?=$_REQUEST["date_end"]?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				Дата предыдущего обучения (повышении квалификации), № удостоверения, уровень допуска, кем выдано (если раннее обучался)
				<?=$_REQUEST["last_education"]?>
			</td>
		</tr>
	<?elseif($_REQUEST['type']==2):?>
		<tr>
			<td colspan="4">
				Повышение квалификации по программе на базе установки аузк: <?=$_REQUEST['base']?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				ФИО слушателя: <?=$_REQUEST["fio"]?>
			</td>
			<td colspan="2">
				Профессия (должность) слушателя: <?=$_REQUEST["profession"]?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				Имеющийся уровень по узк: <?=$_REQUEST["level"]?>
			</td>
			<td colspan="2">
				Номер удостоверения по узк и дата выдачи: <?=$_REQUEST["number"]?>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				Опыт работы по узк: <?=$_REQUEST["skills"]?>
			</td>
			<td colspan="3">
				Желаемый срок обучения. Начало: <?=$_REQUEST["date_start2"]?><br>
				Окончание: <?=$_REQUEST["date_end2"]?>
			</td>
		</tr>
	<?endif;?>
</table>
		<?
		$body = ob_get_contents();
		ob_end_clean();
		else:

		endif;
		foreach ($_REQUEST as $key => $value)
			if($text[$key]&&strlen($value)>0)
				$body .= $text[$key].': '.nl2br($value)."<br /><br />\r\n";

		foreach ($_FILES as $key => $value):
			if($text[$key]):
				$name = $value['name'];
				$value = CFile::GetPath(CFile::SaveFile($value));
				$body .=$text[$key].': <a href="http://'.$_SERVER['HTTP_HOST'].$value.'">'.$name."</a><br /><br />\r\n";
			endif;
		endforeach;
		$body .= "<br /><hr><br />";

		$mail->Subject = "Сообщение с сайта ".$_SERVER['HTTP_HOST']; 
		$mail->setFrom("mailer@".$_SERVER['HTTP_HOST'], "Сайт ".$_SERVER['HTTP_HOST']);

		if ($result['status'] == 'ok') {
			$rs_user = CUser::GetList(
				($by = 'name'),
				($order = 'asc'),
				array(
					'GROUPS_ID' => array($_REQUEST["group_id"])
				)
			);

			while($ar_user = $rs_user->GetNext())
				$mail->addAddress($ar_user['EMAIL'], $ar_user['LOGIN']);
			
			$mail->msgHTML($body);
			$mail->send();
		}
}
print json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>