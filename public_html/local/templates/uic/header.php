<?
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
?>
	<div class="row" style="<?=(isset($_COOKIE['height'])?"min-height:".($_COOKIE['height']+25)."px":"")?>">
		<div class="col-md-9 col-md-offset-3">
			<div class="row">
				<div class="col-sm-8"><h1 class="page__title"><?=$APPLICATION->AddBufferContent("page_title");?></h1></div>
				<div class="col-sm-4">
					<?$APPLICATION->ShowViewContent('title');?>
				</div>
			</div>
			<div class="page__divider"></div>
			
			
	