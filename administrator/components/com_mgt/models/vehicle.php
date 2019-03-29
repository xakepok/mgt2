<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;

class MgtModelVehicle extends AdminModel
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
            $this->option . '.vehicle', 'vehicle', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form)) {
            return false;
        }
        $id = JFactory::getApplication()->input->get('id', 0);
        $user = JFactory::getUser();
        if ($id != 0 && (!$user->authorise('core.edit.state', $this->option . '.vehicle.' . (int)$id))
            || ($id == 0 && !$user->authorise('core.edit.state', $this->option)))
            $form->setFieldAttribute('state', 'disabled', 'true');
        if ($id > 0) {
            $item = parent::getItem($id);
            $type = MgtHelper::getVehicleType($item->srv_id);
            if ($type > 1) {
                $form->setFieldAttribute('num_gos', 'required', false);
                $form->setFieldAttribute('num_gos', 'disabled', 'true');
            }
        }
        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option . '.edit.vehicle.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

    protected function prepareTable($table)
    {
        $nulls = array('num_gos', 'num_park'); //Поля, которые NULL
        foreach ($nulls as $field) {
            if (!strlen($table->$field)) $table->$field = NULL;
        }
        parent::prepareTable($table);
    }

    protected function canEditState($record)
    {
        $user = JFactory::getUser();
        if (!empty($record->id)) {
            return $user->authorise('core.edit.state', $this->option . '.vehicle.' . (int)$record->id);
        } else {
            return parent::canEditState($record);
        }
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/vehicle.js';
    }
}