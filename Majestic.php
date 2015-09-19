<?php

require_once 'conf.php';
class Majestic 
{
	private $cmd = null;
	private $itemsCount = 1;
	private $count = 100;
	private $itemsList = array();
	private $dataSource = 'fresh';

	public function GetIndexItemInfo($cmd=NULL, $items=array(), $dataSource="fresh") {
		global $api_key;
		$itemsCount = sizeof($items);

		$baseUrl = "http://api.majestic.com/api/json?app_api_key=$api_key&cmd=$cmd&items=$itemsCount&datasource=$dataSource";

		foreach ($items as $key => $value) {
			$baseUrl .= '&item' . $key . "=$value";
		}

		return $this->getResult($baseUrl);
	}

	public function GetBackLinkData($cmd=NULl, $item=NULL, $count=1, $dataSource="fresh") {
		global $api_key;

		$baseUrl = "http://api.majestic.com/api/json?app_api_key=$api_key&cmd=$cmd&item=$item&Count=$count&datasource=$dataSource";
		return $this->getResult($baseUrl);
	}

	public function GetAnchorText($cmd=NULl, $item=NULL, $count=1, $dataSource="fresh") {
		global $api_key;

		$baseUrl = "http://api.majestic.com/api/json?app_api_key=$api_key&cmd=$cmd&item=$item&Count=$count&datasource=$dataSource";
		return $this->getResult($baseUrl);
	}

	private function buildUrl() {
		global $api_key;
		$cmd = $this->cmd;
		$baseUrl = "";

		switch ($cmd) {
			case 'GetBackLinkData':
				$items = $this->items;
				$itemsCount = $this->itemsCount;
				$dataSource = $this->dataSource;

				$baseUrl = "http://api.majestic.com/api/json?app_api_key=$api_key&cmd=$cmd&items=$itemsCount&datasource=$dataSource";

				foreach ($items as $key => $value) {
					$baseUrl .= '&item' . $key . "=$value";
				}
				break;
			
			default:
				# code...
				break;
		}
		return $baseUrl;
	}

	public function getResult($url = NULL) {
		$ch = curl_init();

		// set url 
		curl_setopt($ch, CURLOPT_URL, $url); 

		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		// $output contains the output string 
		$output = curl_exec($ch); 

		// close curl resource to free up system resources 
		curl_close($ch);

		return json_decode($output);
	}
}


?>