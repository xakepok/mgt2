<?php
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class MgtViewVehicles extends HtmlView
{
	protected $helper;
	protected $sidebar = '';
	public $items, $pagination, $uid, $state, $links, $filterForm, $activeFilters, $returnUrl, $actionUrl;

	public function display($tpl = null)
	{
	    $this->items = $this->get('Items');
	    $this->pagination = $this->get('Pagination');
	    $this->state = $this->get('State');
	    $this->returnUrl = $this->get('ReturnUrl');
	    $this->actionUrl = $this->get('ActionUrl');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        //$this->filterForm->removeField('activity', 'filter');

        // Show the toolbar
		$this->toolbar();

		// Show the sidebar
		$this->helper = new MgtHelper();
		$this->helper->addSubmenu('vehicles');
		$this->sidebar = JHtmlSidebar::render();

		// Display it all
		return parent::display($tpl);
	}

	private function toolbar()
	{
		JToolBarHelper::title(JText::sprintf('COM_MGT_MENU_VEHICLES'), '');

        if (MgtHelper::canDo('core.create'))
        {
            JToolbarHelper::addNew('vehicle.add');
        }
        if (MgtHelper::canDo('core.edit'))
        {
            JToolbarHelper::editList('vehicle.edit');
        }
        if (MgtHelper::canDo('core.delete'))
        {
            JToolbarHelper::deleteList('COM_MGT_QUESTION_REMOVE_VEHICLE', 'vehicle.delete');
        }
        JToolbarHelper::divider();
        if (MgtHelper::canDo('core.admin'))
		{
			JToolBarHelper::preferences('com_projects');
		}
	}
}
