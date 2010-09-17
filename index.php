<?php
	ob_start("ob_gzhandler");
	
	require_once('./include/include.php');

	$dwoo = new Dwoo();
	$tpl = new Dwoo_Template_File(TEMPLATE_DIR.'/index.tpl');
	$data = new Dwoo_Data();

	$output = 'Hello, World!';

	$data->assign('output', $output);

	$dwoo->output($tpl, $data);
?>
