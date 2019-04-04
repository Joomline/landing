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
<section class="wrapper style1 align-center" id="<?php echo $this->id; ?>">
	<div class="inner medium">
		<h2><?php echo $this->title; ?></h2>
		<form method="post" action="#" class="feedback-form">
            <?php if(!empty($values['enable_name'])) : ?>
			<div class="field half">
				<label for="name">Имя</label>
				<input type="text" name="name" id="name" value=""<?php if(!empty($values['required_name'])) echo ' required';?>/>
			</div>
            <?php endif; ?>
			<?php if(!empty($values['enable_phone'])) : ?>
			<div class="field half">
				<label for="phone">Телефон</label>
				<input type="tel" name="phone" id="phone" value=""<?php if(!empty($values['required_phone'])) echo ' required';?>/>
			</div>
			<?php endif; ?>
			<?php if(!empty($values['enable_email'])) : ?>
			<div class="field half">
				<label for="phone">Email</label>
				<input type="tel" name="email" id="email" value=""<?php if(!empty($values['required_email'])) echo ' required';?>/>
			</div>
			<?php endif; ?>
			<?php if(!empty($values['enable_company'])) : ?>
			<div class="field half">
				<label for="phone">Компания</label>
				<input type="tel" name="company" id="company" value=""<?php if(!empty($values['required_company'])) echo ' required';?>/>
			</div>
			<?php endif; ?>
			<?php if(!empty($values['enable_message'])) : ?>
			<div class="field">
				<label for="message">Ваш вопрос</label>
				<textarea name="message" id="message" rows="6"<?php if(!empty($values['required_message'])) echo ' required';?>></textarea>
			</div>
			<?php endif; ?>
            <div class="feedback-message"></div>
			<ul class="actions">
				<li><input type="submit" name="submit" class="submit-feedback-form" value="Задать вопрос" /></li>
			</ul>
            <input type="hidden" name="id" value="<?php echo $this->id; ?>">
		</form>
	</div>
</section>
