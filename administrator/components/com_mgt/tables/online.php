<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableMgtOnline extends Table
{
    var $id = null;
    var $dat = null;
    var $vehicle_id = null;
    var $route = null;
    var $tm = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mgt_routes', 'id', $db);
	}
}