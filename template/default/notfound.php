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
	<title><?php echo $this->title; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>

<!-- Wrapper -->
<div id="wrapper" class="divided">

    <!-- menu -->
    <?php
    include 'menu.php';
    ?>

	<section class="wrapper style1 big align-center">
		<div class="inner">
			<h2><?php echo $this->text; ?></h2>
		</div>
	</section>
	<!-- Footer -->
    <?php
    include 'footer.php';
    ?>

</div>
</body>
</html>