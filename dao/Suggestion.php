<?php
/**
 * Table Definition for Suggestion
 */
require_once 'MyDataObject.php';
require_once '../lib/upload.php';

class DaoSuggestion extends MyDataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'Suggestion';                      // table name
    public $id;                              // int(10)  not_null primary_key unsigned auto_increment
    public $whenAdded;                       // date(10)  not_null binary
    public $name;                            // string(150)  not_null unique_key
    public $thumbsUp;                        // int(10)  not_null multiple_key unsigned
    public $pickedMe;                        // int(10)  not_null unsigned
    public $pickedOther;                     // int(10)  not_null unsigned
    public $description;                     // blob(4294967295)  not_null blob
    public $imgFilename;                     // string(90)  
    public $thumbFilename;                   // string(90)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DaoSuggestion',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

	function upsertById($id)
	{
		if ($id > 0)
		{
			$this->id = $id;
			return $this->update();
		}
		else
			return $this->insert();
	}

	function getTags()
	{
		$result = array();
		if ($this->id > 0)
		{
			$suggTag = new DaoSuggestionTag;
			$suggTag->idSuggestion = $this->id;
			$tag = new DaoTag;
			$tag->joinAdd($suggTag);
			$tag->selectAs();
			$tag->find();
			while ($tag->fetch())
				$result[] = $tag->toArray();
		}
		return $result;
	}

	function setTags($tagsString)
	{
		$sort = function($a, $b) { return $a['id'] - $b['id']; };
		$newVals = DaoTag::provideMany($tagsString);
		$oldVals = $this->getTags();
		$valsToRemove = array_udiff($oldVals, $newVals, $sort);
		foreach ($valsToRemove as $item)
		{
			$data = new DaoSuggestionTag;
			$data->idSuggestion = $this->id;
			$data->idTag = $item['id'];
			$data->delete();
		}
		$valsToAdd = array_udiff($newVals, $oldVals, $sort);
		foreach ($valsToAdd as $item)
		{
			$data = new DaoSuggestionTag;
			$data->idSuggestion = $this->id;
			$data->idTag = $item['id'];
			$data->insert();
		}
	}

	function toArray()
	{
		$arr = parent::toArray();
		$arr['tags'] = $this->getTags();
		return $arr;
	}

	function addTagFilter($idTag)
	{
		$suggTag = new DaoSuggestionTag;
		$suggTag->idTag = $idTag;
		$this->joinAdd($suggTag);
	}
}
