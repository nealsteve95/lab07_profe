<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_persona, per.nombres , per.apellido_paterno ,per.apellido_materno,per.celular , per.fecha_nacimiento 
  FROM promociones pro 
  INNER JOIN persona per ON per.id = pro.id_persona 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

    // Para que la imange se mande pero no descargue se usa el SendFileByUpload
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.green-api.com/waInstance1101816201/sendFileByUpload/0e715d66ab8f4d53a5f8185a486b5cbb06c117a0168b493aaa",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array(
        'chatId' => "51".$persona->celular."@c.us",
        'caption' => 'Estimado(a) *'.strtoupper($persona->nombres).' '.strtoupper($persona->apellido_paterno).' '.strtoupper($persona->apellido_materno).'* No se pierda *'.strtoupper($persona->promocion).'* valido solo *'.$persona->duracion.'*',
        'file' => curl_file_create('Imagen/descarga.jpg', 'image/jpeg', 'descarga.jpg')
    ),
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: multipart/form-data"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    echo $response;
    }
    /* ********************** 
    $url = 'https://api.green-api.com/waInstance1101816201/sendFileByUpload/0e715d66ab8f4d53a5f8185a486b5cbb06c117a0168b493aaa';

    $data = array(  
        "chatId" => "51".$persona->celular."@c.us", 
        "message" =>  'Estimado(a) *'.strtoupper($persona->nombres).' '.strtoupper($persona->apellido_paterno).' '.strtoupper($persona->apellido_materno).'* No se pierda *'.strtoupper($persona->promocion).'* valido solo *'.$persona->duracion.'*'
        
    );
    
    
    $filePath = 'Imagen/descarga.jpg';
    $fileName = 'descarga.jpg';
    $fileType = 'image/jpg';
    $fileContent = fopen($filePath, 'rb');
    
    $files = array(
        'file' => array(
           'descarga.jpg',
           fopen($filePath, 'rb'),
           'image/jpg'
            )  
    );
    
    
    $headers = array();
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $files);
    
    $response = curl_exec($ch);
    */
    
?> 
