<?php 

namespace SG;

class PageManagerError extends Page {

	public function __construct($opts = array(), $tpl_dir = "/views/manager/", $cache_dir = "/views-cache/manager/")
	{

		parent::__construct($opts, $tpl_dir, $cache_dir);

	}

}

 ?>