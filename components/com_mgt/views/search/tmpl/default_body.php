<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
foreach ($this->items as $item) :
    ?>
    <tr class="row0">
        <td>
            <?php echo $item['dat']; ?>
        </td>
        <td>
            <?php echo $item['type']; ?>
        </td>
        <td>
            <?php echo $item['num_park']; ?>
        </td>
        <td>
            <?php echo $item['num_gos']; ?>
        </td>
        <td>
            <?php echo $item['route']; ?>
        </td>
        <td>
            <?php echo $item['tm']; ?>
        </td>
        <td>
            <?php echo $item['last_sync']; ?>
        </td>
    </tr>
<?php endforeach; ?>
