<?php

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class MgtModelVehicles extends ListModel
{
    public function __construct(array $config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'srv_id',
                'unique_id',
                'num_gos',
                'num_park',
                'fail',
                'last_sync',
                'state',
                'search'
            );
        }
        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("*")
            ->from("`#__mgt_vehicles`");

        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->q("%{$search}%");
            $query->where("(`unique_id` LIKE {$search} || `num_park` LIKE {$search} || `num_gos` LIKE {$search})");
        }

        /* Сортировка */
        $orderCol  = $this->state->get('list.ordering', 'unique_id');
        $orderDirn = $this->state->get('list.direction', 'asc');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        foreach ($items as $item) {
            $arr = array();
            $url = JRoute::_("index.php?option={$this->option}&amp;task=vehicle.edit&amp;id={$item->id}");
            $arr['id'] = $item->id;
            $arr['srv_id'] = $item->srv_id;
            $arr['unique_id'] = JHtml::link($url, $item->unique_id);
            $arr['num_gos'] = $item->num_gos ?? JText::sprintf('COM_MGT_NO_DATA');
            $arr['num_park'] = $item->num_park ?? JText::sprintf('COM_MGT_NO_DATA');
            $date = JDate::getInstance($item->last_sync);
            $arr['sync'] = (!empty($item->last_sync)) ? $date->format("d.m.Y H:i:s") : JText::sprintf('COM_MGT_NO_SYNC');
            $result[] = $arr;
        }
        return $result;
    }

    protected function populateState($ordering = 'unique_id', $direction = 'asc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        parent::populateState($ordering, $direction);
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        return parent::getStoreId($id);
    }

    public function getReturnUrl(): string
    {
        $url = JRoute::_("index.php?option={$this->option}&amp;view=vehicles");
        return base64_encode($url);
    }
}
