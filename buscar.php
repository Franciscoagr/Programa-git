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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Obtener los datos del formulario
    $guia = $_POST['buscar_guia'];

   // Consultar y comparar base de datos 
    $sql = "SELECT * FROM principalguia WHERE guia=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $guia);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Mostrar el resultado por medio de este html
?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>resultado</title>
                <link rel="stylesheet" href="codigo.css">
            </head>
            <body>

            <div id="contenedor_resultado">
                <h2>Información de la Guía:</h2>

<?php
                // Mostrar información de la guía
                $row = $result->fetch_assoc();
                echo "<p>Guía: " . $row['guia'] . "</p>";
                echo "<p>Ubicación Actual: " . $row['actual'] . "</p>";
                echo "<p>Próximo Destino: " . $row['proximo'] . "</p>";
?>
            </div>

            </body>
            </html>
<?php
        } else {
            echo "No se encontró información para la guía proporcionada.";
        }
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
