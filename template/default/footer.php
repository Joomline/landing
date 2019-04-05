<?php
/**
 * Created by PhpStorm.
 * User: zikku
 * Date: 16.04.2018
 * Time: 15:27
 */
//echo '<pre>'; var_dump($this->abstract);echo '</pre>';die;
?>
<div class="container">
<footer class="pt-4 my-md-5 pt-md-5 border-top">


<div class="row">
      <div class="col-2">
        <img class="mb-12" src="<?php echo $this->logo; ?>" alt="" width="24" height="24">
        <small class="d-block mb-3 text-muted">&copy; <?php echo date ( 'Y' ) ; ?> <a href="/"><?php echo $this->title; ?></a></small>
      </div>
	   <div class="col-5 col-md">
        <h5>Контакты</h5>
        <ul class="list-unstyled text-small">
          <li>Наш телефон: <a href="tel:<?php echo str_replace(array(' ', '(', ')', '-'), '', $this->phone)?>"> <?php echo $this->phone; ?></a></li>
		  <li>Наш E-mail: <a href="<?php echo $this->abstract[1]['email']; ?>"><?php echo $this->abstract[1]['email']; ?></a></li>
          <li>Наш адрес: <?php echo $this->address; ?></li>          
        
        </ul>
      </div>
	  	  
</div>
        
</footer>
</div>
