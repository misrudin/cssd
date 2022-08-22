let tabel
	let formAdd;
	let formEdit;
	let modalAdd;
	let modalEdit;

	formAdd = document.querySelector("#formAdd");
	formEdit = document.querySelector("#formEdit");
	modalAdd = document.querySelector("#modalAdd");
	modalEdit = document.querySelector("#modalEdit");

	$(function() {
		tabel = $("#datatable").DataTable(config_tb)
	})

	formAdd.addEventListener("submit", (e) => {
		e.preventDefault();
		const formData = new FormData(e.currentTarget);
		simpan_data(formData);
	})

	formEdit.addEventListener("submit", (e) => {
		e.preventDefault();
		const formData = new FormData(e.currentTarget);
		update_data(formData);
	})

	tambah = () => {
		formAdd.reset();
		modalAdd.querySelector(".modal-title").innerHTML = 'Tambah Perawat';
		$("#modalAdd").modal('show');
	}

	simpan_data = async (formData) => {
		let url = `${base_url}perawat/cek_simpan`;
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
		} else {
			Swal.fire({
				icon: "error",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500
			});

		}
	};

	update_data = async (formData) => {
		let url = `${base_url}perawat/simpan_data`;
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
			$("#modalEdit").modal('hide');
		} else {
			Swal.fire({
				icon: "error",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500
			});

		}
	};

	edit_data = async (id_perawat) => {
		let url = `${base_url}perawat/get_perawat`;
		const dataPost = new FormData();
		dataPost.append(
			"where", JSON.stringify({
				id_perawat: id_perawat
			})
		)
		const response = await request_xhr(url, "POST", dataPost);
		console.log(response.pesan);
		if (response.status) {
			formEdit.reset();
			modalEdit.querySelector(".modal-title").innerHTML = "Edit Data Perawat";
			formEdit.querySelector("#id_perawat").value = response.data.id_perawat;
			formEdit.querySelector("#nik").value = response.data.nik;
			formEdit.querySelector("#nama_perawat").value = response.data.nama_perawat;
			formEdit.querySelector("#tempat_lahir").value = response.data.tempat_lahir;
			formEdit.querySelector("#tgl_lahir").value = response.data.tgl_lahir;
			formEdit.querySelector("#alamat").value = response.data.alamat;
			formEdit.querySelector("#jk").value = response.data.jk;
			formEdit.querySelector("#umur").value = response.data.umur;
			$("#modalEdit").modal("show");
		} else {
			Swal.fire({
				icon: "error",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500,
			});
		}
	};

	hapus_data = (id_perawat) => {
		let url = `${base_url}perawat/hapus_data/${id_perawat}`;
		Swal.fire({
			icon: 'question',
			title: 'Apakah anda akan menghapus data ini?',
			customClass: {
				confirmButton: "btn btn-success",
				cancelButton: "btn btn-dark",
			},
			showCancelButton: true,
			confirmButtonText: `Ya, hapus`,
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
					tabel.ajax.reload(null, false);
				} else {
					Swal.fire({
						icon: "warning",
						title: `${response.pesan}`,
						showConfirmButton: false,
						timer: 3500,
					});
					tabel.ajax.reload(null, false);
				}
			}
		})

	}

	config_tb = {
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
			url: `${base_url}perawat/get_dt_perawat`,
			type: "POST"
		},
		language: {
			url: `${base_url}public/assets/lang.json`

		},
		columns: [{
				data: "no"
			},
			{
				data: "nik"
			},
			{
				data: "nama_perawat"
			},
			{
				data: "tempat_lahir"
			},
			{
				data: "alamat"
			},
			{
				data: "jk"
			},
			{
				data: "umur"
			},
			{
				data: "aksi"
			},
		],
	}
