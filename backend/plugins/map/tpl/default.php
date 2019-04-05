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
    <div class="control-label">
        <label><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_CENTER_LAT')?></label>
    </div>
    <div class="controls">
        <input type="text" name="<?php echo $name; ?>[center_lat]" value="<?php echo $center_lat; ?>">
    </div>
</div>
<div class="control-group">
    <div class="control-label">
        <label><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_CENTER_LNG')?></label>
    </div>
    <div class="controls">
        <input type="text" name="<?php echo $name; ?>[center_lng]" value="<?php echo $center_lng; ?>">
    </div>
</div>
<div class="control-group">
    <div class="control-label">
        <label><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_ZOOM')?></label>
    </div>
    <div class="controls">
        <input type="text" name="<?php echo $name; ?>[zoom]" value="<?php echo $zoom; ?>">
    </div>
</div>
<div class="control-group">
    <div class="control-label">
        <label><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_CITIES')?></label>
    </div>
    <div class="controls">
        <textarea name="<?php echo $name; ?>[cities]" cols="50" rows="5"><?php echo $cities; ?></textarea>
    </div>
</div>

<div style="clear: both;"></div>
<input type="button" value="<?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_ADD_POINT'); ?>" onclick="LandingmanagementMap.add(this, '<?php echo $name; ?>')">
<table class="table stripped">
    <thead>
        <th width="50%"><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_DESC')?></th>
        <th width="30%"><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_SITE')?></th>
        <th width="10%"><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_LAT')?></th>
        <th width="10%"><?php echo JText::_('PLG_LANDINGMANAGEMENT_MAP_LNG')?></th>
        <th width="10%"><?php echo JText::_('COM_LANDINGMANAGEMENT_DELETE')?></th>
    </thead>
    <tbody class="map-body">
    <?php if(count($points)) : ?>
    <?php $i=0; foreach ( $points as $point ) : ?>
        <tr>
            <td><input type="text" name="<?php echo $name; ?>[points][<?php echo $i; ?>][desc]" style="width: 100%" value="<?php echo $point['desc']; ?>"></td>
            <td><input type="text" name="<?php echo $name; ?>[points][<?php echo $i; ?>][site]" value="<?php echo $point['site']; ?>" style="width: 100%"></td>
            <td><input type="text" name="<?php echo $name; ?>[points][<?php echo $i; ?>][lat]"  value="<?php echo $point['lat']; ?>" style="width: 100%"></td>
            <td><input type="text" name="<?php echo $name; ?>[points][<?php echo $i; ?>][lng]"  value="<?php echo $point['lng']; ?>" style="width: 100%"></td>
            <td><input type="button" value="X" onclick="LandingmanagementMap.del(this)"></td>
        </tr>
    <?php $i++; endforeach;  ?>
    <?php endif;  ?>
    </tbody>
</table>

