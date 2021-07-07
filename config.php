<?php
include_once('include/Database.php');
include_once('include/paginator.class.php');

define('DB_NAME', 'endorment');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Bones1990-');
define('DB_HOST', 'localhost');

$dsn	= 	"mysql:dbname=".DB_NAME.";host=".DB_HOST."";
$pdo	=	"";
try {
	$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db = new Database($pdo);
$pages = new Paginator();
?>