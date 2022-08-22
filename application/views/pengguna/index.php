<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header bg-primary">
				<div class="d-flex justify-content-end">
					<button onclick="tambah()" class="btn btn-sm btn-light">Tambah</button>
				</div>
			</div>
			<div class="card-body border border-primary">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive compact" id="datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>No</th>
								<th>NIK</th>
								<th>Nama User</th>
								<th>Role</th>
								<th>Status</th>
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
<!-- Modal Add -->
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
					<input type="hidden" class="form-control" name="id_akun" id="id_akun" aria-describedby="id_akun">
					<div class="form-group">
						<label for="nik">Perawat</label>
						<select name="nik" id="nik" class="form-control">
							<?php foreach ($perawat as $v) { ?>
								<option value="<?= $v->nik; ?>"><?= $v->nama_perawat; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_user">Nama User</label>
						<input type="text" class="form-control" name="nama_user" id="nama_user" aria-describedby="nama_user" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" aria-describedby="password" required>
					</div>
					<div class="form-group">
						<label for="password_conf">Password Konfirmasi</label>
						<input type="password" class="form-control" name="password_conf" id="password_conf" aria-describedby="password_conf" required>
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
<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalEditLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="formEdit">
				<div class="modal-body">
					<input type="hidden" class="form-control" name="id_akun" id="id_akun" aria-describedby="id_akun">
					<div class="form-group">
						<label for="nik">Perawat</label>
						<select name="nik" id="nik" class="form-control">
							<?php foreach ($perawat as $v) { ?>
								<option value="<?= $v->nik; ?>"><?= $v->nama_perawat; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_user">Nama User</label>
						<input type="text" class="form-control" name="nama_user" id="nama_user" aria-describedby="nama_user" required>
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
<script defer src="<?= base_url('public/assets/js/script/akun.js?ut=' . date('his')); ?>"></script>
