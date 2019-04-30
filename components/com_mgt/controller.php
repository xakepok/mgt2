<?php
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

class MgtController extends BaseController {
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }
}
