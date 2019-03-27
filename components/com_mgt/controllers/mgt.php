<?php
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

class MgtControllerMgt extends BaseController
{
    public function getModel($name = 'Sync', $prefix = 'MgtModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function sync()
    {
        $model = $this->getModel();
        $vehicles = $model->loadData();
        exit(var_dump($vehicles));
    }
}
