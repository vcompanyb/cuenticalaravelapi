<?php

namespace Vulturdev\Cuentica\Models;

class Invoice extends Cuentica {

	private $invoices = false;

	public function __construct($token = false) {
		parent::__construct($token);
		$this->url .= 'invoice';
	}

	/**
	 * @param array $optionalParameters
	 *
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#invoice
	 *
	 * @return bool|mixed
	 */
	public function invoices($optionalParameters = []) {
		if(!$this->invoices && count($optionalParameters) == 0)
			$this->invoices = $this->curl( $this->url, 'GET');
		else
			return $this->curl( $this->url, 'GET', $optionalParameters);
		return $this->invoices;
	}

	/**
	 * @param $parameters
	 * https://apidocs.cuentica.com/versions/latest_release/?shell#invoice
	 *
	 * @return mixed
	 */
	public function create($parameters) {
		return parent::create($parameters);
	}

	public function invoice( $id ) {
		if($this->invoices) {
			$invoice = $this->getInvoiceWithId($id);
			if($invoice)
				return $invoice;
		}
		return $this->curl( $this->url .'/'.$id, 'GET' );
	}

	private function getInvoiceWithId($id) {
		if(is_array($this->invoices)) {
			foreach ( $this->invoices as $invoice ) {
				if ( $invoice->id === $id )
					return $invoice;
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

	public function sendEmail($idFactura, $parameters) {
		return $this->curl( $this->url . '/'.$idFactura.'/email', 'POST', $parameters);
	}

	public function downloadPdf($idFactura){
		$response = $this->curl( $this->url . '/'.$idFactura.'/pdf', 'GET', [], false);
		//$decoded = base64_decode($response);
		$file = 'Invoice '.$idFactura.'.pdf';
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

}