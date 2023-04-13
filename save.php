<?php
require_once('database.php');

// buat instance class Database
$db = new Database('localhost', 'root', '', 'latihan3');

// ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];

// simpan data ke dalam database
$data = array('name' => $name, 'email' => $email);
$db->insert('users', $data);

// kembali ke halaman utama
header('Location: home');
