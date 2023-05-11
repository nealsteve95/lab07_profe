<?php
//print_r($_POST);
if (empty($_POST["txtPromocion"]) || empty($_POST["txtDuracion"]) || empty($_FILES["ImgPromo"]["name"]) || $_FILES["ImgPromo"]["error"] != 0)  {
    header('Location: index.php');
    exit();
}

include_once 'model/conexion.php';
$promocion = $_POST["txtPromocion"];
$duracion = $_POST["txtDuracion"];
$codigo = $_POST["codigo"];
$img_name = $_FILES["ImgPromo"]["name"];
$img_tmpname = $_FILES["ImgPromo"]["tmp_name"];
$img_bytes = file_get_contents($img_tmpname);

$sentencia = $bd->prepare("INSERT INTO promociones(promocion,duracion,id_persona, imagen, img_name) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$promocion,$duracion, $codigo, $img_bytes, $img_name ]);

if ($resultado === TRUE) {
    header('Location: agregarPromocion.php?codigo='.$codigo);
}

