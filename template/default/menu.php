<?php
/**
 * Created by PhpStorm.
 * User: zikku
 * Date: 16.04.2018
 * Time: 15:23
 */

?>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <a class="logo my-0 mr-md-auto" href="/"><img class="h-auto d-inline-block" src="<?php echo $this->logo; ?>" alt="" width="40" height="40" ></a>
  <nav class="my-2 my-md-0 mr-md-3">
	<?php $i=0; foreach ($this->menu as $menu) : ?>
         <a class="p-2 text-dark" href="<?php echo $menu['link']; ?>"><?php echo $menu['title']; ?></a>
     <?php $i++; endforeach; ?>
  </nav>
  	<a class="telephone" href="tel:<?php echo str_replace(array(' ', '(', ')', '-'), '', $this->phone)?>">
        <?php echo $this->phone; ?>
    </a>
</div>
	