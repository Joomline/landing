<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
?>
<section class="wrapper style1 big align-center comments" id="<?php echo $this->id; ?>">
	<div class="inner">
		<h2><?php echo $this->title; ?></h2>
		<p>О наших бензонасосах и лямбда-зондах есть очень много хороших отзывов! И вот некоторые из них.</p>
		<div class="items style1 big onscroll-fade-in">
			<?php foreach ( $this->comments as $comment ) : ?>
				<section>
					<span class="icon style2 major">
						<?php if(!empty($comment['image'])) : ?>
						<img src="<?php echo Helper::prepareImage($comment['image']) ; ?>">
						<?php endif; ?>
					</span>
					<h3><?php echo $comment['name']; ?></h3>
                    <div>
	                    <?php echo $comment['comment']; ?>
                    </div>
					<?php if(!empty($comment['link'])) : ?>
                        <ul class="actions">
                            <li><a href="<?php echo $comment['link']; ?>" target="_blank" class="button small">Подробнее...</a></li>
                        </ul>
					<?php endif; ?>
				</section>
			<?php endforeach; ?>
            <?php if($this->view == 'main') : ?>
			<ul class="actions">
				<li><a href="/<?php echo $this->id ?>" class="button big icon fa-comments-o">Все отзывы</a></li>
			</ul>
            <?php endif; ?>
		</div>
	</div>
</section>
