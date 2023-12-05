<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$db_host = 'localhost:3308';
$db_user = 'root';
$db_password = '';
$db_name = 'proyecto';
// Crea conexión a la base de datos
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consultar y comparar base de datos 
    $sql = "SELECT * FROM acceso WHERE usuario=? AND contrasena=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Inicio de sesión exitoso
            header("Location: editarguia.html");
            exit();
        } else {
            echo "Nombre de usuario o contraseña incorrectos";
        }
        
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
