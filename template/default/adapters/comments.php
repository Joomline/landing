<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
?>
<section class="mb-4 mt-4" id="<?php echo $this->id; ?>">
	
		<h2><?php echo $this->title; ?></h2>
		
		<div class="card-columns">
			<?php foreach ( $this->comments as $comment ) : ?>
				<div class="card">
					
						<?php if(!empty($comment['image'])) : ?>
						<img class="card-img-top" src="<?php echo Helper::prepareImage($comment['image']) ; ?>">
						<?php endif; ?>
					<div class="card-body">
					<h5 class="card-title"><?php echo $comment['name']; ?></h5>
                    <div class="card-text">
	                    <?php echo $comment['comment']; ?>
                    </div>
					<?php if(!empty($comment['link'])) : ?>
                        
                           <a class="card-link" href="<?php echo $comment['link']; ?>" target="_blank" class="button small">Подробнее...</a>
                        
					<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
            <?php if($this->view == 'main') : ?>
			<div class="text-center">
				<a href="/<?php echo $this->id ?>" class="btn btn-primary">Все отзывы</a>
			</div>
            <?php endif; ?>
		
	
</section>
