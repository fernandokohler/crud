<?php
/**
 * Created by PhpStorm.
 * User: luiz_
 * Date: 09/09/2017
 * Time: 16:34
 */
ini_set('display_errors', 0);

$conn = new mysqli('127.0.0.1', 'root', '', 'crud');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}