<?php 

class Grup_m extends MY_Model
{
	public function __construct()
	{
		$this->table 	= 'grup';
		$this->pk 		= 'id_grup';
	}
}