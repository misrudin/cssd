<!doctype html>

<html lang="en">

<head>

	<meta charset="utf-8" />

	<title><?= $title; ?> - CSSD SYSTEM</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta content="UNMAKU" name="description" />

	<meta content="temaa" name="author" />
	<link href="<?= base_url(); ?>manifest.json" rel="manifest">
	<!-- Sweet Alert-->
	<link href="<?= base_url(); ?>public/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

	<!-- App favicon -->

	<link rel="shortcut icon" href="<?= base_url(); ?>public/assets/images/logo-rsud.png">

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



<body data-sidebar="light" data-topbar="dark">


	<!-- Begin page -->

	<div id="layout-wrapper">



		<header id="page-topbar">

			<div class="navbar-header">

				<div class="d-flex">

					<!-- LOGO -->

					<div class="navbar-brand-box">

						<a href="<?= base_url('home'); ?>" class="logo logo-light">

							<span class="logo-sm">

								<img src="<?= base_url(); ?>public/assets/images/logo-rsud.png" alt="" height="30">

							</span>


							<span class="logo-lg">

								<img src="<?= base_url(); ?>public/assets/images/logo-cssd-01-01.png" alt="" height="75">

							</span>


						</a>

					</div>



					<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">

						<i class="ri-menu-2-line align-middle"></i>

					</button>


				</div>

			</div>

		</header>



		<!-- ========== Left Sidebar Start ========== -->

		<div class="vertical-menu">



			<div data-simplebar class="h-100">



				<!--- Sidemenu -->

				<div id="sidebar-menu">

					<!-- Left Menu Start -->

					<ul class="metismenu list-unstyled" id="side-menu">



						<li class="">

							<a href="<?= base_url('home'); ?>" class="waves-effect ">

								<i class="ri-home-4-line "></i>

								<span>Dashboard</span>

							</a>

						</li>

						<li class="">

							<a href="<?= base_url('alat'); ?>" class="waves-effect ">

								<i class=" ri ri-tools-fill "></i>

								<span>Alat</span>

							</a>

						</li>

						<li class="">

							<a href="<?= base_url('ruangan'); ?>" class="waves-effect ">

								<i class=" ri-hospital-line "></i>

								<span>Ruangan</span>

							</a>

						</li>
						<li class="">

							<a href="<?= base_url('peminjaman'); ?>" class="waves-effect ">

								<i class=" ri-qr-code-fill "></i>

								<span>Peminjaman</span>

							</a>

						</li>


					</ul>

				</div>

				<!-- Sidebar -->

			</div>

		</div>

		<!-- Left Sidebar End -->



		<!-- ============================================================== -->

		<!-- Start right Content here -->

		<!-- ============================================================== -->

		<div class="main-content ">



			<div class="page-content">

				<div class="container-fluid">





					<div class="row">

						<div class="col-md-12">
							<!-- Container -->
							<?php $this->load->view($view); ?>
							<!-- Container -->
						</div>

					</div>

					<!-- end row -->
					<?php if (isset($_SESSION['ntf_toastr'])) { ?>
						<script type="text/javascript">
							toastr.options.closeButton = true;
							toastr.<?= $_SESSION['clr_toastr'] ?>('<?= $_SESSION['ctn_toastr'] ?>', '<?= $_SESSION['hed_toastr'] ?>')
						</script>
					<?php  } ?>
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



					<!-- end row -->

				</div> <!-- container-fluid -->

			</div>

			<!-- End Page-content -->



			<footer class="footer">

				<div class="container-fluid">

					<div class="row">

						<div class="col-sm-6">
							<script>
								document.write(new Date().getFullYear())
							</script>
							|| Crafted with <i class="mdi mdi-heart text-danger"></i> by CSSD


						</div>

						<div class="col-sm-6">

							<div class="text-sm-right d-none d-sm-block">

								Halaman dirender dalam <strong>{elapsed_time}</strong> detik.

							</div>

						</div>

					</div>

				</div>

			</footer>

		</div>

		<!-- end main content-->



	</div>

	<!-- END layout-wrapper -->



	<!-- Right bar overlay-->

	<!-- JAVASCRIPT -->
	<script>
		keluar = () => {
			Swal.fire({
				icon: 'question',
				title: 'Apakah anda yakin akan keluar?',
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-dark",
				},
				showCancelButton: true,
				confirmButtonText: `Ya, keluar`,
				cancelButtonText: `Batal`,
			}).then(async (result) => {
				if (result.isConfirmed) {
					window.location = `${base_url}auth/logout`;
				}
			})
		}
	</script>
	<script src="<?= base_url(); ?>public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/metismenu/metisMenu.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/libs/simplebar/simplebar.min.js"></script>

	<script src="<?= base_url(); ?>public/assets/libs/node-waves/waves.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/js/script/global_script.js?ut=<?= date('his'); ?>"></script>
	<script src="<?= base_url(); ?>public/assets/js/app.js"></script>
</body>

</html>