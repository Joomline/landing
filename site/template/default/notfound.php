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
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="icon" type="image/png" sizes="128x128" href="/images/favicon.png">
</head>
<body>

<!-- Wrapper -->
<div id="wrapper" class="site">

    <!-- menu -->
    <?php
    include 'menu.php';
    ?>

	<div class="container">
		<div class="text-center mb-4 my-md-5">
			<h2><?php echo $this->text; ?></h2>
		</div>
	</div>
	<!-- Footer -->
    <?php
    include 'footer.php';
    ?>

</div>
</body>
</html>