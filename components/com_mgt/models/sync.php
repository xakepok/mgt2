<?php
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

defined('_JEXEC') or die;

class MgtModelSync extends BaseDatabaseModel
{
    public function loadData()
    {
        $login = 'guest';
        $password = 'guest';
        $address = 'moscow.map.office.transnavi.ru/wap/online/';
        $vehicles = $this->getVehicles();
        jimport('phpQuery-onefile');
        $res = array();
        $ids = array();
        $bad = array();
        foreach ($vehicles as $vehicle) {
            $ids[] = $vehicle->id;
            $params = array(
                'srv_id' => $vehicle->srv_id,
                'uniqueid' => $vehicle->unique_id
            );
            $url = "http://{$login}:{$password}@{$address}?".http_build_query($params);
            $d = phpQuery::newDocumentHtml(file_get_contents($url));
            $tmp = new phpQueryObject($d->find('head'));
            foreach ($d->find("h1") as $fnd) {
                $tmp = trim(pq($fnd)->text());
                $num = mb_stripos($tmp, ' / ');
                if ($num !== false)
                {
                    $veh = (int) ($vehicle->srv_id < 20) ? trim(mb_substr($tmp, $num+3, NULL, 'UTF-8')) : trim(mb_substr($tmp, $num-5, 5));
                    if ($veh != 0) {
                        $res[$vehicle->id]['vehicle'] = (int) trim($veh);
                    }
                    else {
                        $bad[] = $vehicle->id;
                    }
                    break;
                }
            }
            if (isset($res[$vehicle->id]['vehicle']))
            {
                $tmp = new phpQueryObject($d->find('tbody'));
                $res[$vehicle->id]['route'] = false;
                foreach ($d->find("a[href^='?mr_id']") as $fnd)
                {
                    $tmp = trim(pq($fnd)->text());
                    if ($vehicle->srv_id > 19) //Для троллейбусов и трамваев
                    {
                        $t = explode('.', $tmp);
                        $tmp = $t[1];
                    }
                    $res[$vehicle->id]['route'] = $tmp;
                    $res[$vehicle->id]['type'] = ($vehicle->srv_id < 20) ? '0' : '2';
                }
            }
        }
        $this->updateSyncDate($vehicles ?? array(), $ids ?? array(), $bad ?? array());
        $this->saveData($res);
        return $res;
    }

    public function saveData($data)
    {
        $db =& $this->getDbo();
        $arr = array();
        $dat = JDate::getInstance()->format("H:i:s");
        foreach ($data as $itemID => $vehicle) {
            $arr[] = "(current_date, {$db->q($itemID)}, {$db->q($vehicle['route'])}, {$db->q($dat)})";
            $query = $db->getQuery(true);
            $query
                ->update("`#__mgt_vehicles`")
                ->set("`num_park` = {$db->q($vehicle['vehicle'])}")
                ->where("`id` = {$itemID}");
            $db->setQuery($query)->execute();
        }
        if (empty($data)) return;
        $query = $db->getQuery(true);
        $query = "INSERT INTO `#__mgt_online` (`dat`, `vehicle_id`, `route`, `tm`) VALUES ";
        $query .= implode(", ", $arr) . " ";
        $query .= "ON DUPLICATE KEY UPDATE `route` = VALUES(`route`), `tm` = VALUES(`tm`)";
        $db->setQuery($query)->execute();
    }

    public function updateSyncDate(array $source, array $ids, array $bad): void
    {
        if (empty($ids) || empty($source)) return;
        foreach ($source as $i => $item) {
            if (in_array($item->id, $ids)) unset($source[$i]);
        }
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $ids = implode(", ", $ids);
        $query
            ->update("`#__mgt_vehicles`")
            ->set("`last_sync` = current_timestamp")
            ->where("`id` in ({$ids})");
        $db->setQuery($query)->execute();
        $ids = array();
        foreach ($source as $item) {
            $ids[] = $item->id;
        }
        if (empty($bad)) return;
        $ids = implode(", ", $bad);
        $query = $db->getQuery(true);
        $query
            ->update("`#__mgt_vehicles`")
            ->set("`fail_sync` = `fail_sync`+1")
            ->where("`id` in ({$ids})");
        $db->setQuery($query)->execute();
    }

    public function getVehicles()
    {
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("*")
            ->from("`#__mgt_vehicles`")
            ->order("`last_sync`");
        return $db->setQuery($query, 0, 50)->loadObjectList();
    }
}
