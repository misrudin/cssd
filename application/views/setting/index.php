<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header bg-primary">
				<div class="d-flex justify-content-end">
					<button onclick="tambah()" class="btn btn-sm btn-light">Tambah</button>
				</div>
			</div>
			<div class="card-body border border-primary">
				<table class="table table-striped table-bordered dt-responsive nowrap" id="datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Perangkat</th>
							<th>Nama Pasien</th>
							<th>Nama Perawat</th>
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
					<input type="hidden" class="form-control" name="id_alat" id="id_alat" aria-describedby="id_alat">
					<div class="form-group">
						<label for="id_perangkat">ID Perangkat</label>
						<input type="text" class="form-control" name="id_perangkat" id="id_perangkat" aria-describedby="id_perangkat">
					</div>
					<div class="form-group">
						<label for="nama_pasien">Nama Pasien</label>
						<select name="id_pasien" id="id_pasien" class="form-control">
							<?php foreach ($pasien as $v) { ?>
								<option value="<?= $v->id_pasien; ?>"><?= $v->nama_pasien; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_perawat">Nama Perawat</label>
						<select name="id_perawat" id="id_perawat" class="form-control">
							<?php foreach ($perawat as $v) { ?>
								<option value="<?= $v->id_perawat; ?>"><?= $v->nama_perawat; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_ruangan">Nama Ruangan</label>
						<select name="id_ruangan" id="id_ruangan" class="form-control">
							<?php foreach ($ruangan as $v) { ?>
								<option value="<?= $v->id_ruangan; ?>"><?= $v->nama_ruangan; ?></option>
							<?php } ?>
						</select>
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
<script defer src="<?= base_url(); ?>public/assets/js/script/setting_alat.js"></script>
