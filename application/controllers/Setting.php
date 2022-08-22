<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$_SESSION['nama_user']) {
			$this->m_global->ntf_swal("error", "Silakan login terlebih dahulu");
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['title']  = 'Setting';
		$data['pasien'] = $this->m_global->get_data('pasien')->result();
		$data['perawat'] = $this->m_global->get_data('perawat')->result();
		$data['ruangan'] = $this->m_global->get_data('ruangan')->result();

		$data['view']   = 'setting/index';

		$this->load->view('lyt/index', $data);
	}

	public function get_setting()
	{
		$decode = json_decode($this->input->post('where'));

		$query = $this->m_global->get_data('setting_perangkat', ['id_alat' => $decode->id_alat]);

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
		if (empty($this->input->post('id_alat'))) {
			$data = [
				'id_perangkat' => $this->input->post('id_perangkat'),
				'id_pasien' => $this->input->post('id_pasien'),
				'id_perawat' => $this->input->post('id_perawat'),
				'id_ruangan' => $this->input->post('id_ruangan'),

			];

			$query = $this->m_global->simpan_data('setting_perangkat', $data);
		} else {
			$data = [
				'id_alat' => $this->input->post('id_alat'),
				'id_perangkat' => $this->input->post('id_perangkat'),
				'id_pasien' => $this->input->post('id_pasien'),
				'id_perawat' => $this->input->post('id_perawat'),
				'id_ruangan' => $this->input->post('id_ruangan'),
			];

			$query = $this->m_global->update_data('setting_perangkat', $data, ['id_alat' => $data['id_alat']]);
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
	public function hapus_data($id_alat)
	{
		$query = $this->m_global->hapus_data('setting_perangkat', ['id_alat' => $id_alat], "delete");
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil hapus data";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal hapus data";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function get_dt_setting()
	{
		$this->load->model('m_dt_setting');
		$i = 1;
		$list   = $this->m_dt_setting->get_datatables();
		$data = array();
		foreach ($list as $key) {
			$row      = array();
			$row["no"]    = $i++;
			$row["id_perangkat"] = $key->id_perangkat;
			$row["nama_pasien"]    = $key->nama_pasien;
			$row["nama_perawat"]    = $key->nama_perawat;
			$row["nama_ruangan"]    = $key->nama_ruangan;
			$row["aksi"] 	  = '<a onclick="edit_data(' . $key->id_alat . ')" class="btn btn-sm btn-primary" href="#"><i class="fas fa-pencil-alt"></i></a> <a onclick="hapus_data(' . $key->id_alat . ')" href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
			$data[]   = $row;
		}
		$output = array(
			"draw"          => $_POST['draw'],
			"recordsTotal"  => $this->m_dt_setting->count_all(),
			"recordsFiltered" => $this->m_dt_setting->count_filtered(),
			"data"          => $data,
		);

		echo json_encode($output);
	}
}

/* End of file Setting.php */
