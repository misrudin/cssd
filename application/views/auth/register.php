<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title><?= $title; ?> - SIMOISEN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
	<meta content="Themesdesign" name="author" />
	<!-- Sweet Alert-->
	<link href="<?= base_url(); ?>public/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

	<!-- App favicon -->

	<link rel="shortcut icon" href="<?= base_url(); ?>public/assets/images/logo.png">

	<!-- DataTables -->
	<link href="<?= base_url(); ?>public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>public/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Css -->
	<link href="<?= base_url(); ?>public/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= base_url(); ?>public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= base_url(); ?>public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/assets/libs/toastr/build/toastr.min.css">

	<!-- ==== JS ==== -->

	<script src="<?= base_url(); ?>public/assets/libs/jquery/jquery.min.js"></script>

	<!-- Sweet Alerts js -->
	<script src="<?= base_url(); ?>public/assets/libs/sweetalert2/sweetalert2.min.js"></script>

	<!-- Toastr -->
	<script src="<?= base_url(); ?>public/assets/libs/toastr/build/toastr.min.js"></script>

	<script>
		let base_url = '<?= base_url(); ?>';
	</script>
	<!-- ==== JS ==== -->

</head>

<body class="bg-info">
	<div class="container">

		<div class="d-flex justify-content-center">
			<div class="col-md-8">
				<div class="card mt-5">
					<div class="card-body">
						<div class="text-center">
							<div>
								<a href="index.html" class="logo"><img src="<?= base_url('public/'); ?>assets/images/logo.png" height="85" alt="logo"></a>
							</div>

							<h4 class="font-size-18 my-4">Halaman Pendaftaran</h4>
						</div>

						<div class="">
							<form id="formAdd" class="form-horizontal">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="fas fa-key text-info auti-custom-input-icon"></i>
											<label for="nik">NIK</label>
											<input type="text" class="form-control" id="nik" name="nik" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="ri-user-fill text-info auti-custom-input-icon"></i>
											<label for="nama_perawat">Nama Perawat</label>
											<input type="text" class="form-control" id="nama_perawat" name="nama_perawat" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="fas fa-map-marker-alt text-info auti-custom-input-icon"></i>
											<label for="tempat_lahir">Tempat Lahir</label>
											<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
										</div>

									</div>
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="far fa-calendar-alt text-info auti-custom-input-icon"></i>
											<label for="tgl_lahir">Tanggal Lahir</label>
											<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="mdi mdi-gender-male-female text-info auti-custom-input-icon"></i>
											<label for="jk">Jenis Kelamin</label>
											<select name="jk" id="jk" class="form-control" required>
												<option value="1">Laki-laki</option>
												<option value="2">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="mdi mdi-human text-info auti-custom-input-icon"></i>
											<label for="umur">Umur<sup style="color: red;">*)dalam angka</sup></label>
											<input type="number" class="form-control" id="umur" name="umur">
										</div>
									</div>
								</div>

								<div class="form-group auth-form-group-custom mb-4">
									<i class="mdi mdi-home-map-marker text-info auti-custom-input-icon"></i>
									<label for="alamat">Alamat</label>
									<textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" required></textarea>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="ri-lock-2-line text-info auti-custom-input-icon"></i>
											<label for="password">Password</label>
											<input type="password" class="form-control" id="password" name="password">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group auth-form-group-custom mb-4">
											<i class="ri-lock-2-line text-info auti-custom-input-icon"></i>
											<label for="password_conf">Konfirmasi Password</label>
											<input type="password" class="form-control" id="password_conf" name="password_conf">
										</div>
									</div>
									<div class="col">
										<span id="msg"></span>
									</div>
								</div>


								<div class="mt-4 text-center">
									<button class="btn btn-info w-md waves-effect waves-light" type="submit">Daftar</button>
								</div>

							</form>
						</div>

						<div class="mt-3 text-center">
							<p>Sudah punya akun ? <a href="<?= base_url('auth/login'); ?>"><b>Masuk</b></a></p>
							Crafted with <i class="mdi mdi-heart text-danger"></i> by SIMOISEN
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- JAVASCRIPT -->
	<script>
		let formAdd = document.querySelector("#formAdd");

		formAdd.addEventListener("submit", (e) => {
			e.preventDefault();
			const formData = new FormData(e.currentTarget);
			daftar(formData);
		})

		daftar = async (formData) => {
			let url = `${base_url}auth/cek_regis`;
			const response = await request_xhr(url, "POST", formData);
			console.log(response.pesan);
			if (response.status) {
				Swal.fire({
					icon: "success",
					title: `${response.pesan}`,
					showConfirmButton: false,
					timer: 2500
				});
				window.location.href = `${base_url}auth/login`;
			} else {
				Swal.fire({
					icon: "warning",
					title: `${response.pesan}`,
					showConfirmButton: false,
					timer: 2500
				});
			}
		}

		document.querySelector("#password_conf").addEventListener("keyup", function() {
			let pass = document.querySelector("#password").value;
			let pass_conf = $(this).val();

			if (pass_conf.length === 0) {
				document.querySelector("#msg").style.display = "none";
				$("#formAdd").find('[type=submit]').attr("disabled", "disabled");
			} else {
				if (pass == pass_conf) {
					document.querySelector("#msg").innerHTML = '<p class="badge-success block-tag text-center"><small class="block-area white">Password sama</small></p>';
					document.querySelector("#msg").style.display = 'block';
					$("#formAdd").find('[type="submit"]').removeAttr('disabled', 'disabled');
				} else {
					document.querySelector("#msg").innerHTML = '<p class="badge-danger block-tag text-center"><small class="block-area white">Password tidak sama</small></p>';
					$("#formAdd").find('[type=submit]').attr("disabled", "disabled");
				}
			}
		})
	</script>

	<script src="<?= base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/metismenu/metisMenu.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/libs/simplebar/simplebar.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/libs/node-waves/waves.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/js/script/global_script.js"></script>
	<script src="<?= base_url(); ?>public/assets/js/app.js"></script>

</body>

</html>
