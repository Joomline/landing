<?php
/** @var $this LandingmanagementViewPage */
defined( '_JEXEC' ) or die;// No direct access
JHtml::_('bootstrap.tooltip');
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'behavior.keepalive' );
JHtml::_( 'formbehavior.chosen', 'select' );
$input = JFactory::getApplication()->input;
?>
<script type="text/javascript">
	Joomla.submitbutton = function (task) {
		if (task == 'page.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape( JText::_( 'JGLOBAL_VALIDATION_FORM_FAILED' ) ); ?>');
		}
	}
</script>
<form action="<?php echo JRoute::_( 'index.php?option=com_landingmanagement&id=' . $this->form->getValue( 'id' ) ); ?>" method="post" name="adminForm" id="item-form" class="form-validate" enctype="multipart/form-data">

	<div class="form-horizontal">
		<div class="row-fluid">
			<div class="span9">
				<fieldset class="adminform">
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'title' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'title' ); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'alias' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'alias' ); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'blocks' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'blocks' ); ?></div>
                    </div>
				</fieldset>
			</div>
			<div class="span3">
				<div class="form-vertical">
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel( 'site_id' ); ?></div>
                        <div class="controls"><?php echo $this->form->getInput( 'site_id' ); ?></div>
                    </div>
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
	</div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="return" value="<?php echo $input->getCmd( 'return' ); ?>" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>