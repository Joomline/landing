<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $this->metaTitle; ?></title>
    <meta name="description" content="<?php echo $this->metaDescription; ?>"/>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="<?php echo $this->title; ?>"/>
    <meta property="og:description" content="<?php echo $this->metaDescription; ?>"/>
    <meta property="og:image" content="<?php echo "https://".$_SERVER['SERVER_NAME']; ?>/images/og_logo.png">
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="<?php echo $this->title; ?>" />
    <meta property="og:url" content= "<?php echo "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
  
    <link rel="icon" type="image/png" sizes="128x128" href="/images/favicon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

</head>
<body>

<!-- Wrapper -->
<div id="wrapper" class="site">
    <!-- menu -->
    <?php include 'menu.php'; ?>

    <div class="container my-md-5">
	    <?php if(!empty($this->text)) : ?>
            <section>
			    <?php echo $this->text; ?>
            </section>
	    <?php endif; ?>

	    <?php echo $this->content; ?>
    </div>


	<!-- Footer -->
    <?php include 'footer.php'; ?>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="hassets/js/bootstrap.min.js"></script>

<?php if(is_array(\adapters\Main::$scripts) && count(\adapters\Main::$scripts)) : ?>
    <?php foreach ( \adapters\Main::$scripts as $script ) : ?>
<script src="<?php echo $script; ?>"></script>
	<?php endforeach ?>
<?php endif; ?>
<?php if(!empty(\adapters\Main::$scriptDeclaration)) : ?>
<script>
        <?php echo \adapters\Main::$scriptDeclaration; ?>
</script>
<?php endif; ?>
</body>
</html>
