let tabel
	let formAdd;
	let modalAdd;

	formAdd = document.querySelector("#formAdd");
	modalAdd = document.querySelector("#modalAdd");

	$(function() {
		tabel = $("#datatable").DataTable(config_tb)
	})

	formAdd.addEventListener("submit", (e) => {
		e.preventDefault();
		const formData = new FormData(e.currentTarget);
		simpan_data(formData);
	})

	tambah = () => {
		formAdd.reset();
		modalAdd.querySelector(".modal-title").innerHTML = 'Tambah Akun';
		$("#modalAdd").modal('show');
	}

	simpan_data = async (formData) => {
		let url = `${base_url}akun/cek_simpan`;
		const response = await request_xhr(url, "POST", formData);
		console.log(response.pesan);
		if (response.status) {
			Swal.fire({
				icon: "success",
				title: `Berhasil simpan data`,
				text:`${response.pesan}`,
				showConfirmButton: true,
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
	
	update_status = async (id_akun) => {
		let url = `${base_url}akun/update_status/${id_akun}`;
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
	hapus_data = (id_akun) => {
		let url = `${base_url}akun/hapus_data/${id_akun}`;
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
			url: `${base_url}akun/get_dt_akun`,
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
				data: "nama_user"
			},
			{
				data: "role"
			},
			{
				data: "status"
			},
			{
				data: "aksi"
			},
		],
	}
