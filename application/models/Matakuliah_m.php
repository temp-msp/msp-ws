<?php 

class Matakuliah_m extends MY_Model
{
	public function __construct()
	{
		$this->table 	= 'matakuliah';
		$this->pk 		= 'id_matakuliah';
	}
}