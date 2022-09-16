<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
DEFINE('DB_USER', 'root'); // root
DEFINE('DB_PASSWORD', ''); // no password
DEFINE('DB_HOST', 'localhost');

$dbc = mysqli_connect(DB_HOST, DB_USER,
DB_PASSWORD) OR die('Could not connect to MySQL:
'.mysqli_connect_error());
