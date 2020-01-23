<?php
	$db = mysqli_connect('mdarh411','root','','shauntas_boutique');
	if (mysqli_connect_errno()) {
		echo "Database connection faild with following errors: " . mysqli_connect_error();
		die();
	}
	require_once $_SERVER['DOCUMENT_ROOT'] . '/shauntas_boutique/config.php';
	require_once BASEURL.'helpers/helpers.php';
