let formLogin = document.querySelector("#formLogin");

		formLogin.addEventListener("submit", (e) => {
			e.preventDefault();
			let username = document.querySelector("#username").value;
			let password = document.querySelector("#password").value;
			if (username == "" && password == "") {
				toastr.error(
					"Pastikan kolom username dan password terisi",
					"Informasi Login", {
						showMethod: "fadeIn",
						hideMethod: "fadeOut",
						timeOut: 2000,
					}
				)
			} else if (username != "" && password == "") {
				toastr.error(
					"Pastikan kolom password terisi",
					"Informasi Login", {
						showMethod: "fadeIn",
						hideMethod: "fadeOut",
						timeOut: 2000,
					}
				)
			} else if (username == "" && password != "") {
				toastr.error(
					"Pastikan kolom username terisi",
					"Informasi Login", {
						showMethod: "fadeIn",
						hideMethod: "fadeOut",
						timeOut: 2000,
					}
				)
			} else {
				const formData = new FormData(e.currentTarget);
				formLogin.querySelector("#username").disabled = true;
				formLogin.querySelector("#password").disabled = true;
				masuk(formData);
			}
		})

		const masuk = (formData) => {
			let url = `${base_url}auth/cek_login`;
			let redirect = `${base_url}home`;
			fetch(url, {
				method: "POST",
				cache: "no-cache",
				body: formData
			}).then((response) => {
				if (response.ok) {
					return response.json();
				} else {
					return Promise.reject({
						status: response.status,
						status_text: response.statusText,
						responseText: response.text(),
					});
				}
			}).then((out) => {
				formLogin.querySelector("#username").disabled = false;
				formLogin.querySelector("#password").disabled = false;
				if (out.status) {
					formLogin.querySelector("[type='submit']").disabled = true;
					formLogin.querySelector("[type='submit']").innerHTML = "Redirect...";

					window.location = `${redirect}`;
				} else {
					formLogin.querySelector("[type='submit']").disabled = false;
					formLogin.querySelector("[type='submit']").innerHTML = "Masuk";

					toastr.error(out.pesan, "Informasi Login", {
						showMethod: "fadeIn",
						hideMethod: "fadeOut",
						timeOut: 2000,
					});
				}
			}).catch((error) => {
				formLogin.querySelector("[type='submit']").disabled = true;
				formLogin.querySelector("[type='submit']").innerHTML =
					`Muat Ulang Halaman. Request Error`;
				toastr.error(
					`HTTP Error ${error.status}, ${error.status_text}. Cek Response Error pada Devtool (Browser)`,
					"Informasi", {
						showMethod: "fadeIn",
						hideMethod: "fadeOut",
						timeOut: 2000,
					}
				);
			})
		}
