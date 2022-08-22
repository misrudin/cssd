<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header bg-primary">
				<div class="d-flex justify-content-between">

					<h5 class="text-white">DETAIL ALAT CSSD</h5>
					<a href="<?= base_url('alat'); ?>" class="btn btn-sm btn-light">Kembali</a>
				</div>
			</div>
			<div class="card-body border border-primary">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive compact " id="datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>Nama Alat</th>
								<th>Total Stok</th>
								<th>Stok Tersedia</th>
								<th>QR Code</th>
								<th>Aksi</th>
							</tr>
						</thead>

						<tbody>
							<?php $no = 1;
							?>
							<tr>

								<td>
									<?= $alat->nama_barang; ?>
								</td>
								<td>
									<?= $alat->stok_total; ?>
								</td>
								<td>
									<?= $alat->stok_tersedia; ?>
								</td>
								<td>
									<img src="<?= site_url('image_qr/') . $alat->qr_code; ?>" width="75px">
								</td>
								<td>
									<a onclick="tambah_qty(<?= $alat->id_barang; ?>)" class="btn btn-sm btn-primary" href="#"><i class="fas fa-pencil-alt"></i> Tambah Qty</a> <br>
									<?php if ($alat->stok_total != 0) { ?>
										<a onclick="kurangi_qty(<?= $alat->id_barang; ?>)" class="btn btn-sm btn-danger my-2" href="#"><i class="fas fa-pencil-alt"></i> Kurangi Qty</a>
									<?php } ?>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="card my-2">
			<div class="card-header bg-danger ">
				<h5 class="text-white">RIWAYAT PERUBAHAN DATA</h5>
			</div>
			<div class="card-body border border-danger">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive compact " id="datatable_riwayat" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Barang</th>
								<th>Qty</th>
								<th>Jenis Proses</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>




</div>
<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalDetailLabel">Modal Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="formDetail" action="<?= base_url('alat/simpan_add_stock'); ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<input type="hidden" class="form-control" name="jenis_proses" id="jenis_proses" aria-describedby="jenis_proses">
					<input type="hidden" class="form-control" name="id_barang" id="id_barang" aria-describedby="id_barang">
					<div class="form-group">
						<label for="nama_barang">Nama Alat</label>
						<input type="text" class="form-control" name="nama_barang" id="nama_barang" aria-describedby="nama_barang" required readonly>
					</div>
					<div class="form-group">
						<label for="nama_barang">Jumlah</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<button class="btn btn-danger btn-min" type="button">-</button>
							</div>
							<input type="text" class="form-control" name="stok_total" id="stok_total" value="1" min="0" max="999" readonly required>
							<div class="input-group-append">
								<button class="btn btn-danger btn-plus" type="button">+</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	let id_barang = '<?= $id_barang; ?>';
	window.addEventListener("DOMContentLoaded", () => {

		tabel = $("#datatable_riwayat").DataTable({
			dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [{
					extend: 'pageLength',
					text: "Tampilkan",
					className: 'btn-sm btn-primary',
				},
				{

					text: "Reload",
					className: 'btn-sm btn-success',
					action: function() {
						tabel.ajax.reload(null, false);
						toastr.success("Berhasil memuat ulang data.", "Informasi", {
							showMethod: "slideDown",
							hideMethod: "slideUp",
							timeOut: 1500,
						});
					}
				},

			],
			processing: true,
			serverSide: true,
			responsive: true,
			ajax: {
				url: `${base_url}alat/get_dt_log/${id_barang}`,
				type: "POST"
			},
			language: {
				url: `${base_url}public/assets/lang.json`

			},
			columns: [{
					data: "no",
					render: (data, type, row, meta) => {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					data: "nama_barang"
				},
				{
					data: "qty"
				},
				{
					data: "jenis_proses"
				}
			]

		});
	})

	tambah_qty = async (id_barang) => {
		let url = `${base_url}alat/get_alat`;
		const dataPost = new FormData();
		dataPost.append(
			"where", JSON.stringify({
				id_barang: id_barang
			})
		)
		const response = await request_xhr(url, "POST", dataPost);
		console.log(response.pesan);
		if (response.status) {
			formDetail.reset();
			modalDetail.querySelector(".modal-title").innerHTML = "Tambah Qty Alat";
			formDetail.querySelector("#jenis_proses").value = 'tambah';
			formDetail.querySelector("#id_barang").value = response.data.id_barang;
			formDetail.querySelector("#nama_barang").value = response.data.nama_barang;
			$("#modalDetail").modal("show");
		} else {
			Swal.fire({
				icon: "error",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500,
			});
		}
	};
	kurangi_qty = async (id_barang) => {
		let url = `${base_url}alat/get_alat`;
		const dataPost = new FormData();
		dataPost.append(
			"where", JSON.stringify({
				id_barang: id_barang
			})
		)
		const response = await request_xhr(url, "POST", dataPost);
		console.log(response.pesan);
		if (response.status) {
			formDetail.reset();
			modalDetail.querySelector(".modal-title").innerHTML = "Kurangi Qty Alat";
			formDetail.querySelector("#jenis_proses").value = 'kurangi';
			formDetail.querySelector("#id_barang").value = response.data.id_barang;
			formDetail.querySelector("#nama_barang").value = response.data.nama_barang;
			$("#modalDetail").modal("show");
		} else {
			Swal.fire({
				icon: "error",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500,
			});
		}
	};

	simpan_data = async (formData) => {
		let url = `${base_url}alat/simpan_data`;
		const response = await request_xhr(url, "POST", formData);
		console.log(response.pesan);
		if (response.status) {
			Swal.fire({
				icon: "success",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500
			});
			tabel.ajax.reload(null, false);
			$("#modalAdd").modal('hide');
		}
	};
	document.querySelector(".btn-plus").addEventListener("click", () => {
		document.querySelector('#stok_total').value = parseInt(document.querySelector('#stok_total').value) + 1;
	})
	document.querySelector(".btn-min").addEventListener("click", () => {
		if (document.querySelector('#stok_total').value > 2) {
			document.querySelector('#stok_total').value = parseInt(document.querySelector('#stok_total').value) - 1;
		} else {
			document.querySelector('#stok_total').value = 1;
		}
	})
</script>
