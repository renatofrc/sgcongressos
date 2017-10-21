<?php 

namespace SG\Model;

use \SG\DB\Sql;
use \SG\Model;
use \SG\Mailer;
use \SG\Model\User;
use \SG\Model\Participant;
use MercadoPago\mercadopago;

class Payment {

	public static function PaymentCredit($email, $amount, $token, $installments, $payment_method_id)
	{


		$mp = new mercadopago
		(
			'TEST-5867712708748536-102113-da138a1d7ff84d6ce45eb80570026a60__LB_LA__-203534313'
		);

		$payment_data = array(
			"transaction_amount" => $amount,
			"token" => $token,
			"description" => "Title of what you are paying for",
			"installments" => intval($installments),
			"payment_method_id" => $payment_method_id,
			"payer" => array (
				"email" => $email
			),
		);


		$payment = $mp->post("/v1/payments", $payment_data);

		return print_r($payment);


	}


}

?>