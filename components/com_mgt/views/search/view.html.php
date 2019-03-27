<?php
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class MgtViewSearch extends HtmlView
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

        if (empty($this->state->get('filter.dat'))) $this->filterForm->setValue('dat', 'filter', JDate::getInstance()->format("Y-m-d"));
        //$this->filterForm->removeField('activity', 'filter');
        //$this->filterForm->setFieldAttribute('dat', 'default', date("Y-m-d"));

        // Show the toolbar
		$this->toolbar();

		// Display it all
		return parent::display($tpl);
	}

	private function toolbar()
	{

	}
}
