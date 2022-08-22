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
								<th>Nama</th>
								<th>Tempat, Tanggal Lahir</th>
								<th>Alamat</th>
								<th>Jenis Kelamin</th>
								<th>Umur</th>
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
					<input type="hidden" class="form-control" name="id_perawat" id="id_perawat" aria-describedby="id_perawat">
					<div class="form-group">
						<label for="nik">NIK</label>
						<input type="text" class="form-control" name="nik" id="nik" aria-describedby="nik" required>
					</div>
					<div class="form-group">
						<label for="nama_perawat">Nama Perawat</label>
						<input type="text" class="form-control" name="nama_perawat" id="nama_perawat" aria-describedby="nama_perawat" required>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="tempat_lahir">Tempat Lahir</label>
								<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" aria-describedby="tempat_lahir" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" aria-describedby="tgl_lahir" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3" required></textarea>
					</div>
					<div class="form-group">
						<label for="nama">Jenis Kelamin</label>
						<select name="jk" id="jk" class="form-control" required>
							<option value="1">Laki-laki</option>
							<option value="2">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="umur">Umur<sup style="color:red;">*)format angka</sup></label>
						<input type="number" class="form-control" name="umur" id="umur" aria-describedby="umur" required>
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
					<input type="hidden" class="form-control" name="id_perawat" id="id_perawat" aria-describedby="id_perawat">
					<div class="form-group">
						<label for="nik">NIK</label>
						<input type="text" class="form-control" name="nik" id="nik" aria-describedby="nik" required>
					</div>
					<div class="form-group">
						<label for="nama_perawat">Nama Perawat</label>
						<input type="text" class="form-control" name="nama_perawat" id="nama_perawat" aria-describedby="nama_perawat" required>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="tempat_lahir">Tempat Lahir</label>
								<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" aria-describedby="tempat_lahir" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" aria-describedby="tgl_lahir" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3" required></textarea>
					</div>
					<div class="form-group">
						<label for="nama">Jenis Kelamin</label>
						<select name="jk" id="jk" class="form-control" required>
							<option value="1">Laki-laki</option>
							<option value="2">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="umur">Umur<sup style="color:red;">*)format angka</sup></label>
						<input type="number" class="form-control" name="umur" id="umur" aria-describedby="umur" required>
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

<script defer src="<?= base_url(); ?>public/assets/js/script/perawat.js?ut=<?= date('his'); ?>"></script>
