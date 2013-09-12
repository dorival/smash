<?php

	require_once '../include.php';

	$qs = $_SERVER['QUERY_STRING'];
	$args = explode('-', $qs);
	switch ($args[0])
	{
		case '':
			# if we have less than 2 items there's no point
			$data = new DaoSuggestion;
			if ($data->count() < 2)
				$smarty->redirectBack();
			else
				$smarty->page('mash');
			break;

		case 'get':
			$smarty->assign(getCandidates());
			$smarty->ajax('oneMash');
			break;

		case 'put':
			$smarty->validateReferral();
			$vote = new DaoVote;
			$vote->sugg1 = $args[1];
			$vote->sugg2 = $args[2];
			if ($vote->tryInsert(true))
			{
				$data = new DaoSuggestion;
				$data->get($args[1]);
				$data->pickedMe++;
				$data->update();
				
				$data = new DaoSuggestion;
				$data->get($args[2]);
				$data->pickedOther++;
				$data->update();
			}

			break;
	}

	function swap(&$a, &$b) { $t=$a; $a=$b; $b=$t; }

	function getCandidates()
	{
		$data = new DaoSuggestion;

		# let's take any 2 different rows
		$data->findRandomRow();
		$c1 = $data->toArray();
		do
		{
			$data = new DaoSuggestion;
			$data->findRandomRow();
			$c2 = $data->toArray();
		}
		while ($c1['id'] == $c2['id']);

		# set vote data
		$c1['vote'] = $c1['id'].'-'.$c2['id'];
		$c2['vote'] = $c2['id'].'-'.$c1['id'];

		# we have a strong order between c1 and c2, let's maybe swap
		return array('c1' => $c1, 'c2' => $c2);
	}

?>
