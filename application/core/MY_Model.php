<?php 

class MY_Model extends CI_Model
{
	protected $table;
	protected $pk;

	public function get($cond = array())
	{
		if (is_array($cond) || is_string($cond))
			$this->db->where($cond);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_row($cond)
	{
		if (is_array($cond) || is_string($cond))
			$this->db->where($cond);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function delete($pk)
	{
		$this->db->where($this->pk, $pk);
		return $this->db->delete($this->table);
	}

	public function update($pk, $data)
	{
		$this->db->where($this->pk, $pk);
		return $this->db->update($this->table, $data);
	}
}