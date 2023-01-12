<?php

include '../connection.php';

$name       = $_POST['name'];
$email      = $_POST['email'];
$password   = md5($_POST['password']);
$created_at = $_POST['created_at'];
$updated_at = $_POST['updated_at'];


// cek email sudah di gunakan user lain apa belum
$sql_cek = "SELECT * FROM user
            WHERE 
            email = '$email'";
$result_cek = $connect->query($sql_cek);

if ($result_cek->num_rows > 0) {
    echo json_encode(array(
        "success" => false,
        "message" => "Email",
    ));
} else {

    // jika belum digunakan, input datanya
    $sql = "INSERT INTO user
            SET
            name = '$name',
            email = '$email',
            password = '$password',
            created_at = '$created_at',
            updated_at = '$updated_at'";
    $result = $connect->query($sql);

    if ($result) {
        echo json_encode(array(
            "success" => true,
        ));
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "Gagal"
        ));
    }
}
