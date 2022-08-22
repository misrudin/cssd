<div class="card my-1">
	<div class="card-header  bg-primary">
		<div class="d-flex justify-content-between">
			<h6 class=" text-white">DETAIL PEMINJAMAN</h6>
			<button type="button" class="btn btn-sm btn-light" onclick="location.href='<?= base_url('peminjaman') ?>'">Kembali</button>
		</div>
	</div>
	<div class="card-body border border-primary">
		<div class="row">
			<div class="col-md-4">Nama Ruangan</div>
			<div class="col-md-8"><?= $peminjaman->nama_ruangan ?></div>
		</div>

		<div class="row">
			<div class="col-md-4">Tanggal Pinjam</div>
			<div class="col-md-8"><?= (!empty($peminjaman->tgl_pinjam)) ? tgl_indo($peminjaman->tgl_pinjam) : "-" ?></div>
		</div>
		<div class="row">
			<div class="col-md-4">Tanggal Kembali</div>
			<div class="col-md-8"><?= (!empty($peminjaman->tgl_kembali_semua)) ? tgl_indo($peminjaman->tgl_kembali_semua) : "-" ?></div>
		</div>
	</div>
</div>

<?php
$cek_barang = $this->m_global->get_data('peminjaman_detail', ['no_invoice' => $no_invoice])->row();
if ($cek_barang) {
	if ($cek_barang->status == 1 || $cek_barang->status == 2) { ?>

	<?php }
	if ($cek_barang->status == 0) { ?>
		<div class="card mt-4">
			<div class="card-body">
				<label for="jenis_input">Form untuk memilih jenis input:</label>
				<select name="jenis_input" id="jenis_input" class="form-control">
					<option value="">- Pilih -</option>
					<option value="1">- Scan QR -</option>
					<option value="2">- Pilih Barang -</option>
				</select>
			</div>
		</div>

		<script type="text/javascript" src="<?= base_url("public/assets/webcodecam/") ?>js/qrcodelib.js"></script>
		<script type="text/javascript" src="<?= base_url("public/assets/webcodecam/") ?>js/webcodecamjquery.js"></script>
		<div class="card mt-4 card-qr">
			<div class="card-body">
				<h6 class="text-center mt-3">Arahkan kode QR ke kamera</h6>
				<div class="d-flex row justify-content-center">
					<div class="row">

						<div class="col-md-4 text-center">
							<canvas style="border:1px solid #000000; position: relative;width: 100%;"></canvas>
						</div>

						<div class="col-md-6">
							<select class="form-control" id="kamera"></select>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="row my-2">

			<div class="col">
				<div class="card card-manual">
					<div class="card-body text-center">
						Jika Scan QR tidak berfungsi
						<div class="input-group my-3">
							<select name="id_barang_temp" id="id_barang_temp" class="form-control" required>
								<option value="">- Pilih Alat -</option>
								<?php foreach ($barang as $v) { ?>
									<option value="<?= $v->id_barang; ?>"><?= $v->nama_barang; ?></option>
								<?php } ?>
							</select>
							<!-- <input type="number" class="form-control" id="id_barang_temp" placeholder="ID Barang"> -->
							<div class="input-group-append">
								<button class="btn btn-success" type="button" onclick="add_barang_temp()">add</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var arg = {
				resultFunction: function(result) {
					var id_barang_temp = result.code
					var no_invoice = '<?= $no_invoice ?>';
					location.href = "<?= base_url('peminjaman/add_detail_temp/'); ?>" + no_invoice + '/' + id_barang_temp
				}
			};

			var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
			// decoder.buildSelectMenu("kamera", index);
			decoder.buildSelectMenu("#kamera", "environment|back").init();
			decoder.play();
			$('select').on('change', function() {
				decoder.stop().play();
			});

			// jquery extend function
			//CONFIGURASI CAMERA
			decoder.options.zoom = 0;
			decoder.options.flipHorizontal = true;
		</script>
	<?php
	}
} else { ?>
	<div class="card mt-4">
		<div class="card-body">
			<label for="jenis_input_baru">Form untuk memilih jenis input:</label>
			<select name="jenis_input" id="jenis_input_baru" class="form-control">
				<option value="">- Pilih -</option>
				<option value="1">- Scan QR -</option>
				<option value="2">- Pilih Barang -</option>
			</select>
		</div>
	</div>

	<script type="text/javascript" src="<?= base_url("public/assets/webcodecam/") ?>js/qrcodelib.js"></script>
	<script type="text/javascript" src="<?= base_url("public/assets/webcodecam/") ?>js/webcodecamjquery.js"></script>
	<div class="card mt-4 card-qr-baru">
		<div class="card-body">
			<h6 class="text-center mt-3">Arahkan kode QR ke kamera</h6>
			<div class="d-flex row justify-content-center">


				<div class="col-md-4 text-center">
					<canvas style="border:1px solid #000000;position: relative;width: 100%;"></canvas>
				</div>

				<div class="col-md-6">
					<select class="form-control mt-2 " id="kamera"></select>
				</div>
			</div>
		</div>

	</div>
	<div class="row my-2">
		<div class="col">
			<div class="card card-manual-baru">
				<div class="card-body text-center">
					Jika Scan QR tidak berfungsi
					<div class="input-group mb-3">
						<select name="id_barang_temp" id="id_barang_temp" class="form-control" required>
							<option value="">- Pilih Alat -</option>
							<?php foreach ($barang as $v) { ?>
								<option value="<?= $v->id_barang; ?>"><?= $v->nama_barang; ?></option>
							<?php } ?>
						</select>
						<!-- <input type="number" class="form-control" id="id_barang_temp" placeholder="ID Barang"> -->
						<div class="input-group-append">
							<button class="btn btn-success" type="button" onclick="add_barang_temp()">add</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var arg = {
			resultFunction: function(result) {
				var id_barang_temp = result.code
				var no_invoice = '<?= $no_invoice ?>';
				location.href = "<?= base_url('peminjaman/add_detail_temp/'); ?>" + no_invoice + '/' + id_barang_temp
			}
		};

		var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
		// decoder.buildSelectMenu("kamera", index);
		decoder.buildSelectMenu("#kamera", "environment|back").init();
		decoder.play();
		$('select').on('change', function() {
			decoder.stop().play();
		});

		// jquery extend function
		//CONFIGURASI CAMERA
		decoder.options.zoom = 0;
		decoder.options.flipHorizontal = true;
	</script>
<?php } ?>
<div class="card my-4">
	<div class="card-header bg-warning">
		<b>DAFTAR ALAT YANG DIPINJAM</b>
	</div>
	<div class="card-body border border-warning">
		
		<table class="table table-bordered compact my-1" style="border-spacing: 0; width: 100%;" id="add_detail">
			<thead>
				<th width="3%">Nama Barang</th>
				<th width="87%">Qty</th>
				<th width="">Aksi</th>
			</thead>
			<tbody>
				<?php
				if ($id_barang != 0) {
					$detail_barang = $this->m_global->get_data('barang', ['id_barang' => $id_barang])->row();

				?>

					<tr>
						<td><?= $detail_barang->nama_barang; ?></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend">
									<button class="btn btn-sm btn-danger btn-min" type="button">-</button>
								</div>
								<input type="text" class="form-control" size="1" maxlength="2" name="stok" id="stok" value="1" min="0" max="<?= $detail_barang->stok_tersedia; ?>" readonly required>
								<div class="input-group-append">
									<button class="btn btn-sm btn-danger btn-plus" type="button">+</button>
								</div>
							</div>
						</td>
						<td><button class="btn btn-success btn-sm" onclick="add_peminjaman_detail('<?= $detail_barang->id_barang; ?>')"><i class="fas fa-check"></i></button></td>
					</tr>
					<?php }
				$peminjaman_detail = $this->m_global->get_data('peminjaman_detail a', ['a.no_invoice' => $no_invoice], ['table' => 'barang b', 'cond' => 'a.id_barang=b.id_barang', 'type' => 'left']);
				if ($peminjaman_detail) {
					foreach ($peminjaman_detail->result() as $key => $value) { ?>

						<tr>
							<td><?= $value->nama_barang; ?></td>
							<td><?= $value->qty; ?></td>
							<?php if ($value->status == 0) { ?>
								<td><button class="btn btn-sm btn-danger" type="button" onclick="hapus_barang('<?= $no_invoice; ?>')"><i class="fas fa-trash"></i></button></td>
							<?php } else if ($value->status == 1) { ?>
								<td><button class="btn btn-sm btn-danger" type="button" onclick="kembalikan(`<?= $no_invoice; ?>#<?= $value->id_barang; ?>`)">Kembalikan</button></td>
							<?php } else if ($value->status == 2) { ?>
								<td><span class="badge badge-primary">Sudah dikembalikan semua</span></td>
							<?php } ?>
						</tr>


				<?php }
				} ?>
			</tbody>
		</table>
		
		<?php if ($peminjaman_detail) {
			$data = $peminjaman_detail->row();
			if ($data) {
				if ($data->status == 0) {
		?>


					<button type="button" onclick="proses_peminjaman('<?= $no_invoice; ?>')" class="btn btn-block btn-lg btn-primary my-1">Proses Pinjam</button>
			<?php
				}
			}
		} else { ?>
		<?php } ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('peminjaman/proses_pengembalian'); ?>" method="POST">
				<div class="modal-body">
					<input type="hidden" class="form-control" name="no_invoice" id="no_invoice" readonly required>
					<input type="hidden" class="form-control" name="id_barang" id="id_barang" min="0" max="" readonly required>
					<div class="input-group">
						<div class="input-group-prepend">
							<button class="btn btn-sm btn-danger btn-min-update" type="button">-</button>
						</div>
						<input type="text" class="form-control" name="stok_update" id="stok_update" min="0" max="" readonly required>
						<div class="input-group-append">
							<button class="btn btn-sm btn-danger btn-plus-update" type="button">+</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Kembalikan</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	window.addEventListener("DOMContentLoaded", () => {
		<?php if ($cek_barang) {
			if ($cek_barang->status == 1 || $cek_barang->status == 2) {
			} else { ?>
				document.querySelector(".card-qr").style.display = 'none';
				document.querySelector(".card-manual").style.display = 'none';
			<?php }
		} else { ?>
			document.querySelector(".card-qr-baru").style.display = 'none';
			document.querySelector(".card-manual-baru").style.display = 'none';
		<?php } ?>
		$("#add_detail").DataTable({
			bInfo: false,
			searching: false,
			paginate: false,
			responsive: true
		});
	})

	let kembalikan = async (data_param) => {
		let new_data = data_param.split('#');
		let no_invoice = new_data[0];
		let id_barang = new_data[1];
		let url_get = `${base_url}peminjaman/get_data/${no_invoice}/${id_barang}`
		const response = await request_xhr(url_get);
		if (response.status) {
			document.querySelector("#stok_update").max = response.data.qty
			document.querySelector("#stok_update").value = response.data.qty
			document.querySelector("#no_invoice").value = response.data.no_invoice
			document.querySelector("#id_barang").value = response.data.id_barang
			document.querySelector(".modal-title").innerHTML = 'Kembalikan Barang';

			document.querySelector(".btn-plus-update").addEventListener("click", () => {
				let jml = Number(document.querySelector('#stok_update').value)
				let maks_stok = document.getElementById("stok_update").max;
				if (jml >= maks_stok) {
					document.querySelector('#stok_update').value = maks_stok
				} else {
					document.querySelector('#stok_update').value = parseInt(document.querySelector('#stok_update').value) + 1;
				}
			})
			document.querySelector(".btn-min-update").addEventListener("click", () => {
				if (document.querySelector('#stok_update').value > 2) {
					document.querySelector('#stok_update').value = parseInt(document.querySelector('#stok_update').value) - 1;
				} else {
					document.querySelector('#stok_update').value = 1;
				}
			})

			$("#exampleModal").modal('show')
		}
	}

	let hapus_barang = (no_invoice) => {
		let url = `${base_url}peminjaman/hapus_barang_peminjaman/${no_invoice}`;
		Swal.fire({
			icon: "question",
			title: "Apakah anda yakin akan menghapus data ini?",
			customClass: {
				confirmButton: "btn btn-success",
				cancelButton: "btn btn-dark",

			},
			showCancelButton: true,
			confirmButtonText: "Ya, Hapus",
			cancelButtonText: "Batal"
		}).then(
			async (result) => {
				if (result.isConfirmed) {
					const response = await request_xhr(url);
					console.log(response.pesan);
					if (response.status) {
						Swal.fire({
							icon: "success",
							title: `${response.pesan}`,
							showConfirmButton: false,
							timer: 1500,
						});
						location.href = `${base_url}peminjaman/add_detail/${no_invoice}`;
					} else {
						Swal.fire({
							icon: "warning",
							title: `${response.pesan}`,
							showConfirmButton: false,
							timer: 3500,
						});
						location.href = `${base_url}peminjaman/add_detail/${no_invoice}`;
					}
				}
			}
		)
	}

	function add_barang_temp() {
		var id_barang_temp = document.getElementById('id_barang_temp').value
		var no_invoice = '<?= $no_invoice ?>';
		location.href = "<?= base_url('peminjaman/add_detail_temp/'); ?>" + no_invoice + '/' + id_barang_temp
	}

	function add_peminjaman_detail(id_barang) {
		var id_barang = id_barang
		var qty = document.getElementById('stok').value
		var no_invoice = '<?= $no_invoice ?>';
		location.href = "<?= base_url('peminjaman/add_peminjaman_detail/'); ?>" + no_invoice + '/' + id_barang + '/' + qty
	}

	proses_peminjaman = (no_invoice) => {
		let url = `${base_url}peminjaman/proses_peminjaman/${no_invoice}`
		Swal.fire({
			icon: 'question',
			title: 'Apakah anda akan meminjam alat ini?',
			customClass: {
				confirmButton: "btn btn-success",
				cancelButton: "btn btn-dark",
			},
			showCancelButton: true,
			confirmButtonText: `Ya, pinjam`,
			cancelButtonText: `Batal`,
		}).then(async (result) => {
			if (result.isConfirmed) {
				const response = await request_xhr(url);
				console.log(response.pesan);
				if (response.status) {
					Swal.fire({
						icon: "success",
						title: `${response.pesan}`,
						showConfirmButton: false,
						timer: 1500,
					});
					location.href = `${base_url}peminjaman`;
				} else {
					Swal.fire({
						icon: "warning",
						title: `${response.pesan}`,
						showConfirmButton: false,
						timer: 3500,
					});
					location.href = `${base_url}peminjaman`;
				}
			}
		})
	}
	<?php if ($cek_barang) {
		if ($cek_barang->status == 1 || $cek_barang->status == 2) {
		} else { ?>
			document.querySelector("#jenis_input").addEventListener("change", () => {
				if (document.querySelector("#jenis_input").value == 1) {
					document.querySelector(".card-qr").style.display = 'block';
					document.querySelector(".card-manual").style.display = 'none';
				} else if (document.querySelector("#jenis_input").value == 2) {
					document.querySelector(".card-qr").style.display = 'none';
					document.querySelector(".card-manual").style.display = 'block';
				} else {
					document.querySelector(".card-qr").style.display = 'none';
					document.querySelector(".card-manual").style.display = 'none';
				}
			})
		<?php }
	} else { ?>
		document.querySelector("#jenis_input_baru").addEventListener("change", () => {
			if (document.querySelector("#jenis_input_baru").value == 1) {
				document.querySelector(".card-qr-baru").style.display = 'block';
				document.querySelector(".card-manual-baru").style.display = 'none';
			} else if (document.querySelector("#jenis_input_baru").value == 2) {
				document.querySelector(".card-qr-baru").style.display = 'none';
				document.querySelector(".card-manual-baru").style.display = 'block';
			} else {
				document.querySelector(".card-qr-baru").style.display = 'none';
				document.querySelector(".card-manual-baru").style.display = 'none';
			}
		})
	<?php } ?>
	<?php if ($id_barang != 0) { ?>
		document.querySelector(".btn-plus").addEventListener("click", () => {
			let jml = Number(document.querySelector('#stok').value)
			let maks_stok = document.getElementById("stok").max;
			if (jml >= maks_stok) {
				document.querySelector('#stok').value = maks_stok
			} else {
				document.querySelector('#stok').value = parseInt(document.querySelector('#stok').value) + 1;
			}
		})
		document.querySelector(".btn-min").addEventListener("click", () => {
			if (document.querySelector('#stok').value > 2) {
				document.querySelector('#stok').value = parseInt(document.querySelector('#stok').value) - 1;
			} else {
				document.querySelector('#stok').value = 1;
			}
		})
	<?php } ?>
</script>