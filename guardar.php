<?php
// Habilita mensajes de error para depuración
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Información de conexión a la base de datos
$db_host = 'localhost:3308';
$db_user = 'root'; // Reemplaza con tu nombre de usuario de la base de datos
$db_password = ''; // Reemplaza con tu contraseña de la base de datos
$db_name = 'proyecto';

// Crea una conexión a la base de datos
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

// Cierra la conexión a la base de datos
$stmt->close();
$conn->close();
?>
