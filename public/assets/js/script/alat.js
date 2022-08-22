let tabel
	let formAdd;
	let formDetail;
	let modalAdd;

	formDetail = document.querySelector("#formDetail");
	formAdd = document.querySelector("#formAdd");
	modalAdd = document.querySelector("#modalAdd");

	$(function() {
		tabel = $("#datatable").DataTable(config_tb)
	})

	// formAdd.addEventListener("submit", (e) => {
	// 	e.preventDefault();
	// 	const formData = new FormData(e.currentTarget);
	// 	simpan_data(formData);
	// })

	document.querySelector("#pencarian").addEventListener("keyup", ()=>{
		tabel.ajax.reload(null, false);
	})	

	reset_data = () => {
			document.querySelector("#pencarian").value = '';
			tabel.ajax.reload(null, false);
	}

	document.querySelector(".btn-plus").addEventListener("click", () => {
		document.querySelector('#stok').value = parseInt(document.querySelector('#stok').value) + 1;
	})
	document.querySelector(".btn-min").addEventListener("click", () => {
		if (document.querySelector('#stok').value > 2) {
			document.querySelector('#stok').value = parseInt(document.querySelector('#stok').value) - 1;
		} else {
			document.querySelector('#stok').value = 1;
		}
	})

	tambah = () => {
		formAdd.reset();
		modalAdd.querySelector(".modal-title").innerHTML = 'Tambah Alat';
		$("#modalAdd").modal('show');
	}

	simpan_data = async (formData) => {
		let url = `${base_url}alat/simpan_data`;
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

	edit_data = async (id_barang) => {
		let url = `${base_url}alat/get_alat`;
		const dataPost = new FormData();
		dataPost.append(
			"where", JSON.stringify({
				id_barang: id_barang
			})
		)
		const response = await request_xhr(url, "POST", dataPost);
		console.log(response.pesan);
		if (response.status) {
			formAdd.reset();
			modalAdd.querySelector(".modal-title").innerHTML = "Edit Data Alat";
			formAdd.querySelector("#id_barang").value = response.data.id_barang;
			formAdd.querySelector("#nama_barang").value = response.data.nama_barang;
			// formAdd.querySelector("#total_stok").value = response.data.total_stok;
			// formAdd.querySelector("#satuan").value = response.data.satuan;
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

	hapus_data = (id_barang) => {
		let url = `${base_url}alat/hapus_data/${id_barang}`;
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

	detail_data = async (id_barang) => {
		
		let url = `${base_url}alat/get_alat`;
		const dataPost = new FormData();
		dataPost.append(
			"where", JSON.stringify({
				id_barang: id_barang
			})
		)
		const response = await request_xhr(url, "POST", dataPost);
		console.log(response.pesan);
		if (response.status) {
			formDetail.reset();
			formDetail.querySelector("#detail_id_barang").value = response.data.id_barang;
			formDetail.querySelector("#detail_nama_barang").value = response.data.nama_barang;
			formDetail.querySelector("#detail_total_stok").value = response.data.total_stok;
		} else {
			Swal.fire({
				icon: "error",
				title: `${response.pesan}`,
				showConfirmButton: false,
				timer: 1500,
			});
		}
		$("#datatable_detail").DataTable({
		responsive: true,
		processing: true,
		ajax: {
			url: `${base_url}alat/get_alat_by_id/${id_barang}`,
			type: "GET"
		},
		language: {
			url: `${base_url}public/assets/lang.json`

		},
		columns: [
			{
				data: (row) => {
					return row.nama_barang;
				},
				data: (row) => {
					return row.stok_total;
				},
				data: (row) => {
					return `<button onclick=edit_detail(${row.id_barang}) class="btn btn-primary"><i class="fas fa-pecil"></i></button`;
				},
			}],
		"bFilter":false,
		"bLengthChange": false,
		
	})
	$("#modalDetail").modal('show');
	}

	config_tb = {
		"searching": false,
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
			url: `${base_url}alat/get_dt_barang`,
			type: "POST",
			data: function(d) {
				d.pencarian = document.querySelector("#pencarian").value
			}
		},
		language: {
			url: `${base_url}public/assets/lang.json`

		},
		columns: [{
			data:"no", render: function(data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}
		},
			{
				data: "nama_barang"
			},
			{
				data: "stok_total"
			},
			{
				data: "stok_tersedia"
			},
			{
				data: "qr_code"
			},
			{
				data: "aksi"
			},
		],
	}
