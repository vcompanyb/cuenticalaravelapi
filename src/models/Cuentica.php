<?php

namespace Vulturdev\Cuentica\Models;

use HttpException;
use HttpRequest;
use Ixudra\Curl\CurlService;

class Cuentica {

	var $token;
	var $url = 'https://api.cuentica.com/';
	var $response;

	public function __construct($token = false) {
		if(!$token)
			$token = env('CUENTICA_TOKEN');
		$this->token = $token;
	}

	public static function getCompany($token = false) {
		$company = new Company($token);
		return $company->get();
	}

	protected function curl($url, $method, $optionalParameters = [], $json = true) {
		//echo $method.' '.$url."\n";

		$curlService = new CurlService();

		$curlService = $curlService->to($url)
			->returnResponseObject()
		    ->enableDebug('./logFile.txt')
		    ->withHeader('X-AUTH-TOKEN: '.$this->token);

		if(count($optionalParameters) > 0) {
			print_r($optionalParameters);
			$curlService->withData( $optionalParameters );
		}

		if($method === 'GET')
			$response = $curlService->get();
		elseif($method === 'POST')
			$response = $curlService->asJson()->post();
		elseif($method === 'PUT')
			$response = $curlService->asJson()->put();
		elseif ($method === 'DELETE')
			$response = $curlService->asJson()->delete();

		if($response->status !== 200)
			print_r($response);

		if(is_object($response->content))
			return $response->content;
		if($json)
			return json_decode($response->content);
		else
			return $response->content;
	}

	protected function create($parameters) {
		return $this->curl( $this->url, 'POST', $parameters);
	}

	protected function update($id, $parameters) {
		return $this->curl( $this->url .'/'.$id, 'PUT', $parameters);
	}

	protected function delete($id) {
		return $this->curl( $this->url .'/'.$id, 'DELETE');
	}

}