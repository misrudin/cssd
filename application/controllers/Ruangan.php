<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']  = 'Ruangan';
		$data['view']   = 'ruangan/index';

		$this->load->view('lyt/index', $data);
	}
	public function get_ruangan()
	{
		$decode = json_decode($this->input->post('where'));

		$query = $this->m_global->get_data('ruangan', ['id_ruangan' => $decode->id_ruangan]);

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

	public function simpan_data()
	{
		if (empty($this->input->post('id_ruangan'))) {
			$data = [
				'nama_ruangan' => $this->input->post('nama_ruangan'),

			];

			$query = $this->m_global->simpan_data('ruangan', $data);
		} else {
			$data = [
				'id_ruangan' => $this->input->post('id_ruangan'),
				'nama_ruangan' => $this->input->post('nama_ruangan'),
			];

			$query = $this->m_global->update_data('ruangan', $data, ['id_ruangan' => $data['id_ruangan']]);
		}
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil simpan data";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal simpan data";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function hapus_data($id_ruangan)
	{
		$query = $this->m_global->hapus_data('ruangan', ['id_ruangan' => $id_ruangan], "delete");
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil hapus data";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal hapus data";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function get_dt_ruangan()
	{
		$this->load->model('m_dt_ruangan');
		$i = 1;
		$list   = $this->m_dt_ruangan->get_datatables();
		$data = array();
		foreach ($list as $key) {
			$row      = array();
			$row["no"]    = null;
			$row["nama_ruangan"]    = $key->nama_ruangan;
			$row["aksi"] 	  = '<a onclick="edit_data(' . $key->id_ruangan . ')" class="btn btn-sm btn-primary" href="#"><i class="fas fa-pencil-alt"></i></a> <a onclick="hapus_data(' . $key->id_ruangan . ')" href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
			$data[]   = $row;
		}
		$output = array(
			"draw"          => $_POST['draw'],
			"recordsTotal"  => $this->m_dt_ruangan->count_all(),
			"recordsFiltered" => $this->m_dt_ruangan->count_filtered(),
			"data"          => $data,
		);

		echo json_encode($output);
	}
}

/* End of file Ruangan.php */
