<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<form id="cariData">

					<div class="col">
						<label for="">Cari Data:</label>
						<input type="text" class="form-control" name="pencarian" id="pencarian">
					</div>
					<div class="col mt-2">
						<button type="button" id="reset" onclick="reset_data()" class="btn btn-secondary btn-sm">Reset</button>
					</div>
				</form>

			</div>
		</div>
		<div class="card">
			<div class="card-header bg-primary">
				<div class="d-flex justify-content-between">

					<h5 class="text-white">LIST ALAT CSSD</h5>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button onclick="location.href='<?= base_url('alat/print_alat'); ?>'" class="btn btn-sm btn-light">Print QR Code</button>
						<button onclick="tambah()" class="btn btn-sm btn-light ">Tambah Alat</button>
					</div>

				</div>
			</div>
			<div class="card-body border border-primary">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive compact	" id="datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Alat</th>
								<th>Total Stok</th>
								<th>Stok Tersedia</th>
								<th>QR Code</th>
								<th>Aksi</th>
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
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalAddLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="formAdd" action="<?= base_url('alat/simpan_data'); ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<input type="hidden" class="form-control" name="id_barang" id="id_barang" aria-describedby="id_barang">
					<div class="form-group">
						<label for="nama_barang">Nama Alat</label>
						<input type="text" class="form-control" name="nama_barang" id="nama_barang" aria-describedby="nama_barang" required>
						<input type="hidden" class="form-control" name="satuan" id="satuan" aria-describedby="satuan" value="Set" required>
					</div>
					<!-- <div class="form-group">
						<label for="nama_barang">Total Stok</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<button class="btn btn-danger btn-min" type="button">-</button>
							</div>
							<input type="text" class="form-control" name="stok" id="stok" value="0" min="0" max="999" readonly required>
							<div class="input-group-append">
								<button class="btn btn-danger btn-plus" type="button">+</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="nama_barang">Satuan</label>
						<input type="text" class="form-control" name="satuan" id="satuan" value="Set" readonly required>

					</div> -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
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
			<form id="formDetail" action="<?= base_url('alat/simpan_data'); ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<input type="text" class="form-control" name="id_barang" id="detail_id_barang" aria-describedby="id_barang">
					<div class="form-group">
						<label for="nama_barang">Nama Alat</label>
						<input type="text" class="form-control" name="nama_barang" id="detail_nama_barang" aria-describedby="nama_barang" required>
					</div>
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
					<div class="table-responsive">
						<table class="table table-striped table-bordered dt-responsive compact" id="datatable_detail" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<tr>
									<th>Nama Alat</th>
									<th>Total Stok</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
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


<script defer src="<?= base_url(); ?>public/assets/js/script/alat.js?ut=<?= date('his'); ?>"></script>