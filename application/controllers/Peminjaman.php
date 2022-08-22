<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Peminjaman';
		$data['view'] = 'peminjaman/index';
		$data['ruangan'] = $this->m_global->get_data('ruangan')->result();
		$data['barang'] = $this->m_global->get_data('barang')->result();
		$this->load->view('lyt/index', $data);
	}

	public function get_data($no_invoice, $id_barang)
	{
		$query = $this->m_global->get_data('peminjaman_detail', ['no_invoice' => $no_invoice, 'id_barang' => $id_barang]);
		if ($query) {
			$json['data'] = $query->row();
			$json['pesan'] = 'berhasil ambil data';
			$json['status'] = true;
		} else {
			$json['pesan'] = 'gagal ambil data';
			$json['status'] = false;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function index_pengembalian($id_peminjaman)
	{
		$data['title'] = 'Pengembalian Alat';
		$data['view'] = 'peminjaman/index_pengembalian';
		$data['peminjaman'] = $this->m_global->get_data('peminjaman a', ['a.id_peminjaman' => $id_peminjaman], ['table' => 'ruangan b', 'cond' => 'a.id_ruangan=b.id_ruangan', 'type' => 'left'])->row();
		$data['peminjaman_detail'] = $this->m_global->get_data('peminjaman_detail a', ['a.id_peminjaman' => $id_peminjaman], ['table' => 'barang b', 'cond' => 'a.id_barang=b.id_barang', 'type' => 'left'])->result();
		// var_dump($data['peminjaman_detail']);
		// die();
		$this->load->view('lyt/index', $data);
	}

	public function get_dt_peminjaman($parameter)
	{
		$this->load->model('m_dt_peminjaman');
		if ($parameter == 'riwayat') {
			$where = ['tgl_kembali_semua !=' => NULL];
		}
		if ($parameter == 'list') {
			$where = ['tgl_kembali_semua' => NULL];
		}
		$list = $this->m_dt_peminjaman->get_datatables($where);
		$data = array();
		foreach ($list as $key) {
			$row = array();
			$row['no'] = null;
			$row['no_invoice'] = $key->no_invoice;
			$row['nama_ruangan'] = $key->nama_ruangan;
			$row['status'] = (!empty($key->tgl_kembali_semua)) ? "<span class='badge badge-primary'>Barang sudah kembali semua</span>" : "<span class='badge badge-danger'>Barang belum kembali semua</span>";
			// $row['status'] = ($key->status == 0) ? "<span class='badge badge-warning'>Diproses</span>" : (($key->status == 1) ? "<span class='badge badge-success'>Dipinjam</span>" : "<span class='badge badge-primary'>Dikembalikan</span>");
			$row['tgl_pinjam'] = (!empty($key->tgl_pinjam)) ? tgl_indo($key->tgl_pinjam) : "-";
			$row['tgl_kembali'] = (!empty($key->tgl_kembali_semua)) ? tgl_indo($key->tgl_kembali_semua) : "-";
			// $row["aksi"] 	  = ($key->status == 0) ? "<a class='btn btn-sm btn-primary' href=" . base_url('peminjaman/add_detail/' . $key->no_invoice) . ">Tambah Alat</a>" : (($key->status != 0 && !$key->tgl_kembali) ? "<button class='btn btn-sm btn-success' onclick='pengembalian(" . $key->no_invoice . ")'>Kembalikan</button> <a class='btn btn-sm btn-danger' href=" . base_url('peminjaman/add_detail/' . $key->no_invoice) . ">Detail</a>" : (($key->status == 2 && $key->tgl_kembali) ? "<a class='btn btn-sm btn-danger' href=" . base_url('peminjaman/add_detail/' . $key->no_invoice) . ">Detail</a>" : ""));
			$row['aksi'] = "<a class='btn btn-sm btn-danger' href=" . base_url('peminjaman/add_detail/' . $key->no_invoice) . ">Detail</a>";
			$data[]   = $row;
		}
		$output = array(
			"draw"          => $_POST['draw'],
			"recordsTotal"  => $this->m_dt_peminjaman->count_all($where),
			"recordsFiltered" => $this->m_dt_peminjaman->count_filtered($where),
			"data"          => $data,
		);

		echo json_encode($output);
	}

	function add()
	{
		$data['title'] = 'Buat Peminjaman';
		$data['view'] = 'peminjaman/add';
		$data['ruangan'] = $this->m_global->get_data('ruangan')->result();
		$data['no_invoice'] = $this->_gnrt();
		//$data['barang'] = $this->m_global->get_data('barang')->result();
		$this->load->view('lyt/index', $data);
	}

	private function _gnrt()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return 'INV' . substr(str_shuffle($permitted_chars), 0, 7);
	}

	function simpan_peminjaman()
	{
		$data = array(
			'id_ruangan' => $this->input->post('id_ruangan'),
			'no_invoice' => $this->input->post('no_invoice'),
			'tgl_pinjam' => date('Y-m-d')
		);
		$query = $this->m_global->simpan_data('peminjaman', $data);

		if ($query) {
			$this->m_global->ntf_swal('success', 'Berhasil simpan data');
		} else {
			$this->m_global->ntf_swal('error', 'Gagal simpan data');
		}

		redirect('peminjaman/add_detail/' . $data['no_invoice']);
	}
	function add_detail($no_invoice, $id_barang = null)
	{
		$data['no_invoice'] = $no_invoice;
		$data['id_barang'] = ($id_barang) ?: 0;
		$data['barang'] = $this->m_global->get_data('barang')->result();
		$data['title'] = 'Buat Peminjaman';
		$data['view'] = 'peminjaman/add_detail';
		$data['peminjaman'] = $this->m_global->get_data('peminjaman a', ['a.no_invoice' => $no_invoice], ['table' => 'ruangan b', 'cond' => 'a.id_ruangan=b.id_ruangan', 'type' => 'left'])->row();

		$this->load->view('lyt/index', $data);
	}

	function proses_peminjaman($no_invoice)
	{
		$peminjaman = $this->m_global->get_data('peminjaman_detail', ['no_invoice' => $no_invoice])->row();
		if ($peminjaman) {
			if ($peminjaman->status == 0) {


				$data = [
					'status' => 1,
				];

				//update tbl barang
				$peminjaman_detail = $this->m_global->get_data('peminjaman_detail', ['no_invoice' => $no_invoice])->result();
				if ($peminjaman_detail) {
					foreach ($peminjaman_detail as $key => $value) {
						$this->db->set('stok_tersedia', 'stok_tersedia-' . $value->qty, FALSE);
						$this->db->where('id_barang', $value->id_barang);
						$qry_update_barang = $this->db->update('barang');
						$qry_update_status = $this->m_global->update_data('peminjaman_detail', $data, ['no_invoice' => $no_invoice]);
					}
				}
			}
		}
		if ($qry_update_barang && $qry_update_status) {
			$json['pesan'] = 'Berhasil meminjam alat';
			$json['no_invoice'] = $no_invoice;
			$json['status'] = true;
		} else {
			$json['pesan'] = 'Gagal meminjam alat';
			$json['status'] = false;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	function proses_pengembalian()
	{

		$no_invoice = $this->input->post('no_invoice');
		$id_barang = $this->input->post('id_barang');
		$qty = $this->input->post('stok_update');

		$cek_stok = $this->m_global->get_data('peminjaman_detail', ['id_barang' => $id_barang])->row();
		if ($cek_stok->qty - $qty == 0) {
			$data['status'] = 2;
		} else {
			$data['status'] = 1;
		}
		$data['tgl_kembali'] = date("Y-m-d");

		$qry_update_peminjaman_detail = $this->m_global->update_data('peminjaman_detail', $data, ['id_barang' => $id_barang]);

		$jml_data_peminjaman_detail = $this->db->where("no_invoice", $no_invoice)->count_all_results('peminjaman_detail');
		$jml_data_dikembalikan = $this->db->where(['status' => 2, 'no_invoice' => $no_invoice])->count_all_results('peminjaman_detail');

		if ($jml_data_peminjaman_detail == $jml_data_dikembalikan) {
			$this->m_global->update_data('peminjaman', ['tgl_kembali_semua' => date("Y-m-d")], ['no_invoice' => $no_invoice]);
		}

		$qry_update_qty_peminjaman_detail = $this->m_global->update_qty_peminjaman($qty, $id_barang, $no_invoice);
		$qry_update_barang = $this->m_global->update_qty_barang($qty, $id_barang);

		if ($qry_update_peminjaman_detail && $qry_update_barang && $qry_update_qty_peminjaman_detail) {
			$this->m_global->ntf_swal("success", 'Berhasil mengembalikan barang');
		} else {
			$this->m_global->ntf_swal("error", 'Gagal mengembalikan barang');
		}
		redirect('peminjaman/add_detail/' . $no_invoice);
	}



	function add_detail_temp($no_invoice, $id_barang)
	{
		$cek_pinjam = $this->m_global->get_data('peminjaman_detail', ['no_invoice' => $no_invoice, 'id_barang' => $id_barang])->row();
		// var_dump($cek_pinjam);
		// die();
		if ($cek_pinjam) {
			$this->m_global->ntf_swal('error', "Alat sudah dipinjam");
			redirect('peminjaman/add_detail/' . $no_invoice);
		} else {
			$cek_id_barang = $this->m_global->get_data('barang', ['id_barang' => $id_barang])->row();
			$cek_no_invoice = $this->m_global->get_data('peminjaman', ['no_invoice' => $no_invoice])->row();
			if ($cek_id_barang && $cek_no_invoice) {
				redirect('peminjaman/add_detail/' . $no_invoice . '/' . $id_barang);
			} else {
				redirect('peminjaman/add_detail/' . $no_invoice);
			}
		}
	}

	function add_peminjaman_detail($no_invoice, $id_barang, $qty)
	{
		$data = array(
			'no_invoice' => $no_invoice,
			'id_barang' => $id_barang,
			'qty' => $qty,
			'status' => 0,
			'tgl_pinjam' => date('Y-m-d')
		);
		$cek_pinjam = $this->m_global->get_data('peminjaman_detail', ['no_invoice' => $no_invoice, 'id_barang' => $id_barang])->row();
		if (!$cek_pinjam) {
			$query = $this->m_global->simpan_data('peminjaman_detail', $data);
			if ($query) {
				$this->m_global->ntf_swal('success', "Berhasil simpan data");
			} else {
				$this->m_global->ntf_swal('error', "Gagal simpan data");
			}
		} else {
			$this->m_global->ntf_swal('error', "Alat sudah dipinjam");
		}
		redirect('peminjaman/add_detail/' . $no_invoice);
	}

	public function coba()
	{
		$cek_update = $this->m_global->get_data('barang', ['id_barang' => 3])->row();
		$data_update = ['stok' => intval($cek_update->stok) - intval(3)];
		echo json_encode($data_update);
	}

	public function pinjam()
	{
		$data = [
			'id_barang' => $this->input->post('id_barang'),
			'id_ruangan' => $this->input->post('id_ruangan'),
			'jumlah' => $this->input->post('qty'),
			'tgl_pinjam' => date('Y-m-d'),
			'tgl_kembali' => date('Y-m-d'),
			'status' => 'P'
		];

		$query = $this->m_global->simpan_data('peminjaman', $data);

		$cek_update = $this->m_global->get_data('barang', ['id_barang' => $data['id_barang']])->row();
		$data_update['stok'] = intval($cek_update->stok) - intval($data['jumlah']);
		$query_update = $this->m_global->update_data('barang', $data_update, ['id_barang' => $data['id_barang']]);

		if ($query && $query_update) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil meminjam ";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal meminjam ";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function hapus_barang_peminjaman($no_invoice)
	{
		$query = $this->m_global->hapus_data('peminjaman_detail', ['no_invoice' => $no_invoice]);
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil menghapus data ";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal menghapus data ";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}

/* End of file Peminjaman.php */
