<?php

	require_once '../include.php';

	$items = array();
	$sugg = new DaoSuggestion;
	if (array_key_exists('id', $_GET) && $sugg->get($_GET['id']))
	{
		$smarty->assign($sugg->toArray());
		$smarty->page('item');
	}
	else
	{
		$smarty->redirectBack();
	}

?>
