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
    <div class="control-label"><label><?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_EMAIL')?></label></div>
    <div class="controls"><input type="text" class="inputbox" name="<?php echo $name; ?>[email]" value="<?php echo !empty($value['email']) ? $value['email'] : ''; ?>"></div>
</div>


<div style="clear: both"></div>

<table class="table stripped">
    <tr>
        <th><?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE_FIELD_EMAIL')?></th>

        <td>
	        <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[enable_email]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[enable_email]" value="1"<?php if(!empty($value['enable_email'])) echo ' checked'; ?>>
        </td>

        <td>
		    <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_REQUIRED')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[required_email]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[required_email]" value="1"<?php if(!empty($value['required_email'])) echo ' checked'; ?>>
        </td>
    </tr>

    <tr>
        <th><?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE_FIELD_PHONE')?></th>

        <td>
	        <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[enable_phone]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[enable_phone]" value="1"<?php if(!empty($value['enable_phone'])) echo ' checked'; ?>>
        </td>

        <td>
		    <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_REQUIRED')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[required_phone]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[required_phone]" value="1"<?php if(!empty($value['required_phone'])) echo ' checked'; ?>>
        </td>
    </tr>

    <tr>
        <th><?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE_FIELD_NAME')?></th>

        <td>
	        <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[enable_name]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[enable_name]" value="1"<?php if(!empty($value['enable_name'])) echo ' checked'; ?>>
        </td>

        <td>
		    <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_REQUIRED')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[required_name]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[required_name]" value="1"<?php if(!empty($value['required_name'])) echo ' checked'; ?>>
        </td>
    </tr>

    <tr>
        <th><?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE_FIELD_COMPANY')?></th>

        <td>
	        <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[enable_company]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[enable_company]" value="1"<?php if(!empty($value['enable_company'])) echo ' checked'; ?>>
        </td>

        <td>
		    <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_REQUIRED')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[required_company]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[required_company]" value="1"<?php if(!empty($value['required_company'])) echo ' checked'; ?>>
        </td>
    </tr>

    <tr>
        <th><?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE_FIELD_MESSAGE')?></th>

        <td>
	        <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_ENABLE')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[enable_message]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[enable_message]" value="1"<?php if(!empty($value['enable_message'])) echo ' checked'; ?>>
        </td>

        <td>
		    <?php echo JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_REQUIRED')?>
        </td>
        <td>
            <input type="hidden" name="<?php echo $name; ?>[required_message]" value="0">
            <input type="checkbox" name="<?php echo $name; ?>[required_message]" value="1"<?php if(!empty($value['required_message'])) echo ' checked'; ?>>
        </td>
    </tr>
</table>
