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

<body class="auth-body-bg bg-info">

	<div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
		<div class="w-100">
			<div class="row justify-content-center">
				<div class="col-lg-5">
					<div class="card">
						<div class="card-body">
							<div class="text-center">
								<div>
									<a href="index.html" class="logo"><img src="<?= base_url('public/'); ?>assets/images/logo.png" height="85" alt="logo"></a>
								</div>

								<h4 class="font-size-18 mt-4">Sistem Informasi Monitoring Infus Pasien</h4>
							</div>

							<div class="p-2 mt-5">
								<form id="formLogin" class="form-horizontal">

									<div class="form-group auth-form-group-custom mb-4">
										<i class="ri-user-2-line text-info auti-custom-input-icon"></i>
										<label for="username">Username</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan NIK">
									</div>

									<div class="form-group auth-form-group-custom mb-4">
										<i class="ri-lock-2-line text-info auti-custom-input-icon"></i>
										<label for="password">Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
									</div>

									<div class="mt-4 text-center">
										<button class="btn btn-block btn-info w-md waves-effect waves-light" type="submit">Masuk</button>
									</div>

								</form>
							</div>

							<div class="mt-3 text-center">
								Crafted with <i class="mdi mdi-heart text-danger"></i> by SIMOISEN
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php if (isset($_SESSION['ntf_swal'])) { ?>
		<script type="text/javascript">
			Swal.fire({
				icon: "<?= $_SESSION['clr_swal']; ?>",
				title: "<?= $_SESSION['msg_swal']; ?>",
				showConfirmButton: false,
				timer: 2500
			})
		</script>
	<?php  } ?>


	<!-- JAVASCRIPT -->
	<script defer src="<?= base_url(); ?>public/assets/js/script/login.js?ut=<?= date('his'); ?>">
	</script>
	<script src="<?= base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/metismenu/metisMenu.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/libs/simplebar/simplebar.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/libs/node-waves/waves.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/jszip/jszip.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/pdfmake/build/pdfmake.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/pdfmake/build/vfs_fonts.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/js/script/global_script.js"></script>
	<script src="<?= base_url(); ?>public/assets/js/app.js"></script>

</body>

</html>
