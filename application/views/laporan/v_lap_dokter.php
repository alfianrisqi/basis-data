<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">

    <style>
        .table-bordered th,
        .table-bordered thead th,
        .table-bordered th {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="mb-0 mt-4">KLINIK ANUGRAH</h3>
        <small class="mb-0 text-center">Jl. Bromo No.01 Kec.Kepanjen Kab.Malang
        </small>
        <hr>
        <h4 class="text-center">LAPORAN DATA DOKTER</h4>

        <table class="table table-bordered table-sm">
            <tr>
                <th width="80px">No.</th>
                <th>Nama Dokter</th>
            </tr>
            <?php $no = 1;
            foreach ($dokter as $r) { ?>
                <tr>
                    <th class="text-center"><?= $no; ?></th>
                    <th><?= $r['nama_dokter']; ?></th>
                </tr>
            <?php $no++;
            } ?>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td></td>
                <th width="300px">
                    <p>
                        KLINIK ANUGRAH, <?= date('d-m-Y'); ?>
                        <br>
                        Management
                        <br><br><br><br>
                        <b>_______________________________</b>
                    </p>
                </th>
            </tr>
        </table>
    </div>
</body>

</html>