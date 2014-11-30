<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/press/([\w-_]+)/.*#",
		"RULE" => "&ELEMENT_CODE=\$1&\$2",
		"ID" => "",
		"PATH" => "/press/index.php",
	),
	array(
		"CONDITION" => "#^/directions/([\w-_]+)/.*#",
		"RULE" => "&ELEMENT_CODE=\$1&\$2",
		"ID" => "",
		"PATH" => "/directions/index.php",
	)
);

?>