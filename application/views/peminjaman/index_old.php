<script type="text/javascript" src="<?= base_url("public/assets/webcodecam/") ?>js/qrcodelib.js"></script>
<script type="text/javascript" src="<?= base_url("public/assets/webcodecam/") ?>js/webcodecamjquery.js"></script>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">

				<h6 class="text-center mt-3">Arahkan kode QR ke kamera</h6>
				<div class="d-flex row justify-content-center">

					<div class="col-md-12 text-center">
						<canvas style="border:1px solid #000000;"></canvas>
					</div>

					<div class="col-md-6">
						<select class="form-control mt-2 " id="kamera"></select>
					</div>

				</div>
				<div class=" col-md-6 ">






				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card form-input">
					<div class="card-header bg-primary form-input1">
						<h5 class="text-white ">FORM INPUT PEMINJAMAN</h5>
					</div>
					<div class="card-body border border-primary">
						<form id="formInput">
							<!-- <input type="hidden" class="form-control" name="id_barang" id="id_barang" aria-describedby="id_barang" required> -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="nama_ruangan">Nama Ruangan</label>
										<select name="id_ruangan" id="id_ruangan" class="form-control">
											<option value="">-Pilih Ruangan-</option>
											<?php foreach ($ruangan as $value) { ?>
												<option value="<?= $value->id_ruangan; ?>"><?= $value->nama_ruangan; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="nama_barang">Nama Alat</label>
										<select name="id_barang" id="id_barang" class="form-control">
											<option value="">-Pilih Barang-</option>
											<?php foreach ($barang as $value) { ?>
												<option value="<?= $value->id_barang; ?>#<?= $value->stok_tersedia; ?>"><?= $value->nama_barang; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group">
										<label for="nama_barang">Qty</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<button class="btn btn-danger btn-min" type="button">-</button>
											</div>
											<input type="number" class="form-control" name="qty" id="qty" value="0" readonly required step="1">
											<div class="input-group-append">
												<button class="btn btn-danger btn-plus" type="button">+</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col">

								</div>


							</div>
							<button type="submit" class="btn-save btn-block btn btn-success">Masukkan Ke List</button>
						</form>
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header bg-primary form-input1">
						<h5 class="text-white ">LIST PINJAM ALAT</h5>
					</div>
					<div class="card-body border border-primary">
						<form id="formInput">
							<input type="hidden" class="form-control" name="id_barang" id="id_barang" aria-describedby="id_barang" required>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="id_ruangan">Nama Ruangan</label>
										<input type="text" class="form-control" name="id_ruangan" id="id_ruangan" aria-describedby="id_ruangan" required readonly>
									</div>
									<div class="row">
										<div class="col-md-10">
											<div class="form-group">
												<label for="nama_barang">Nama Alat</label>
												<input type="text" class="form-control" name="nama_barang" id="nama_barang" aria-describedby="nama_barang" required readonly>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="stok_tersedia">Qty</label>
												<input type="text" class="form-control" name="stok_tersedia" id="stok_tersedia" aria-describedby="stok_tersedia" required readonly>
											</div>
										</div>
									</div>

								</div>
								<div class="col">

								</div>


							</div>
							<button type="submit" class="btn-save btn-block btn btn-success">SIMPAN</button>
						</form>
					</div>
				</div>

			</div>
		</div>

	</div>

	<script>
		let formInput = document.querySelector("#formInput");
		document.querySelector('.btn-min').setAttribute("disabled", "disabled");
		document.querySelector('.btn-plus').setAttribute("disabled", "disabled");
		// formInput.style.display = "none";
		// document.querySelector('.btn-save').setAttribute("disabled", 'disabled');

		formInput.addEventListener('submit', (e) => {
			e.preventDefault();
			const formData = new FormData(e.currentTarget);
			simpan_peminjaman(formData);

		})

		simpan_peminjaman = async (formData) => {
			let url = `${base_url}peminjaman/pinjam`;
			const response = await request_xhr(url, "POST", formData);
			console.log(response.pesan);
			if (response.status) {
				location.reload()
				Swal.fire({
					icon: "success",
					title: `${response.pesan}`,
					showConfirmButton: false,
					timer: 1500
				})


			} else {
				Swal.fire({
					icon: "error",
					title: `${response.pesan}`,
					showConfirmButton: false,
					timer: 1500
				});
			}
		}

		var arg = {
			resultFunction: function(result) {
				var redirect = '<?= base_url("peminjaman/simpan") ?>';
				console.log(result)
				// $.redirectPost(redirect, {
				// 	nama_barang: result.code //no_qr
				// });
			}
		};

		var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
		decoder.buildSelectMenu("#kamera");
		decoder.play();
		$('select').on('change', function() {
			decoder.stop().play();
		});

		// jquery extend function
		$.extend({
			redirectPost: function(location, args) {
				var form = '';
				$.each(args, function(key, value) {
					if (value != null) {


						let str = value;
						const myArr = str.split("#");

						document.querySelector("#id_barang").value = myArr[0];
						document.querySelector("#nama_barang").value = myArr[1];

						formInput.style.display = "block";

						document.querySelector(".btn-plus").addEventListener("click", () => {
							if (document.querySelector('#qty').value < myArr[2]) {
								document.querySelector('#qty').value = parseInt(document.querySelector('#qty').value) + 1;
							} else {
								document.querySelector('#qty').value = myArr[2];
							}
							document.querySelector('.btn-save').removeAttribute("disabled", "disabled");
						})
						document.querySelector(".btn-min").addEventListener("click", () => {
							document.querySelector('#qty').value = parseInt(document.querySelector('#qty').value) - 1;
							if (document.querySelector('#qty').value <= 1) {
								document.querySelector('#qty').value = 1;
							}
						})

					} else {

					}
				});
			}
		});

		//CONFIGURASI CAMERA
		decoder.options.zoom = 0;
		decoder.options.flipHorizontal = true;

		document.querySelector("#id_barang").addEventListener("change", () => {

			if (document.querySelector("#id_barang").value != '') {
				document.querySelector('#qty').value = 0;
				document.querySelector('.btn-save').removeAttribute("disabled", "disabled");
				document.querySelector('.btn-min').removeAttribute("disabled", "disabled");
				document.querySelector('.btn-plus').removeAttribute("disabled", "disabled");


				let str = document.querySelector("#id_barang").value;
				const myArr = str.split('#');
				// alert(myArr[1]);

				document.querySelector(".btn-plus").addEventListener("click", () => {
					var jml = Number(document.querySelector('#qty').value);
					console.log(jml)
					if (jml >= myArr[1]) {
						document.querySelector('#qty').value = myArr[1];
					} else {
						document.querySelector('#qty').value = jml + 1;
					}

				})
				document.querySelector(".btn-min").addEventListener("click", () => {
					document.querySelector('#qty').value = Number(document.querySelector('#qty').value) - 1;
					if (document.querySelector('#qty').value <= 1) {
						document.querySelector('#qty').value = 1;
					}
				})
			} else {
				document.querySelector('.btn-save').setAttribute("disabled", "disabled");
				document.querySelector('.btn-min').setAttribute("disabled", "disabled");
				document.querySelector('.btn-plus').setAttribute("disabled", "disabled");
			}
		})
	</script>
	;
