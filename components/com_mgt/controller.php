<?php
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

class MgtController extends BaseController {
    public function display($cachable = false, $urlparams = array())
    {
        $view = $this->input->getString('view');
        $app = JFactory::getApplication();
        if ($view == 'mgt') {
            if ($app->client->mobile) {
                $this->setRedirect('/mobile.html');
                $this->redirect();
                jexit();
            }
        }
        return parent::display($cachable, $urlparams);
    }
}
