<?php

header('Access-Control-Allow-Origin: *');

$conn = new mysqli("localhost", "id21032953_user", "DX_photo2", "id21032953_dxphoto");

if (mysqli_connect_error()) {
	echo mysqli_connect_error();
	exit();
} else {
	$username = $_POST['username'];
	$notlp = $_POST['notlp'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$usernamedb = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	// cek konfirmasi username
	if (mysqli_fetch_assoc($usernamedb)) {
		echo "Username telah digunakan!";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	$sql = "INSERT INTO user (username, password, notlp, email) VALUES('$username','$password','$notlp','$email');";
	$res = mysqli_query($conn, $sql);;

	if ($res) {
		echo "Success!";
	} else {
		echo "Gagal";
	}
	$conn->close();
}
