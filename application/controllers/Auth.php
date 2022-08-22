<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function login()
	{
		$data['title']  = 'Login';
		$this->load->view('auth/login', $data);
	}

	public function cek()
	{
		echo password_hash("admin", PASSWORD_BCRYPT);
	}

	public function cek_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->m_global->get_data("akun a", ['a.nik' => $username, 'a.is_active' => 1], ["table" => "perawat b", "cond" => "a.nik=b.nik", "type" => "left"]);

		$cek_nik = $query->num_rows();
		$data_user = $query->row();

		#cek apakah nik ada
		if ($cek_nik > 0) {
			$cek_pwd = password_verify($password, $data_user->password);
			if ($cek_pwd) {
				$this->m_global->ntf_swal("success", "Selamat Datang, $data_user->nama_user");
				$_SESSION['nik'] = $data_user->nik;
				$_SESSION['nama_user'] = $data_user->nama_user;
				$_SESSION['role'] = $data_user->role;
				$_SESSION['logged_in_datetime'] = date("d M Y H:i");
				$json['status'] = true;
				$json['pesan'] = "Berhasil Login";
			} else {
				$json['status'] = false;
				$json['pesan'] = "Password salah";
			}
		} else {
			$json['status'] = false;
			$json['pesan'] = "Email tidak terdaftar";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function logout()
	{
		//hapus semua sesssion
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}

/* End of file Auth.php */
