<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

require_once 'includes/functions.php';

$config = new Config();

$sef = new Sef();
$sef->parseRoute();
$controller = new controllers\Main($config);
$controller->execute();
