<?php 

namespace SG;

use Rain\Tpl;
use SG\Model\Event;
use SG\DB\Sql;

class PageEvent {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	public function __construct($param, $opts = array()){
		
		$data = new Event();

		if($data->getUrl($param)){

	 		$sql = new Sql;

			$results = $sql->select("SELECT * FROM tb_event WHERE site = :site", array(
				":site" => $param
			));

			$data = $results[0];

			$cid = $data['create_user_id'];


			$results2 = $sql->select("SELECT desname,desemail,nrphone FROM tb_users u, tb_event e WHERE u.iduser = :cid", array(
				':cid' => $cid
			));

			$data2 = $results2[0];

			$this->options = array_merge($this->defaults, $opts);

			$config = array(
				"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/events/",
				"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/events-cache/".$data['site']."/",
				"debug"         => false
		    );

			Tpl::configure( $config );

			$this->tpl = new Tpl;

			$this->setData($this->options["data"]);

			if ($this->options["header"] === true) $this->tpl->draw("header");
		}


	}

	private function setData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		if ($this->options["footer"] === true) $this->tpl->draw("footer");

	}

}

 ?>