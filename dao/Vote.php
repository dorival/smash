<?php
/**
 * Table Definition for Vote
 */
require_once 'MyDataObject.php';

class DaoVote extends MyDataObject
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'Vote';                            // table name
    public $id;                              // int(10)  not_null primary_key unsigned auto_increment
    public $ip;                              // int(11)  not_null multiple_key
    public $stamp;                           // timestamp(19)  not_null unsigned zerofill binary timestamp
    public $sugg1;                           // int(10)  multiple_key unsigned
    public $sugg2;                           // int(10)  multiple_key unsigned
    public $geoCountry;                      // string(6)  
    public $geoRegion;                       // string(6)  
    public $geoCity;                         // string(765)  
    public $geoLat;                          // real(12)  
    public $geoLon;                          // real(12)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DaoVote',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

		function setIp($strIp) { $this->ip = ip2long($strIp); }
		function getIp() { return long2ip($this->ip); }

		function tryInsert($forceCount=false)
		{
			$this->setIp($_SERVER['REMOTE_ADDR']);
			$this->geoCountry = $_SERVER['GEOIP_COUNTRY_CODE'];
			$this->geoRegion  = $_SERVER['GEOIP_REGION'];
			$this->geoCity    = $_SERVER['GEOIP_CITY'];
			$this->geoLat     = $_SERVER['GEOIP_LATITUDE'];
			$this->geoLon     = $_SERVER['GEOIP_LONGITUDE'];
			$search = new DaoVote;
			$search->ip    = $this->ip;
			$search->sugg1 = $this->sugg1;
			if ($this->sugg2 === NULL)
				$search->whereAdd('sugg2 IS NULL');
			else
				$search->sugg2 = $this->sugg2;
			$search->whereAdd('stamp > DATE_SUB(NOW(), INTERVAL 1 DAY)');

			$alreadyVoted = $search->count();
			if (!$alreadyVoted)
				$this->insert();
			else if ($forceCount)
			{
				$this->sugg1 = $this->sugg2 = NULL;
				$this->insert();
			}
			return !$alreadyVoted;
		}
}
