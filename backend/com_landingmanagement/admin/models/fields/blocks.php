<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class JFormFieldBlocks extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'Blocks';

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
		$app = JFactory::getApplication();

		$view = $app->input->getCmd('view');
		if($view == 'site'){
			$siteId = $this->form->getData()->get('id');
		}
		else{

			$siteId = $this->form->getData()->get('site_id');
		}

		$values = !empty($this->value) ? explode(',', $this->value) : array();
		$name = $this->name;
		$blocks = $this->getBlocks($siteId);

		$document = & JFactory::getDocument();
		JHTML::_('behavior.tooltip');
		JHtml::_('jquery.framework');
		$document->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/jquery.ui.core.js');
		$document->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/jquery.ui.widget.js');
		$document->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/jquery.ui.mouse.js');
		$document->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/jquery.ui.sortable.js');
		$document->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/script.js');
		$document->addStyleSheet(JURI::root().'administrator/components/com_landingmanagement/assets/css/style.css');
		$usedBlocks = array();
		ob_start();
		?>
		<table class="admintable" width="100%">
			<thead>
			<tr>
				<th class="key" width="50%"><?php echo JText::_('COM_LANDINGMANAGEMENT_SELECT_UNUSED'); ?></th>
				<th class="key" width="50%"><?php echo JText::_('COM_LANDINGMANAGEMENT_SELECT_USED'); ?></th>
			</tr>
			</thead>
			<tr>
				<td valign="top">
					<ul id="sortableNotUsed" class="positions">
						<?php foreach ($blocks as $block) : ?>
						<?php if(in_array($block->alias, $values)){ $usedBlocks[] = $block; continue;} ?>
							<li class="fields core" id="<?php echo $block->alias; ?>">
								<?php echo $block->title; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</td>
				<td valign="top">
					<div>
						<ul id="sortableUsed" class="positions">
							<?php foreach ($usedBlocks as $block) : ?>
								<li class="fields core" id="<?php echo $block->alias; ?>">
									<?php echo $block->title; ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<input type="hidden" name="<?php echo $name; ?>" id="used" value="<?php echo $this->value; ?>"/>
					</div>
				</td>
			</tr>
		</table>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	private function getBlocks($siteId){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('alias, title')->from('#__landingmanagement_blocks')->where('site_id = '.(int)$siteId);
		$result = $db->setQuery($query)->loadObjectList();
		if(!is_array($result)){
			$result = array();
		}
		return $result;
	}

}
