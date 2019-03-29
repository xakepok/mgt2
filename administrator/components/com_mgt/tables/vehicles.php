<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableMgtVehicles extends Table
{
    var $id = null;
    var $srv_id = null;
    var $unique_id = null;
    var $num_gos = null;
    var $num_park = null;
    var $fail_sync = null;
    var $last_sync = null;
    var $state = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mgt_vehicles', 'id', $db);
	}

    public function store($updateNulls = true)
    {
        return parent::store(true);
    }
}