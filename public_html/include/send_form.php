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
<table border="0">
	<tr>
		<td colspan="4"><h2>Cведения о компании</h2></td>
	</tr>
	<tr>
		<td colspan="4">
			<strong>Полное наименование организации:</strong>
				<?=$_REQUEST["company"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>фамилия, имя, отчетсво руководителя</strong>
				<?=$_REQUEST["director"]?>
		</td>
		<td colspan="2">
			<strong>на основании какого документы действует</strong>
				<?=$_REQUEST["director_document"]?>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<strong>адрес организции (с индексом)</strong>
				<?=$_REQUEST["address"]?>
		</td>
	</tr>
	<tr>
		<td>
			<strong>инн</strong>
			<?=$_REQUEST["inn"]?>
		</td>
		<td>
			<strong>кпп</strong>
			<?=$_REQUEST["kpp"]?>
		</td>
		<td>
			<strong>банк</strong>
			<?=$_REQUEST["bank"]?>
		</td>
		<td>
			<strong>бик</strong>
			<?=$_REQUEST["bik"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>расчетный счет</strong>
				<?=$_REQUEST["current_account"]?>
		</td>
		<td colspan="2">
			<strong>корреспондентский счет</strong>
				<?=$_REQUEST["bank_account"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>телефон</strong>
			<?=$_REQUEST["phone"]?>
		</td>
		<td colspan="2">
			<strong>факс</strong>
			<?=$_REQUEST["fax"]?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>ФИО контактного лица</strong>
			<?=$_REQUEST["fio"]?>
		</td>
		<td colspan="2">
			<strong>контактный телефон</strong>
			<?=$_REQUEST["contact_phone"]?>
		</td>
	</tr>
	<tr>
		<td colspan="4"><h2>Cведения об обучении</h2></td>
	</tr>
	<?if($_REQUEST['type']==1):?>
		<tr>
			<td colspan="4">
				<strong>Обучение (повышение квалификации) по программе: </strong><?=$_REQUEST['programm']?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<strong>кол-во человек</strong>
				<?=$_REQUEST["count"]?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<strong>желаемый срок обучения. начало.</strong>
				<?=$_REQUEST["date_start"]?>
			</td>
			<td colspan="2">
				<strong>окончание</strong>
				<?=$_REQUEST["date_end"]?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<strong>Дата предыдущего обучения (повышении квалификации), № удостоверения, уровень допуска, кем выдано (если раннее обучался)</strong>
				<?=$_REQUEST["last_education"]?>
			</td>
		</tr>
	<?elseif($_REQUEST['type']==2):?>
		<tr>
			<td colspan="4">
				<strong>Повышение квалификации по программе на базе установки аузк: </strong><?=$_REQUEST['base']?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<strong>фио слушателя</strong>
				<?=$_REQUEST["fio"]?>
			</td>
			<td colspan="2">
				<strong>профессия (должность) слушателя</strong>
				<?=$_REQUEST["profession"]?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<strong>имеющийся уровень по узк</strong>
				<?=$_REQUEST["level"]?>
			</td>
			<td colspan="2">
				<strong>номер удостоверения по узк и дата выдачи</strong>
				<?=$_REQUEST["number"]?>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				<strong>опыт работы по узк</strong>
				<?=$_REQUEST["skills"]?>
			</td>
			<td colspan="3">
				<strong>желаемый срок обучения.начало</strong>
				<?=$_REQUEST["date_start2"]?>
				<strong>окончание</strong>
				<?=$_REQUEST["date_end2"]?>
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