<?php 

class Kalendar_m extends MY_Model
{
	public function __construct()
	{
		$this->table 	= 'kalendar';
		$this->pk 		= 'id_kalendar'; 
	}
}