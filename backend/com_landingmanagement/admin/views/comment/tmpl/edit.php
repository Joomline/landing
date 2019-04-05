<?php
/** @var $this LandingmanagementViewComment */
defined( '_JEXEC' ) or die;// No direct access
JHtml::_('bootstrap.tooltip');
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'behavior.keepalive' );
JHtml::_( 'formbehavior.chosen', 'select' );
$input = JFactory::getApplication()->input;
?>
<script type="text/javascript">
	Joomla.submitbutton = function (task) {
		if (task == 'comment.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
		<?php echo $this->form->getField( 'comment' )->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape( JText::_( 'JGLOBAL_VALIDATION_FORM_FAILED' ) ); ?>');
		}
	}
</script>
<form action="<?php echo JRoute::_( 'index.php?option=com_landingmanagement&id=' . $this->form->getValue( 'id' ) ); ?>" method="post" name="adminForm" id="item-form" class="form-validate" enctype="multipart/form-data">
	
	<?php echo JLayoutHelper::render( 'joomla.edit.title_alias', $this ); ?>

	<div class="form-horizontal">
		<div class="row-fluid">
			<div class="span9">
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'image' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'image' ); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel( 'link' ); ?></div>
                    <div class="controls"><?php echo $this->form->getInput( 'link' ); ?></div>
                </div>
				<fieldset class="adminform">
					<?php echo $this->form->getInput( 'comment' ); ?>
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
                </div>
			</div>
		</div>
	</div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="return" value="<?php echo $input->getCmd( 'return' ); ?>" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>