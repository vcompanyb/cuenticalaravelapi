<?php

namespace Vulturdev\Cuentica\Models;

class Customer extends Cuentica {

	private $customers = false;

	public function __construct($token = false) {
		parent::__construct($token);
		$this->url .= 'customer';
	}

	/**
	 * @param array $optionalParameters
	 *
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#customer
	 *
	 * @return bool|mixed
	 */
	public function customers($optionalParameters = []) {
		if(!$this->customers && count($optionalParameters) == 0)
			$this->customers = $this->curl( $this->url, 'GET');
		else
			return $this->curl( $this->url, 'GET', $optionalParameters);
		return $this->customers;
	}

	/**
	 * @param $parameters
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#customer
	 *
	 * @return mixed
	 */
	public function create($parameters) {
		return parent::create($parameters);
	}

	public function customer( $id ) {
		if($this->customers) {
			$customer = $this->getCustomerWithId($id);
			if($customer)
				return $customer;
		}
		return $this->curl( $this->url .'/'.$id, 'GET' );
	}

	private function getCustomerWithId($id) {
		if(is_array($this->customers)) {
			foreach ( $this->customers as $customer ) {
				if ( $customer->id === $id )
					return $customer;
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

	public function invoices($idCustomer) {
		$invoice = new Invoice($this->token);
		return $invoice->invoices(array('customer' => $idCustomer));
	}

}