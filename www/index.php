<?php

	require_once '../include.php';

	$sugg = new DaoSuggestion;

	if (array_key_exists('tag', $_GET))
	{
		$tag = DaoTag::resolve($_GET['tag']);
		if ($tag != NULL)
		{
			$sugg->addTagFilter($tag->id);
			$smarty->assign('tag', $tag->toArray());
		}
		else
			$smarty->redirectBack();
	}
	else
		$smarty->assign('tag', false);
	$sugg->selectAs();
	$sugg->orderBy('thumbsUp DESC');
	$sugg->find();

	$items = array();
	while ($sugg->fetch())
		# append the row
		$items[] = $sugg->toArray();

	$smarty->assign('items', $items);
	$smarty->page('index');

?>