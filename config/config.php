<?php

$host_koneksi = "localhost";
$username_koneksi = 'root';
$password_koneksi = '';
$database_name = 'laundry';

$config = mysqli_connect($host_koneksi, $username_koneksi, $password_koneksi, $database_name);

if (!$config) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
