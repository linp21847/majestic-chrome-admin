<?php
	require_once 'Majestic.php';

	header('Access-Control-Allow-Origin: *');
	$mine = new Majestic();
	$result;
	

	if (isset($_GET) && !empty($_GET)) {
		$cmd = $_GET['cmd'];
		$dataSource = $_GET['dataSource'];

		switch ($cmd) {
			case 'GetIndexItemInfo':
				$items = $_GET['items'];
				$result = $mine->GetIndexItemInfo($cmd, $items, $dataSource);
				break;

			case 'GetBackLinkData':
				$item = $_GET['item'];
				$count = $_GET['count'];
				$result = $mine->GetBackLinkData($cmd, $item, $count, $dataSource);
				break;

			case 'GetAnchorText':
				$item = $_GET['item'];
				$count = $_GET['count'];
				$result = $mine->GetAnchorText($cmd, $item, $count, $dataSource);
				break;
			
			default:
				# code...
				break;
		}

		
	}

	echo json_encode($result);
?>