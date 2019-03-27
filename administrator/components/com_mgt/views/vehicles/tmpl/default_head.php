<?php
defined('_JEXEC') or die;
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>
<tr>
    <th width="1%" class="hidden-phone">
        <input type="checkbox" name="checkall-toggle" value=""
               title="<?php echo JText::sprintf('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_SRV_ID', 'srv_id', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_UNIQUE_ID', 'unique_id', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_NUM_GOS', 'num_gos', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_NUM_PARK', 'num_park', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MGT_HEAD_LAST_SYNC', 'last_sync', $listDirn, $listOrder); ?>
    </th>
</tr>