<a href="<?= base_url('peminjaman/add') ?>" class="btn btn-sm btn-primary my-2">Pinjam</a>
<div class="card">
	<div class="card-header bg-primary text-white text-uppercase">
		List Alat Yang Sedang Dipinjam
	</div>
	<div class="card-body border border-primary ">
		<table class="table table-bordered my-1 dt-responsive nowrap" id="datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<th>No</th>
				<th>Kode Pinjam</th>
				<th>Ruangan</th>
				<th>Status</th>
				<th>Tgl Pinjam</th>
				<th>Tgl Kembali</th>
				<th>Aksi</th>
			</thead>
			<tbody>

			</tbody>
		</table>

	</div>
</div>
<div class="card">
	<div class="card-header bg-danger text-white text-uppercase">
		Riwayat Peminjaman
	</div>
	<div class="card-body border border-danger ">
		<table class="table table-bordered my-1 dt-responsive nowrap" id="datatable_riwayat" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<th>No</th>
				<th>Kode Pinjam</th>
				<th>Ruangan</th>
				<th>Status</th>
				<th>Tgl Pinjam</th>
				<th>Tgl Kembali</th>
				<th>Aksi</th>
			</thead>
			<tbody>

			</tbody>
		</table>

	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalDetailLabel">Modal Pengembalian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="formDetail" action="<?= base_url('alat/simpan_data'); ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="nama_barang">Nama Alat</label>
								<input type="text" class="form-control" name="nama_barang" id="detail_nama_barang" aria-describedby="nama_barang" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="nama_barang">Jumlah Stok</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<button class="btn btn-danger btn-min" type="button">-</button>
									</div>
									<input type="text" class="form-control" name="total_stok" id="detail_total_stok" value="1" min="0" max="999" readonly required>
									<div class="input-group-append">
										<button class="btn btn-danger btn-plus" type="button">+</button>
									</div>
								</div>
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
	window.addEventListener("DOMContentLoaded", () => {
		tabel = $("#datatable").DataTable({
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
			responsive: true,
			serverSide: true,
			ajax: {
				url: `${base_url}peminjaman/get_dt_peminjaman/list`,
				type: "POST"
			},
			language: {
				url: `${base_url}public/assets/lang.json`

			},
			columns: [{
					data: "no",
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					data: "no_invoice"
				},
				{
					data: "nama_ruangan"
				},
				{
					data: "status"
				},
				{
					data: "tgl_pinjam"
				},
				{
					data: "tgl_kembali"
				},
				{
					data: "aksi"
				},
			],
		})

		tabel_riwayat = $("#datatable_riwayat").DataTable({
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
			responsive: true,
			serverSide: true,
			ajax: {
				url: `${base_url}peminjaman/get_dt_peminjaman/riwayat`,
				type: "POST"
			},
			language: {
				url: `${base_url}public/assets/lang.json`

			},
			columns: [{
					data: "no",
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					data: "no_invoice"
				},
				{
					data: "nama_ruangan"
				},
				{
					data: "status"
				},
				{
					data: "tgl_pinjam"
				},
				{
					data: "tgl_kembali"
				},
				{
					data: "aksi"
				},
			],
		});

		pengembalian = (id_peminjaman) => {
			location.href = `${base_url}peminjaman/index_pengembalian/${id_peminjaman}`
			// let url = `${base_url}peminjaman/proses_pengembalian/${id_peminjaman}`
			// Swal.fire({
			// 	icon: 'question',
			// 	title: 'Apakah anda akan mengembalikan alat ini?',
			// 	customClass: {
			// 		confirmButton: "btn btn-success",
			// 		cancelButton: "btn btn-dark",
			// 	},
			// 	showCancelButton: true,
			// 	confirmButtonText: `Ya, kembalikan`,
			// 	cancelButtonText: `Batal`,
			// }).then(async (result) => {
			// 	if (result.isConfirmed) {
			// 		const response = await request_xhr(url);
			// 		console.log(response.pesan);
			// 		if (response.status) {
			// 			Swal.fire({
			// 				icon: "success",
			// 				title: `${response.pesan}`,
			// 				showConfirmButton: false,
			// 				timer: 1500,
			// 			});
			// 			tabel.ajax.reload(null, false);
			// 		} else {
			// 			Swal.fire({
			// 				icon: "warning",
			// 				title: `${response.pesan}`,
			// 				showConfirmButton: false,
			// 				timer: 3500,
			// 			});
			// 			tabel.ajax.reload(null, false);
			// 		}
			// 	}
			// })
		}
	})
</script>