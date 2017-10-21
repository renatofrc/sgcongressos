<?php 
namespace SG\Model;

use \SG\DB\Sql;
use \SG\Model;
use \SG\Mailer;
use \SG\Model\User;
use \SG\Model\Participant;
use \MercadoPago\Mp;

class Pay {

	const SANDBOX_KEY = "TEST-7ccca18c-9c7d-42d8-9309-1c531c3d9411";

    const SANDBOX_TOKEN = 
    "TEST-5867712708748536-021314-a581768ce66a8cd085b479fa7cb76cec__LA_LC__-203534313"


    public static function getAuthentication()
    {

    	$mp = new MP (SANDBOX_TOKEN);

		$payment = $mp->get ("/v1/payments/[ID]");

		print_r ($payment);

    }

}


 ?>