<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class JFormFieldMultiple extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'Multiple';

	/**
	 * Method to get the field input markup.
	 * The checked element sets the field to selected.
	 *
	 * @return  string   The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		// Initialize some field attributes.

		$id = str_replace(array('[', ']'), array('-', ''), $this->name);

		$values = !is_array($this->value) ? json_decode($this->value, true) : $this->value;

		ob_start();
		?>
		<div>
			<input type="button" value="<?php echo JText::_('COM_LANDINGMANAGEMENT_ADD')?>" onclick="LandingPage.addRow('<?php echo $this->name ?>', '<?php echo $id; ?>');">
			<table width="100%">
				<thead>
					<tr>
						<th width="45%"><?php echo JText::_('COM_LANDINGMANAGEMENT_NAME')?></th>
						<th width="45%"><?php echo JText::_('COM_LANDINGMANAGEMENT_DESCRIPTION')?></th>
						<th width="10%"><?php echo JText::_('COM_LANDINGMANAGEMENT_DELETE')?></th>
					</tr>
				</thead>
				<tbody id="multiple-field">
				<?php if(count($values)) : ?>
					<?php $i=0; foreach ( $values as $value ) : ?>
						<tr>
							<td><input type="text" name="<?php echo $this->name ?>[<?php echo $i; ?>][name]" id="<?php echo $id; ?>-name-<?php echo $i; ?>" value="<?php echo $value['name']; ?>" style="width: 100%"></td>
							<td><input type="text" name="<?php echo $this->name ?>[<?php echo $i; ?>][desc]" id="<?php echo $id; ?>-desc-<?php echo $i; ?>" value="<?php echo $value['desc']; ?>"" style="width: 100%"></td>
							<td><input type="button" value="X" onclick="LandingPage.deleteRow(this);"></td>
						</tr>
					<?php $i++; endforeach; ?>

				<?php endif; ?>
				</tbody>
			</table>
		</div>
		<?php
		return ob_get_clean();
	}
}
