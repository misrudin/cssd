<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dt_log extends CI_Model
{

	var $table = 'log_qty';
	var $column_order      = array('b.nama_barang', 'a.qty', 'a.jenis_proses');
	var $column_search     = array('b.nama_barang');
	var $order             = array('b.nama_barang' => 'asc'); // default order

	private function _get_datatables_query($id_barang)
	{
		$this->db->from($this->table . ' a');
		$this->db->join('barang b', 'a.id_barang = b.id_barang', 'left');
		$this->db->where('a.id_barang', $id_barang);

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

	function get_compiled_select($id_barang)
	{
		$this->_get_datatables_query($id_barang);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get_compiled_select();
		echo $query;
	}

	function get_datatables($id_barang)
	{
		$this->_get_datatables_query($id_barang);
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

	function count_filtered($id_barang)
	{

		$this->_get_datatables_query($id_barang);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from($this->table);


		return $this->db->count_all_results();
	}
}

/* End of file M_dt_log.php */
