<?php

	require_once '../include.php';

	$test = $_POST['name'];
	if ($test)
		$test = DaoTag::resolve($test);

	$tags = array();
	$row = new DaoTag;
	$row->find();
	while ($row->fetch())
		$tags[] = $row->toArray();

	$smarty->assign('tags', $tags);
	$smarty->page('tagTest');

	print_r($test);

?>
