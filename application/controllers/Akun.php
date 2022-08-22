<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
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
		$data['title']  = 'Pengguna';
		$data['view']   = 'pengguna/index';
		$data['perawat'] = $this->m_global->get_data('perawat')->result();
		$this->load->view('lyt/index', $data);
	}
	public function get_akun()
	{
		$decode = json_decode($this->input->post('where'));

		$query = $this->m_global->get_data('akun', ['id_akun' => $decode->id_akun]);

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
	public function cek_simpan()
	{
		$cek_nik = $this->m_global->get_data('akun', ['nik' => $this->input->post('nik')]);
		if ($cek_nik->num_rows() > 0) {
			$json['status'] = false;
			$json['pesan'] = "NIK sudah terdaftar";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
		} else {
			$this->simpan_data();
		}
	}

	public function simpan_data()
	{
		if (empty($this->input->post('id_akun'))) {
			$data = [
				'nik' => $this->input->post('nik'),
				'nama_user' => $this->input->post('nama_user'),
				'password' => password_hash($this->input->post('password_conf'), PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
			];

			$query = $this->m_global->simpan_data('akun', $data);
		} else {
			$data = [
				'id_akun' => $this->input->post('id_akun'),
				'nik' => $this->input->post('nik'),
				'nama_user' => $this->input->post('nama_user'),
				'password' => password_hash($this->input->post('password_conf'), PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
			];

			$query = $this->m_global->update_data('akun', $data, ['id_akun' => $data['id_akun']]);
		}
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Silakan salin password anda: " . $this->input->post('password_conf');
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal simpan data";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function hapus_data($id_akun)
	{
		$query = $this->m_global->hapus_data('akun', ['id_akun' => $id_akun], "delete");
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil hapus data";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal hapus data";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function update_status($id_akun)
	{

		$cek_aktif = $this->m_global->get_data('akun', ['id_akun' => $id_akun])->row();
		if ($cek_aktif->is_active == 1) {
			$data['is_active'] = 0;
		} else {
			$data['is_active'] = 1;
		}

		$query = $this->m_global->update_data('akun', ['is_active' => $data['is_active']], ['id_akun' => $id_akun]);
		// if ($query) {
		// 	$this->m_global->ntf_swal("success", "Berhasil ubah status");
		// } else {
		// 	$this->m_global->ntf_swal("error", "Gagal ubah status");
		// }
		// redirect('akun');
		if ($query) {
			$json['status'] = true;
			$json['pesan'] = "Berhasil ubah status";
		} else {
			$json['status'] = false;
			$json['pesan'] = "Gagal ubah";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function get_dt_akun()
	{
		$this->load->model('m_dt_pengguna');
		$i = 1;
		$list   = $this->m_dt_pengguna->get_datatables();
		$data = array();
		foreach ($list as $key) {
			$row      = array();
			$row["no"]    = $i++;
			$row["nik"] = $key->nik;
			$row["nama_user"]    = $key->nama_user;
			$row["role"]    = ($key->role == 2) ? "Admin" : (($key->role == 3) ? "Perawat" : "Developer");
			$row["status"]    = "<a href='#' onclick='update_status(" . $key->id_akun . ")' class=" . (($key->is_active == 1) ? "btn-success" : "btn-danger") . ">" . (($key->is_active == 1) ? "Aktif" : "Tidak Aktif") . "</a>";
			$row["aksi"] 	  = '<a onclick="hapus_data(' . $key->id_akun . ')" href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
			$data[]   = $row;
		}
		$output = array(
			"draw"          => $_POST['draw'],
			"recordsTotal"  => $this->m_dt_pengguna->count_all(),
			"recordsFiltered" => $this->m_dt_pengguna->count_filtered(),
			"data"          => $data,
		);

		echo json_encode($output);
	}

	public function profil()
	{
		$data['title']  = 'Profil';
		$data['view']   = 'pengguna/profil';
		$data['akun'] = $this->m_global->get_data('akun', ['nik' => $_SESSION['nik']])->row();
		$this->load->view('lyt/index', $data);
	}
}

/* End of file Akun.php */
