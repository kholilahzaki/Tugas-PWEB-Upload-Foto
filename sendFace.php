<?php
include_once("condb.php");


$base64_string = $_POST['image'];
$username = $_POST['idUser'];
$password = $_POST["password"];
$image_name = "uploadedfile/".$username;


$login = mysqli_query($mysqli,"SELECT * FROM `daftar` WHERE nama='$nama' and password='$password'");
$cek = mysqli_num_rows($login);

if($cek < 1){
    echo "User tidak valid";
    return;
}

while($user_data = mysqli_fetch_array($login)){
    $id_users = $user_data['id_user'];
}
//mysqli_close($mysqli);

if (!file_exists($image_name)) {
 if (!mkdir($image_name)) {
    $m=array('msg' => "REJECTED, cant create folder");
    echo json_encode($m);
    return;}
}

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi)+1;
$data = explode(',', $base64_string);
$fullName = $image_name."\\X__".$fileCount."_". date("YmdHis") .".png";
$ifp = fopen($fullName, "wb");
fwrite($ifp, base64_decode($data[1]));
fclose($ifp);
if (!$ifp){
    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    echo json_encode($m);
    return;}

$result = mysqli_query($mysqli, "INSERT INTO `log`(id_user, keterangan) VALUES('$id_user','Gambar dengan nama $fullName berhasil di upload')");
mysqli_close($mysqli);

// $command = escapeshellcmd("python checkFace.py ".$fullName);
// $output = shell_exec($command);

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi);
$m = array('msg' => "Berhasil Mengirim"." total(".$fileCount.")");
echo json_encode($m);

?>
