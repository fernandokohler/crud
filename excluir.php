<?php
/**
 * Created by PhpStorm.
 * User: luiz_
 * Date: 10/09/2017
 * Time: 19:04
 */
require "class/Colaborador.php";

$url = $_SERVER["REQUEST_URI"];
$cd = end(explode("/", $url));

/**
 * Seleciona o colaborador
 */
if (isset($cd)) {

    $colaborador = new Colaborador();

    $colaborador->setCdColaborador($cd);

    $colaborador->delete();

    header('Location: /');
}