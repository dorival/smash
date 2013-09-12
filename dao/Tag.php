<?php
/**
 * Table Definition for Tag
 */
require_once 'MyDataObject.php';

class DaoTag extends MyDataObject
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'Tag';                             // table name
    public $id;                              // int(10)  not_null primary_key unsigned auto_increment
    public $name;                            // string(60)  not_null
    public $lcName;                          // string(60)  not_null multiple_key

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DaoTag',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

	function resolve($tagText)
	{
		$new = new DaoTag;
		$new->lcName = mb_strtolower($tagText);
		if ($new->find(true))
			return $new;
		else
			return NULL;
	}

	function provide($tagText)
	{
		$new = new DaoTag;
		$new->lcName = mb_strtolower($tagText);
		if ($new->find(true) == 0)
		{
			$new->name = $tagText;
			$new->insert();
		}
		return $new;
	}

	function provideMany($commaSeparatedTags)
	{
		$result = array();
		foreach (explode(',', $commaSeparatedTags) as $tag)
		{
			$tag = trim($tag);
			if (strlen($tag) > 0)
				$result[] = DaoTag::provide($tag)->toArray();
		}
		return $result;
	}
}