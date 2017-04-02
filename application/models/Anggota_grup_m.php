<?php 

class Anggota_grup_m extends MY_Model
{
	public function __construct()
	{
		$this->table 	= 'anggota_grup';
		$this->pk 		= 'id_anggota_grup';
	}
}