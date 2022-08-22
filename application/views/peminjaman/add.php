<div class="row">
	<div class="col-md-12">
		<div class="card form-input">
			<div class="card-header bg-primary form-input1">
				<h5 class="text-white ">FORM INPUT PEMINJAMAN</h5>
			</div>
			<div class="card-body border border-primary">
				<form id="formInput" action="<?= base_url('peminjaman/simpan_peminjaman'); ?>" method="POST">
					<!-- <input type="hidden" class="form-control" name="id_barang" id="id_barang" aria-describedby="id_barang" required> -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="nama_ruangan">Kode Peminjaman</label>
								<input type="text" name="no_invoice" id="no_invoice" value="<?= $no_invoice; ?>" class="form-control" readonly>

							</div>
							<div class="form-group">
								<label for="nama_ruangan">Nama Ruangan</label>
								<select name="id_ruangan" id="id_ruangan" class="form-control" required>
									<option value="">-Pilih Ruangan-</option>
									<?php foreach ($ruangan as $value) { ?>
										<option value="<?= $value->id_ruangan; ?>"><?= $value->nama_ruangan; ?></option>
									<?php } ?>
								</select>
							</div>
							<button type="submit" class="btn-save btn-block btn btn-success">Proses Pinjam</button>
				</form>
			</div>
		</div>

	</div>

</div>