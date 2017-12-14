<?php

namespace Vulturdev\Cuentica\Models;

class Expense extends Cuentica {

	private $expenses = false;

	public function __construct($token = false) {
		parent::__construct($token);
		$this->url .= 'expense';
	}

	/**
	 * @param array $optionalParameters
	 *
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#gasto
	 *
	 * @return bool|mixed
	 */
	public function expenses($optionalParameters = []) {
		if(!$this->expenses && count($optionalParameters) == 0)
			$this->expenses = $this->curl( $this->url, 'GET');
		else
			return $this->curl( $this->url, 'GET', $optionalParameters);
		return $this->expenses;
	}

	/**
	 * @param $parameters
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#gasto
	 *
	 * @return mixed
	 */
	public function create($parameters) {
		return parent::create($parameters);
	}

	public function expense( $id ) {
		if($this->expenses) {
			$expense = $this->getExpenseWithId($id);
			if($expense)
				return $expense;
		}
		return $this->curl( $this->url .'/'.$id, 'GET' );
	}

	private function getExpenseWithId($id) {
		if(is_array($this->expenses)) {
			foreach ( $this->expenses as $expense ) {
				if ( $expense->id === $id )
					return $expense;
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

	public function downloadAttachment($idExpense) {
		$response = $this->curl( $this->url . '/'.$idExpense.'/attachment', 'GET', [], false);
		//$decoded = base64_decode($response);
		$file = 'Attachment '.$idExpense.'.pdf';
		file_put_contents($file, $response);
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/pdf');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
		}
	}

	public function updateAttachment($idExpense, $parameters) {
		return $this->curl( $this->url.'/'.$idExpense.'/attachment', 'PUT', $parameters);
	}

}