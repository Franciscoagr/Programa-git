<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$db_host = 'localhost:3308';
$db_user = 'root';
$db_password = '';
$db_name = 'proyecto';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$guia = $_POST['buscar'];
$actual = $_POST['actual'];
$proximo = $_POST['proximo'];

$sql = "UPDATE principalguia SET actual=?, proximo=? WHERE guia=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $actual, $proximo, $guia);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Los datos se han actualizado correctamente en la base de datos. Filas afectadas: " . $stmt->affected_rows;
    } else {
        echo "Los datos no se han cambiado. Es posible que la guía no exista o los valores son los mismos.";
    }
} else {
    echo "Error al actualizar los datos: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
