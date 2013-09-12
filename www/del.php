<?php

	require_once '../include.php';

	if ($smarty->isAdmin())
	{
		$data = new DaoSuggestion;
		$data->id = $_GET['id'];
		if ($data->id > 0)
			$data->delete();
	}
	$smarty->redirect('index.php');

?>
