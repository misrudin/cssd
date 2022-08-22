<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dt_pengguna extends CI_Model
{

	var $table = 'akun a';
	var $column_order      = array('a.nik', 'nama_user', 'role', 'is_active', 'status');
	var $column_search     = array('a.nik');
	var $order             = array('a.nik' => 'asc'); // default order

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->join('perawat b', 'a.nik = b.nik', 'left');
		$this->db->where(['a.role !=' => 1]);

		$i = 0;
		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{
				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_compiled_select()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get_compiled_select();
		echo $query;
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			if ($query) {
				return $query->result();
			}
		} else {
			$query = $this->db->get();
			if ($query) {
				return $query->result();
			}
		}
	}

	function count_filtered()
	{

		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from($this->table);


		return $this->db->count_all_results();
	}
}

/* End of file M_dt_penguna.php */
