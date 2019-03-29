<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class MgtViewVehicle extends HtmlView {
    protected $item, $form, $script, $id, $price;
    public function display($tmp = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');
        $this->addToolbar();
        $this->setDocument();
        parent::display($tpl);
    }
    protected function addToolbar() {
        $title = ($this->item->id != null) ? JText::sprintf('COM_MGT_TITLE_EDIT_VEHICLE', $this->item->num_gos ?? $this->item->num_park) : JText::sprintf('COM_MGT_TITLE_ADD_VEHICLE');
        JToolbarHelper::title($title);
        JToolBarHelper::apply('vehicle.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('vehicle.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('vehicle.cancel', 'JTOOLBAR_CLOSE');
    }
    protected function setDocument() {
        JHtml::_('bootstrap.framework');
    }
}
