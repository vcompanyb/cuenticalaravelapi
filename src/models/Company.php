<?php

namespace Vulturdev\Cuentica\Models;

class Company extends Cuentica {

	private $company = false;
	private $serie = false;

	public function __construct($token = false) {
		parent::__construct($token);
		$this->url .= 'company';
	}

	public function company() {
		if(!$this->company)
			$this->company = $this->curl($this->url, 'GET');
		return $this->company;
	}

	public function serie() {
		if(!$this->serie)
			$this->serie = $this->curl($this->url.'/serie', 'GET');
		return $this->serie;
	}

	public function invoices($serie) {
		$invoice = new Invoice($this->token);
		return $invoice->invoices(array('serie' => $serie));
	}

}