<?php

	require_once '../include.php';

	if ($smarty->isAdmin() == false)
		$smarty->redirect('index.php');

	$data = new DaoSuggestion;

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$data->setFrom($_POST);
		imgUpload($_FILES['image'], $data);
		$data->upsertById($_POST['id']);
		$data->setTags($_POST['tags']);
		$smarty->assign('tags', $_POST['tags']);
	}
	else if (array_key_exists('id', $_GET) && $_GET['id'] > 0)
	{
		if (!$data->get($_GET['id']))
		{
			# not found, reset id
			$data->id = 0;
		}
	}

	if ($data->id == 0)
		$data->whenAdded = date('Y-m-d');

	$smarty->assign($data->toArray());
	$smarty->page('edit');

	function imgUpload($fileUpload, $data)
	{
		if (count($fileUpload) == 0)
			return NULL;

		$upload = new UploadedFile($fileUpload);
		$image = $upload->toImage();
		if ($image == NULL)
			return NULL;

		$data->imgFilename = $image->toResizedAndCroppedAndSaved(300);
		$data->thumbFilename = $image->toResizedAndCroppedAndSaved(150);
	}

?>
