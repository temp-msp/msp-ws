<?php 

class Lokasi_m extends MY_Model
{
	public function __construct()
	{
		$this->table 	= 'lokasi';
		$this->pk 		= 'id_lokasi';
	}
}