<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary">
				<div class="d-flex justify-content-between">
					<h5 class="text-white">List Ruangan </h5>
					<button onclick="tambah()" class="btn btn-sm btn-light">Tambah</button>
				</div>
			</div>
			<div class="card-body border border-primary">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" id="datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Ruangan</th>
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
			<form id="formAdd">
				<div class="modal-body">
					<input type="hidden" class="form-control" name="id_ruangan" id="id_ruangan" aria-describedby="id_ruangan">
					<div class="form-group">
						<label for="nama_ruangan">Nama Ruangan</label>
						<input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" aria-describedby="nama_ruangan">
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
<script defer src="<?= base_url(); ?>public/assets/js/script/ruangan.js?ut=<?= date('his'); ?>"></script>