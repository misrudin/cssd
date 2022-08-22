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
		modalAdd.querySelector(".modal-title").innerHTML = 'Tambah Ruangan';
		$("#modalAdd").modal('show');
	}

	simpan_data = async (formData) => {
		let url = `${base_url}ruangan/simpan_data`;
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
		}
	};

	edit_data = async (id_ruangan) => {
		let url = `${base_url}ruangan/get_ruangan`;
		const dataPost = new FormData();
		dataPost.append(
			"where", JSON.stringify({
				id_ruangan: id_ruangan
			})
		)
		const response = await request_xhr(url, "POST", dataPost);
		console.log(response.pesan);
		if (response.status) {
			formAdd.reset();
			modalAdd.querySelector(".modal-title").innerHTML = "Edit Data Ruangan";
			formAdd.querySelector("#id_ruangan").value = response.data.id_ruangan;
			formAdd.querySelector("#nama_ruangan").value = response.data.nama_ruangan;
			$("#modalAdd").modal("show");
		} else {
			Swal.fire({
				icon: "error",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500,
			});
		}
	};

	hapus_data = (id_ruangan) => {
		let url = `${base_url}ruangan/hapus_data/${id_ruangan}`;
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
			url: `${base_url}ruangan/get_dt_ruangan`,
			type: "POST"
		},
		language: {
			url: `${base_url}public/assets/lang.json`

		},
		columns: [{
				data:"no",render:(data, type, row, meta) => {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
			{
				data: "nama_ruangan"
			},
			{
				data: "aksi"
			},
		],
	}
