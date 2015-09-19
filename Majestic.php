<?php

require_once 'conf.php';
class Majestic 
{
	private $cmd = null;
	private $itemsCount = 1;
	private $itemsList = array();
	private $dataSource = 'fresh';

	private function buildUrl() {
		global $api_key;
		$cmd = $this->cmd;
		$items = $this->items;
		$itemsCount = $this->itemsCount;
		$dataSource = $this->dataSource;

		$baseUrl = "http://api.majestic.com/api/json?app_api_key=$api_key&cmd=$cmd&items=$itemsCount&datasource=$dataSource";

		foreach ($items as $key => $value) {
			$baseUrl .= '&item' . $key . "=$value";
		}
		return $baseUrl;
	}

	public function getResult($url = NULL) {
		$ch = curl_init();

		// set url 
		curl_setopt($ch, CURLOPT_URL, $this->buildUrl()); 

		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		// $output contains the output string 
		$output = curl_exec($ch); 

		// close curl resource to free up system resources 
		curl_close($ch);

		return json_decode($output);
	}

	public function setParams($cmd=0, $items=array(), $dataSource="fresh") {
		$this->cmd = $cmd;
		$this->items = $items;
		$this->itemsCount = sizeof($items);
		$this->dataSource = $dataSource;
	}
}


?>