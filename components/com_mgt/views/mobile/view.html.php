<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class MgtViewMobile extends HtmlView {
    protected $item, $form, $script, $id, $price;
    public function display($tmp = null) {
        $this->form = $this->get('Form');
        //$this->item = $this->get('Item');
        $this->script = $this->get('Script');
        $this->_layout = 'edit';
        $this->templateParams = $this->get('TemplateParams');
        //exit(var_dump($this->templateParams));
        //JFactory::getApplication()->setTemplate($this->templateParams->template, (new JRegistry($this->templateParams->params)));
        parent::display($tmp);
    }

    private $templateParams;
}
