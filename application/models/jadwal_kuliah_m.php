<?php 

class Jadwal_kuliah_m extends MY_Model
{
	public function __construct()
	{
		$this->table 	= 'jadwal_kuliah';
		$this->pk 		= 'id_jadwal_kuliah';
	}
}