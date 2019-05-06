<?php
defined('_JEXEC') or die;

?>
<body style="background: #fafafa" ;?>
    <table style="border-collapse: collapse; width: 100%;">
        <tr>
            <th style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                <?php echo "#"; ?>
            </th>
            <th style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                <?php echo JText::sprintf('COM_MGT_DATE'); ?>
            </th>
            <th style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                <?php echo JText::sprintf('COM_MGT_VEHICLE_TYPE'); ?>
            </th>
            <th style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                <?php echo JText::sprintf('COM_MGT_HEAD_NUM_PARK_SHORT'); ?>
            </th>
            <th style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                <?php echo JText::sprintf('COM_MGT_HEAD_ROUTE'); ?>
            </th>
            <th style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                <?php echo JText::sprintf('COM_MGT_HEAD_LAST_FIX_SHORT'); ?>
            </th>
        </tr>
        <?php
        foreach ($this->items as $item) :
            ?>
            <tr class="row0">
                <td style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                    <?php echo ++$ii; ?>
                </td>
                <td style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                    <?php echo $item['dat']; ?>
                </td>
                <td style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                    <?php echo $item['type']; ?>
                </td>
                <td style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                    <?php echo $item['num_park']; ?>
                </td>
                <td style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                    <?php echo $item['route']; ?>
                </td>
                <td style="border: 1px solid black; padding: 3px; 1px; font-size: 0.9em;">
                    <?php echo $item['tm']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>