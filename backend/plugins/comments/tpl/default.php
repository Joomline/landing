<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
?>
<div class="control-group">
    <div class="control-label"><label><?php echo JText::_('PLG_LANDINGMANAGEMENT_COMMENTS_ORDER')?></label></div>
    <div class="controls"><?php echo JHtml::_('select.genericlist', $orderOptions, $name.'[order]', '', 'value', 'text', $order); ?></div>
</div>
<div class="control-group">
    <div class="control-label"><label><?php echo JText::_('PLG_LANDINGMANAGEMENT_COMMENTS_DIRN')?></label></div>
    <div class="controls"><?php echo JHtml::_('select.genericlist', $dirnOptions, $name.'[dirn]', '', 'value', 'text', $dirn); ?></div>
</div>
<div class="control-group">
    <div class="control-label"><label><?php echo JText::_('PLG_LANDINGMANAGEMENT_COMMENTS_LIMIT')?></label></div>
    <div class="controls"><input type="text" name="<?php echo $name.'[limit]'; ?>" value="<?php echo $limit; ?>"></div>
</div>






