<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>
<style>
    @media print {
        body {
            width: 21cm;
            height: 29.7cm;
            /* change the margins as you want them to be. */
        }
    }

    html,
    body {
        min-height: 100vh;
        margin: auto;
    }

    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto;
        gap: 10px;
        background-color: white;
    }

    .grid-container>div {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid black;
        text-align: center;
        font-size: 30px;
    }

    .card {
        width: 145px;
    }

    .container {
        padding: 2px 16px;
    }
</style>

<body onload="window.print()">
    <h1><?= $title; ?></h1>
    <div class="grid-container">
        <?php foreach ($alat as $a) { ?>
            <div class="card">
                <div class="container">
                    <img src="<?= site_url('image_qr/') . $a->qr_code; ?>" width="100px">
                    <p style="font-size:14px;margin-top:0"><?= $a->nama_barang; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>