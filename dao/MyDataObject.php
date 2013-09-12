<?php
/**
 * Table Definition for Tag
 */
require_once 'DB/DataObject.php';

class MyDataObject extends DB_DataObject 
{
    public $__table = 'Tag';                             // table name
		
		function findRandomRow()
		{
			// before you groan at the code below, be aware that
			// it's actually the most performant according to:
			// http://akinas.com/pages/en/blog/mysql_random_row/
			$offset = mt_rand(0, $this->count()-1);
			$this->limit($offset, 1);
			return $this->find(true);
		}
}
