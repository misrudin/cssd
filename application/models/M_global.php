<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_global extends CI_Model
{
	/**
	 * Fungsi untuk menampilkan data2 kustom yang diminta oleh programmer
	 * @param string $tabel = "nama tabel"
	 * @param array $where = ["param" => "value"]
	 * @param array $join = ["table" => "namaTable", "cond" => "logic", "type" => "type join (left, right, other)"]
	 * @param string $order
	 * @param string $select
	 * @param array $group_by
	 */

	public function get_data($table = null, $where = [], $join = [], $order = null, $select = "*")
	{
		if (empty($join)) {
			return $this->db->select($select)->from($table)->where($where)->order_by($order)->get();
		} else {
			return $this->db->select($select)->from($table)->join($join['table'], $join['cond'], $join['type'])->where($where)->order_by($order)->get();
		}
	}

	public function update_qty_barang($qty, $id_barang)
	{
		$this->db->set('stok_tersedia', 'stok_tersedia+' . $qty, FALSE);
		$this->db->where('id_barang', $id_barang);
		return $this->db->update('barang');
	}

	public function update_qty_peminjaman($qty, $id_barang, $no_invoice)
	{
		$this->db->set('qty', 'qty-' . $qty, FALSE);
		$this->db->where('id_barang', $id_barang);
		$this->db->where('no_invoice', $no_invoice);
		return $this->db->update('peminjaman_detail');
	}

	public function simpan_data($table = null, $data = null)
	{
		return $this->db->insert($table, $data);
	}



	public function update_data($table = null, $data = [], $where = [])
	{
		return $this->db->update($table, $data, $where);
	}

	public function hapus_data($table = null, $where = [], $method = null)
	{
		if ($method == 'delete' || $method == null) {
			return $this->db->delete($table, $where);
		}
	}

	public function ntf_toastr($clr_msg, $ctn_msg, $hed_msg)
	{
		/*
			info
			warning
			success
			error
		*/
		$newdata = array(
			'ntf_toastr'      => true,
			'clr_toastr'      => $clr_msg,
			'hed_toastr'     => $hed_msg,
			'ctn_toastr'     => $ctn_msg,
		);
		$this->session->set_flashdata($newdata);
	}

	public function ntf_swal($clr, $msg)
	{
		$newdata = array(
			'ntf_swal'      => true,
			'clr_swal'      => $clr,
			'msg_swal'     => $msg,
		);
		$this->session->set_flashdata($newdata);
	}
}

/* End of file m_global.php */
