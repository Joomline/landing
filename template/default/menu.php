<?php
/**
 * Created by PhpStorm.
 * User: zikku
 * Date: 16.04.2018
 * Time: 15:23
 */

?>
	<nav id="nav">
		<a class="logo" href="/"><img src="<?php echo $this->logo; ?>" alt="" ></a>
        <div class="menu">
            <div class="menu__icon">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>

            <div class="menu__links">
                    <?php $i=0; foreach ($this->menu as $menu) : ?>
                        <a class="menu__links-item" href="<?php echo $menu['link']; ?>"><?php echo $menu['title']; ?></a>
                    <?php $i++; endforeach; ?>
            </div>
        </div>

		<a class="telephone" href="tel:<?php echo str_replace(array(' ', '(', ')', '-'), '', $this->phone)?>">
            <?php echo $this->phone; ?>
        </a>
	</nav>