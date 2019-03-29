<?php
defined('_JEXEC') or die;

class MgtHelper
{
    public static function canDo(string $action, string $option = 'com_mgt'): bool
    {
        return JFactory::getUser()->authorise($action, $option);
    }

	public function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(JText::sprintf('COM_MGT'), 'index.php?option=com_mgt&view=mgt', $vName == 'mgt');
		JHtmlSidebar::addEntry(JText::sprintf('COM_MGT_MENU_VEHICLES'), 'index.php?option=com_mgt&view=vehicles', $vName == 'vehicles');
	}

    public static function getVehicleType(int $srv_id): int
    {
        if ($srv_id < 100) return 0;
        if ($srv_id >= 100 && $srv_id < 200) return 1;
        if ($srv_id > 200) return 2;
	}

    public static function getVehicleTypeText(int $type = 0): string
    {
        return JText::sprintf("COM_MGT_VEHICLE_TYPE_{$type}");
	}

	public static function getActionUrl(): string
    {
        $uri = JUri::getInstance();
        $query = $uri->getQuery();
        $client = (!JFactory::getApplication()->isClient('administrator')) ? 'site' : 'administrator';
        return JRoute::link($client, "index.php?{$query}");
    }
}
