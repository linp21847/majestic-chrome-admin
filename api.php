<?php
	require_once 'Majestic.php';
	$mine = new Majestic();
	

	if (isset($_GET) && !empty($_GET)) {
		$cmd = $_GET['cmd'];
		$items = $_GET['items'];
		$dataSource = $_GET['dataSource'];

		$mine->setParams($cmd, $items, $dataSource);
	}

	echo json_encode($mine->getResult());
?>