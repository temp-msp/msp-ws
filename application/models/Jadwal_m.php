<?php 

class Jadwal_m extends MY_Model
{
	public function __construct()
	{
		$this->table 	= 'jadwal';
		$this->pk 		= 'id_jadwal';
	}
}