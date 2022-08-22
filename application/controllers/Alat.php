<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']  = 'Alat';
		$data['view']   = 'alat/index';

		$this->load->view('lyt/index', $data);
	}

	public function detail_alat($id_barang)
	{
		$data['title']  = 'Detail Alat';
		$data['alat'] = $this->m_global->get_data('barang', ['id_barang' => $id_barang])->row();
		$data['id_barang'] = $id_barang;
		$data['view']   = 'alat/detail_alat';
		$this->load->view('lyt/index', $data);
	}

	public function print_alat()
	{
		$data['title']  = 'List Alat CSSD';
		$data['alat'] = $this->m_global->get_data('barang')->result();
		$this->load->view('alat/print_alat', $data);
	}


	public function get_alat()
	{
		$decode = json_decode($this->input->post('where'));

		$query = $this->m_global->get_data('barang', ['id_barang' => $decode->id_barang]);

		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil ambil data";
			$json['data'] = $query->row();
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal ambil data";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function get_alat_by_id($id_barang)
	{
		$query = $this->m_global->get_data('barang', ['id_barang' => $id_barang]);
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil ambil data";
			$json['data'] = $query->row();
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal ambil data";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	private function _add_stok($id_barang, $jml)
	{
		$this->db->set('stok_total', 'stok_total+' . $jml, FALSE);
		$this->db->set('stok_tersedia', 'stok_tersedia+' . $jml, FALSE);
		$this->db->where('id_barang', $id_barang);
		return $this->db->update('barang');
	}
	private function _kurangi_stok($id_barang, $jml)
	{
		$this->db->set('stok_total', 'stok_total-' . $jml, FALSE);
		$this->db->set('stok_tersedia', 'stok_tersedia-' . $jml, FALSE);
		$this->db->where('id_barang', $id_barang);
		return $this->db->update('barang');
	}

	public function gnrt()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// Output: S-G4jCi
		$json['nama_alat'] =  'Alat-' . substr(str_shuffle($permitted_chars), 0, 5);
		return $json['nama_alat'];
	}

	public function simpan_add_stock()
	{
		$id = $this->input->post('id_barang');
		$stok = $this->input->post('stok_total');
		$proses = $this->input->post('jenis_proses');
		if ($proses == 'tambah') {
			$query = $this->_add_stok($id, $stok);
		} else if ($proses == 'kurangi') {
			$query = $this->_kurangi_stok($id, $stok);
		}

		$data_log = [
			'id_barang' => $id,
			'qty' => $stok,
			'jenis_proses' => $proses
		];
		$save_log = $this->m_global->simpan_data('log_qty', $data_log);


		if ($query && $save_log) {
			$this->m_global->ntf_swal('success', 'Berhasil perbarui data');
		} else {
			$this->m_global->ntf_swal('error', 'Gagal perbarui data');
		}
		redirect('alat/detail_alat/' . $id);
	}



	public function simpan_data()
	{

		// $this->load->library('ciqrcode');
		// $config['cacheable'] = true;
		// $config['cachedir'] = './image_qr/';
		// $config['errorlog'] = './image_qr/';
		// $config['imagedir'] = './image_qr/';
		// $config['quality'] = true;
		// $config['size'] = '1024';
		// $config['black']		= array(255, 255, 255); // array, default is array(255,255,255)
		// $config['white']		= array(10, 10, 10); // array, default is array(0,0,0)

		// $this->ciqrcode->generate($config);
		// if (empty($this->input->post('id_barang'))) {

		// 	$data = [
		// 		'nama_barang' => $this->input->post('nama_barang'),
		// 		//'stok_total' => $this->input->post('stok_total'),
		// 		'satuan' => $this->input->post('satuan'),
		// 		'qr_code' => $this->gnrt() . '.png',
		// 	];
		// 	$query = $this->m_global->simpan_data('barang', $data);
		// 	$id_barang = $this->db->insert_id();
		// 	//$this->add_stok($id_barang, $this->input->post('stok_total'));
		// 	$cek_data = $this->m_global->get_data('barang', [], [], 'id_barang desc')->row();

		// 	$params['data'] = $cek_data->id_barang;
		// 	$params['level'] = 'H';
		// 	$params['size'] = 10;
		// 	$params['savename'] = FCPATH . $config['imagedir'] . $data['qr_code'];
		// 	$this->ciqrcode->generate($params);
		// } else {
		// 	$cek_file = $this->m_global->get_data('barang', ['id_barang' => $this->input->post('id_barang')])->row();
		// 	if (!empty($cek_file->qr_code)) {
		// 		$qr = './image_qr/' . $cek_file->qr_code;
		// 		if (is_file($qr)) {
		// 			unlink($qr);
		// 		}
		// 	}

		// 	$nama_file = $this->gnrt() . '.png';
		// 	$params['data'] = $cek_file->id_barang;
		// 	$params['level'] = 'H';
		// 	$params['size'] = 10;
		// 	$params['savename'] = FCPATH . $config['imagedir'] . $nama_file;
		// 	$this->ciqrcode->generate($params);

		// 	$data = [
		// 		'nama_barang' => $this->input->post('nama_barang'),
		// 		// 'stok_total' => $this->input->post('stok_total'),
		// 		'satuan' => $this->input->post('satuan'),
		// 		'qr_code' => $nama_file,
		// 	];

		// 	$query = $this->m_global->update_data('barang', $data, ['id_barang' => $this->input->post('id_barang')]);
		// }
		// if ($query) {
		// 	$this->m_global->ntf_swal('success', 'Berhasil tambah data');
		// } else {
		// 	$this->m_global->ntf_swal('error', 'Gagal tambah data');
		// }
		// redirect('alat');
	}
	public function hapus_data($id_barang)
	{
		$query = $this->m_global->hapus_data('barang', ['id_barang' => $id_barang], "delete");
		$query_delete_log = $this->m_global->hapus_data('log_qty', ['id_barang' => $id_barang], "delete");
		if ($query && $query_delete_log) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil hapus data";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal hapus data";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function get_dt_barang()
	{
		$this->load->model('m_dt_barang');
		$pencarian = $_POST['pencarian'];
		$list   = $this->m_dt_barang->get_datatables($pencarian);
		$data = array();
		foreach ($list as $key) {
			$row      = array();
			$row["no"] = '';
			$row["nama_barang"] = $key->nama_barang;
			$row["stok_total"] = $key->stok_total;
			$row["stok_tersedia"] = $key->stok_tersedia;
			$row['qr_code'] = '<img src="' . site_url('image_qr/') . $key->qr_code . '" width="75px">';

			$row["aksi"] 	  = '<a onclick="edit_data(' . $key->id_barang . ')" class="btn btn-sm btn-primary" href="#"><i class="fas fa-pencil-alt"></i> Edit </a> <a onclick="hapus_data(' . $key->id_barang . ')" href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a> <a class="btn btn-sm btn-success" target="_blank" href="' . base_url('alat/detail_alat/' . $key->id_barang) . '"><i class="ri-share-box-fill"></i> Detail</a>';
			$data[]   = $row;
		}
		$output = array(
			"draw"          => $_POST['draw'],
			"recordsTotal"  => $this->m_dt_barang->count_all(),
			"recordsFiltered" => $this->m_dt_barang->count_filtered($pencarian),
			"data"          => $data,
		);

		echo json_encode($output);
	}

	public function get_dt_log($id_barang)
	{
		$this->load->model('m_dt_log');

		$list   = $this->m_dt_log->get_datatables($id_barang);
		$data = array();
		foreach ($list as $key) {
			$row      = array();
			$row["no"] = '';
			$row["nama_barang"] = $key->nama_barang;
			$row["qty"] = $key->qty;
			$row["jenis_proses"] = $key->jenis_proses;
			$data[]   = $row;
		}
		$output = array(
			"draw"          => $_POST['draw'],
			"recordsTotal"  => $this->m_dt_log->count_all(),
			"recordsFiltered" => $this->m_dt_log->count_filtered($id_barang),
			"data"          => $data,
		);

		echo json_encode($output);
	}
}

/* End of file Alat.php */
