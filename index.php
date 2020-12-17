<?php
// Create database connection using config file
include_once("condb.php");
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Upload Gambar</title>
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
</head>

<?php
$result = mysqli_query($mysqli, "SELECT l.*, d.nama FROM `log` l, `daftar` d WHERE l.id_user = d.id_user ORDER BY created_at ASC");
?>

<body>
<center><table border="1">
    <thead>
    <tr>
        <th>Username</th>
        <th>Keterangan</th>
        <th>Waktu</th>
    </tr>
    </thead>
    <tbody>
    <?php while($data = mysqli_fetch_array($result)){?>
        <tr>
            <input class="id" type="hidden" value="<?= $data['id_log']; ?>">
            <td class="desc"><?= $data['nama']; ?></td>
            <td class="desc"><?= $data['keterangan']; ?></td>
            <td class="date"><?= $data['time']; ?></td>
        </tr>
    <?php
    mysqli_close($mysqli);
    }?>
    <?php if (mysqli_num_rows($result) < 1){?>
    <tr>
        <td colspan="3"><center>Data masih kosong</center></td>
    </tr>
    <?php }?>
    </tfoot>
</table>
</center>
</body>
</html>