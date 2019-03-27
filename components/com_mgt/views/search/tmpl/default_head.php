<?php
defined('_JEXEC') or die;
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>
<tr>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_DATE', 'dat', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_VEHICLE_TYPE', 'type', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_NUM_PARK', 'num_park', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_ROUTE', 'route', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_LAST_FIX', 'tm', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_LAST_SYNC', 'last_sync', $listDirn, $listOrder); ?>
    </th>
</tr>