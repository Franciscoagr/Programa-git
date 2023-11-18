<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Información de conexión a la base de datos
$db_host = 'localhost:3308';
$db_user = 'root'; 
$db_password = ''; 
$db_name = 'proyecto';

// Crea conexión a la base de datos
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recupera los datos del formulario
$guia = $_POST['guia_N'];
$remitente = $_POST['Remitente'];
$destino = $_POST['direccion'];
$destinatario = $_POST['destinatario'];

// Prepara y ejecuta una consulta SQL INSERT
$sql = "INSERT INTO principalguia (guia, remitente, destino, destinatario) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $guia, $remitente, $destino, $destinatario);

if ($stmt->execute()) {
    echo "Los datos se han insertado correctamente en la base de datos.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
