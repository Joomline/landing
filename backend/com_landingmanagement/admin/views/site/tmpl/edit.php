<?php
/** @var $this LandingmanagementViewSite */
defined( '_JEXEC' ) or die;// No direct access
JHtml::_('bootstrap.tooltip');
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'behavior.keepalive' );
JHtml::_( 'formbehavior.chosen', 'select' );
$input = JFactory::getApplication()->input;

$doc = JFactory::getDocument();
$doc->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/jquery.min.js');
$doc->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/jquery-ui.min.js');
$doc->addScript(JURI::root().'administrator/components/com_landingmanagement/assets/js/script.js');
$doc->addScriptDeclaration('
    LandingPage.formControl = "'.$this->formControl.'";
    LandingPage.deleteText = "'.JText::_('COM_LANDINGMANAGEMENT_DELETE').'";
    LandingPage.nameText = "'.JText::_('COM_LANDINGMANAGEMENT_NAME').'";
    LandingPage.menuText = "'.JText::_('COM_LANDINGMANAGEMENT_MENU').'";
    LandingPage.publishText = "'.JText::_('COM_LANDINGMANAGEMENT_PUBLISH').'";
    LandingPage.metaTitle = "'.JText::_('COM_LANDINGMANAGEMENT_META_TITLE').'";
    LandingPage.metaDesc = "'.JText::_('COM_LANDINGMANAGEMENT_META_DESC').'";
    LandingPage.alias = "'.JText::_('COM_LANDINGMANAGEMENT_ALIAS').'";
');
?>
<script type="text/javascript">
	Joomla.submitbutton = function (task) {
		if (task == 'site.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
		<?php echo $this->form->getField( 'text' )->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape( JText::_( 'JGLOBAL_VALIDATION_FORM_FAILED' ) ); ?>');
		}
	}
</script>
<form action="<?php echo JRoute::_( 'index.php?option=com_landingmanagement&id=' . $this->form->getValue( 'id' ) ); ?>" method="post" name="adminForm" id="item-form" class="form-validate" enctype="multipart/form-data">
	
	<?php echo JLayoutHelper::render( 'joomla.edit.title_alias', $this ); ?>

	<div class="form-horizontal">
		<?php echo JHtml::_( 'bootstrap.startTabSet', 'myTab', array( 'active' => 'general' ) ); ?>

		<?php echo JHtml::_( 'bootstrap.addTab', 'myTab', 'general', JText::_( 'JGLOBAL_EDIT_ITEM', true ) ); ?>
		<div class="row-fluid">
			<div class="span9">
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'domain' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'domain' ); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'template' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'template' ); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'logo' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'logo' ); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'phone' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'phone' ); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'address' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'address' ); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'main_blocks' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'main_blocks' ); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'abstract' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'abstract' ); ?></div>
                </div>
				<fieldset class="adminform">
					<?php echo $this->form->getInput( 'text' ); ?>
				</fieldset>
			</div>
			<div class="span3">

				<div class="form-vertical">
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'published' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'published' ); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'id' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'id' ); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'created_by' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'created_by' ); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'created' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'created' ); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'metatitle' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'metatitle' ); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'metadesc' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'metadesc' ); ?></div>
                    </div>
                </div>
			</div>
		</div>
		<?php echo JHtml::_( 'bootstrap.endTab' ); ?>
		<?php echo JHtml::_( 'bootstrap.endTabSet' ); ?>
	</div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="return" value="<?php echo $input->getCmd( 'return' ); ?>" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>