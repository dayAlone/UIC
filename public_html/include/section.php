<?
	if(isset($_POST['SORT_BY1']))
		$_SESSION['SORT_BY1'] = $_POST['SORT_BY1'];
	if(isset($_POST['SORT_ORDER1']))
		$_SESSION['SORT_ORDER1'] = $_POST['SORT_ORDER1'];

	$params = $APPLICATION->GetPageProperty('section');

	if(isset($_REQUEST['ELEMENT_CODE'])||isset($params['NOEMPTY'])):
		$obCache       = new CPHPCache();
		$cacheLifetime = 86400; 
		$cacheID       = $params['CODE'].'_'.$_REQUEST['ELEMENT_CODE']; 
		$cachePath     = '/'.$cacheID;

		if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) ):

		   $vars = $obCache->GetVars();
		   $_GLOBALS['currentCatalogSection'] = $vars['current'];
		   $_GLOBALS['openCatalogSection']    = $vars['open'];

		elseif( $obCache->StartDataCache() ):

			CModule::IncludeModule("iblock");
			
			$Current    = false;
			$Open       = false;

			$Sections   = array();
			$arSort     = array("SORT" => "ASC");
			$arFilter   = array("IBLOCK_ID" => $params['IBLOCK']);
			$rsSections = CIBlockSection::GetList($arSort, $arFilter);
			$First      = false;

			while ($s = $rsSections->Fetch()) {
				if(strlen($_REQUEST['ELEMENT_CODE'])>0):
					if($s['CODE']==$_REQUEST['ELEMENT_CODE']) {
						$arFilter = Array(
							"IBLOCK_ID"  => $params['IBLOCK'],
							"SECTION_ID" => $s['ID']
					    );
					    $Current = $s['ID'];
					}	
				endif;
				if(!$First)
					$First = $s;
				$Sections[] = $s['ID'];
			}
			if(strlen($_REQUEST['ELEMENT_CODE'])==0&&isset($params['NOEMPTY']))
				$Current = $Sections[0];
			$_GLOBALS['currentCatalogSection'] = $Current;
			$_GLOBALS['openCatalogSection']    = $Open;
			
			$obCache->EndDataCache(array('current' => $Current, 'open' => $Open));
		endif;
	endif;
?>