<?php
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/mgt.php';

$controller = BaseController::getInstance('mgt');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
