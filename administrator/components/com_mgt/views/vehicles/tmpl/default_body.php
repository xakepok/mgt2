<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
$ii = JFactory::getApplication()->input->getInt('limitstart', 0);
foreach ($this->items as $item) :
    ?>
    <tr class="row0">
        <td class="center">
            <?php echo JHtml::_('grid.id', $i, $item['id']); ?>
        </td>
        <td>
            <?php echo $item['id']; ?>
        </td>
        <td>
            <?php echo $item['srv_id']; ?>
        </td>
        <td>
            <?php echo $item['unique_id']; ?>
        </td>
        <td>
            <?php echo $item['num_gos']; ?>
        </td>
        <td>
            <?php echo $item['num_park']; ?>
        </td>
        <td>
            <?php echo $item['sync']; ?>
        </td>
    </tr>
<?php endforeach; ?>
