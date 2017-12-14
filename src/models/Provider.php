<?php

namespace Vulturdev\Cuentica\Models;

class Provider extends Cuentica {

	private $providers = false;

	public function __construct($token = false) {
		parent::__construct($token);
		$this->url .= 'provider';
	}

	/**
	 * @param array $optionalParameters
	 *
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#provider
	 *
	 * @return bool|mixed
	 */
	public function providers($optionalParameters = []) {
		if(!$this->providers && count($optionalParameters) == 0)
			$this->providers = $this->curl( $this->url, 'GET');
		else
			return $this->curl( $this->url, 'GET', $optionalParameters);
		return $this->providers;
	}

	/**
	 * @param $parameters
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#provider
	 *
	 * @return mixed
	 */
	public function create($parameters) {
		return parent::create($parameters);
	}

	public function provider( $id ) {
		if($this->providers) {
			$provider = $this->getProviderWithId($id);
			if($provider)
				return $provider;
		}
		return $this->curl( $this->url .'/'.$id, 'GET' );
	}

	private function getProviderWithId($id) {
		if(is_array($this->providers)) {
			foreach ( $this->providers as $provider ) {
				if ( $provider->id === $id )
					return $provider;
			}
		}
		return false;
	}

	public function update($id, $parameters) {
		return parent::update($id, $parameters);
	}

	public function delete($id) {
		return parent::delete($id);
	}

	public function expenses($idProvider){
		$expense = new Expense($this->token);
		$expense->expenses(array('provider' => $idProvider));
	}

}