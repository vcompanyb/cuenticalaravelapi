<?php

namespace Vulturdev\Cuentica\Models;

class Account extends Cuentica {

	private $accounts = false;

	public function __construct($token = false) {
		parent::__construct($token);
	}

	public function accounts(){
		if(!$this->accounts)
			$this->accounts = $this->curl( $this->url .'account', 'GET' );
		return $this->accounts;
	}

	public function account($id) {
		if($this->accounts)
			return $this->getAccountWithId($id);
		return $this->curl( $this->url .'account/'.$id, 'GET' );
	}

	private function getAccountWithId($id) {
		if(is_array($this->accounts)) {
			foreach ( $this->accounts as $account ) {
				if ( $account->id === $id )
					return $account;
			}
		}
		return false;
	}

}