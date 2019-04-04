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
    <meta property="og:image" content="<?php echo "https://".$_SERVER['SERVER_NAME']; ?>/images/og_logo.jpg">
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="ACHR Autoparts" />
    <meta property="og:url" content= "<?php echo "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />


    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="assets/css/main.css" />

</head>
<body>

<!-- Wrapper -->
<div id="wrapper" class="divided">

    <!-- menu -->
    <?php include 'menu.php'; ?>

    <div style="margin-top: 100px;">
	    <?php if(!empty($this->text)) : ?>
            <section class="banner onload-image-fade-in onload-content-fade-right - style2 fullscreen image-position-right content-align-center orient-left">
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
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js?v=1"></script>

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
