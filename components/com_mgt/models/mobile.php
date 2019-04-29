<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;

class MgtModelMobile extends AdminModel
{
    public function getTable($name = 'Vehicles', $prefix = 'TableMgt', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        return $item;
    }

    public function save($data)
    {
        return parent::save($data);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option . '.mobile', 'mobile', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option . '.edit.mobile.data', array());
        if (empty($data)) {
            $data = array();
        }
        return $data;
    }

    public function getTemplateParams()
    {
        $db =& $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("`template`, `params`")
            ->from("`#__template_styles`")
            ->where("`id` = 10");
        return $db->setQuery($query)->loadObject();
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/vehicle.js';
    }
}