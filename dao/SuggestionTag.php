<?php
/**
 * Table Definition for SuggestionTag
 */
require_once 'MyDataObject.php';

class DaoSuggestionTag extends MyDataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'SuggestionTag';                   // table name
    public $idSuggestion;                    // int(10)  not_null primary_key unsigned
    public $idTag;                           // int(10)  not_null primary_key multiple_key unsigned

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DaoSuggestionTag',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
