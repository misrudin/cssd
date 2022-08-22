<div class="card my-1">
    <div class="card-header  bg-primary">
        <div class="d-flex justify-content-between">
            <h6 class=" text-white">DETAIL PEMINJAMAN</h6>
            <button type="button" class="btn btn-sm btn-light" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
    <div class="card-body border border-primary">
        <div class="row">
            <div class="col-md-2">Nama Ruangan</div>
            <div class="col-md-9"><?= $peminjaman->nama_ruangan ?></div>
        </div>
        <div class="row">
            <div class="col-md-2">Status</div>
            <div class="col-md-9"><?= ($peminjaman->status == 0) ? "<span class='badge badge-warning'>Diproses</span>" : (($peminjaman->status == 1) ? "<span class='badge badge-success'>Dipinjam</span>" : "<span class='badge badge-primary'>Dikembalikan</span>") ?></div>
        </div>
        <div class="row">
            <div class="col-md-2">Tanggal Pinjam</div>
            <div class="col-md-9"><?= (!empty($peminjaman->tgl_pinjam)) ? tgl_default($peminjaman->tgl_pinjam) : "-" ?></div>
        </div>
        <div class="row">
            <div class="col-md-2">Tanggal Kembali</div>
            <div class="col-md-9"><?= (!empty($peminjaman->tgl_kembali)) ? $peminjaman->tgl_kembali : "-" ?></div>
        </div>
    </div>
</div>

<div class="card my-4">
    <div class="card-header bg-warning">
        <b>DAFTAR ALAT YANG AKAN DIKEMBALIKAN</b>
    </div>
    <div class="card-body border border-warning">
        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="add_detail">
            <thead>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>

            </thead>
            <tbody>
                <?php foreach ($peminjaman_detail as $value) { ?>
                    <tr>
                        <td><input type="text" class="form-control" value="<?= $value->nama_barang; ?>"></td>
                        <td>

                            <input type="number" class="form-control" name="stok" id="stok" value="1" min="1" max="<?= $value->qty; ?>" style="width: 7em" required>

                        </td>
                        <td>
                            <button onclick="kembalikan('<?= $value->id_peminjaman; ?>#<?= $value->id_barang ?>')" type="button" class="btn btn-primary btn-sm">Kembalikan</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    window.addEventListener("DOMContentLoaded", () => {
        $("#add_detail").DataTable({
            bInfo: false,
            searching: false,
            paginate: false,
            responsive: true
        });
    })

    kembalikan = async (id) => {
        let str = id
        let newStr = str.split("#");
        let id_peminjaman = newStr[0]
        let id_barang = newStr[1]

        let url = `${base_url}peminjaman/proses_pengembalian/${id_peminjaman}/${id_barang}`;
        Swal.fire({
            icon: 'question',
            title: 'Apakah anda akan mengembalikan alat ini?',
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-dark",
            },
            showCancelButton: true,
            confirmButtonText: `Ya, kembalikan`,
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
                    location.reload()
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: `${response.pesan}`,
                        showConfirmButton: false,
                        timer: 3500,
                    });
                    location.reload()
                }
            }
        })
    }
</script>