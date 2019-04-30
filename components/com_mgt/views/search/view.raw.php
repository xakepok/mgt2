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
        $this->_layout = 'mobile';

        // Show the toolbar
        $this->toolbar();

        // Display it all
        return parent::display($tpl);
    }

    private function toolbar()
    {

    }
}
