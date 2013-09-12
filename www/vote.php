<?php

	require_once '../include.php';
	$smarty->validateReferral();

	$data = new DaoSuggestion;
	if (array_key_exists('id', $_GET))
	{
		$id = (int)$_GET['id'];
		if ($data->get($id) > 0)
		{
			$vote = new DaoVote;
			$vote->sugg1 = $id;
			if ($vote->tryInsert())
			{
				$data->thumbsUp++;
				$data->update();
			}
		}
	}

	$smarty->redirectBack();

?>
