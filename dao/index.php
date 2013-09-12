<?php

	require_once 'Suggestion.php';
	require_once 'SuggestionTag.php';
	require_once 'Tag.php';
	require_once 'Vote.php';
	#DB_DataObject::debugLevel(5);
	foreach (parse_ini_file('db.ini', TRUE) as $class => $values)
	{
		foreach ($values as $k=>$v)
			if ($v == '.')
				$values[$k] = dirname(__FILE__); 
		$options = &PEAR::getStaticProperty($class, 'options');
		$options = $values;
	}

?>
