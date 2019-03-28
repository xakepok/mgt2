<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class MgtModelReplace extends ListModel
{
    public function __construct(array $config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'dat',
                'type',
                'route',
                'search',
                'tm',
            );
        }
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db =& $this->getDbo();
        $query = $db->getQuery(true);

        $dat = $this->getState('filter.dat');
        if (!empty($dat)) {
            $dat = $db->q($dat);
        }
        else {
            $dat = $db->q(JDate::getInstance()->format("Y-m-d"));
        }
        $query
            ->select("*")
            ->from("`#__mgt`")
            ->where("`vehicle_id` IN (select `vehicle_id` from `#__mgt` where `dat` like {$dat} group by `vehicle_id` having count(`route`) > 1)")
            ->where("`dat` like {$dat}");

        $num_park = $this->getState('filter.search');
        if (!empty($num_park)) {
            $num_park = $db->q($num_park);
            $query->where("`num_park` LIKE {$num_park}");
        }

        $route = $this->getState('filter.route');
        if (!empty($route)) {
            $route = $db->q($route);
            $query->where("`route` LIKE {$route}");
        }

        $type = $this->getState('filter.type');
        if (is_numeric($type)) {
            $query->where("`type` = {$type}");
        }

        /* Сортировка */
        $orderCol  = $this->state->get('list.ordering', 'num_park');
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
            $dat = JDate::getInstance($item->dat);
            $arr['dat'] = $dat->format("d.m.Y");
            $arr['type'] = MgtHelper::getVehicleType($item->type);
            $arr['num_park'] = (string) $item->num_park;
            $arr['route'] = $item->route;
            $sync = JDate::getInstance($item->last_sync);
            $arr['last_sync'] = $sync->format("d.m.Y H:i:s");
            if ($item->tm) $arr['tm'] = $item->tm;
            $result[] = $arr;
        }
        return $result;
    }

    protected function populateState($ordering = 'num_park', $direction = 'asc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $dat = $this->getUserStateFromRequest($this->context . '.filter.dat', 'filter_dat');
        $this->setState('filter.dat', $dat);
        $type = $this->getUserStateFromRequest($this->context . '.filter.type', 'filter_type');
        $this->setState('filter.type', $type);
        $route = $this->getUserStateFromRequest($this->context . '.filter.route', 'filter_route');
        $this->setState('filter.route', $route);
        parent::populateState($ordering, $direction);
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.dat');
        $id .= ':' . $this->getState('filter.type');
        $id .= ':' . $this->getState('filter.route');
        return parent::getStoreId($id);
    }
}
