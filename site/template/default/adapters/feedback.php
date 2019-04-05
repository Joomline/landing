<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

$this->addScript('classes/adapters/feedback/script.js?v=4');
$values = $this->input;
?>
<section id="<?php echo $this->id; ?>">
	<div class="d-flex justify-content-center mb-4 mt-4">
		<div class="col-6">
		<h2><?php echo $this->title; ?></h2>
		<form method="post" action="#" class="feedback-form">
            <?php if(!empty($values['enable_name'])) : ?>
			<div class="form-group">
				<label for="name">Имя</label>
				<input class="form-control" type="text" name="name" id="name" value=""<?php if(!empty($values['required_name'])) echo ' required';?>/>
			</div>
            <?php endif; ?>
			<?php if(!empty($values['enable_phone'])) : ?>
			<div class="form-group">
				<label for="phone">Телефон</label>
				<input class="form-control" type="tel" name="phone" id="phone" value=""<?php if(!empty($values['required_phone'])) echo ' required';?>/>
			</div>
			<?php endif; ?>
			<?php if(!empty($values['enable_email'])) : ?>
			<div class="form-group">
				<label for="phone">Email</label>
				<input class="form-control" type="tel" name="email" id="email" value=""<?php if(!empty($values['required_email'])) echo ' required';?>/>
			</div>
			<?php endif; ?>
			<?php if(!empty($values['enable_company'])) : ?>
			<div class="form-group">
				<label for="phone">Компания</label>
				<input class="form-control" type="tel" name="company" id="company" value=""<?php if(!empty($values['required_company'])) echo ' required';?>/>
			</div>
			<?php endif; ?>
			<?php if(!empty($values['enable_message'])) : ?>
			<div class="form-group">
				<label for="message">Ваш вопрос</label>
				<textarea class="form-control" name="message" id="message" rows="6"<?php if(!empty($values['required_message'])) echo ' required';?>></textarea>
			</div>
			<?php endif; ?>
            <div class="feedback-message"></div>
			<div class="text-center">
				<input type="submit" name="submit" class="submit-feedback-form btn btn-primary"  value="Задать вопрос" />
			</div>
            <input type="hidden" name="id" value="<?php echo $this->id; ?>">
		</form>
		</div>
	</div>
</section>
