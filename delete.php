<?php 
	include_once('config.php');

	if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
		$db->delete('customers',array('Id'=>$_REQUEST['delId']));
		header('location: browse-users.php?msg=rds');
		exit;
	}
?>