<?php

/**
 * Clase Actualitzar
 * Gestiona la actualización de productos en la base de datos.
 */
require_once('Connexio.php');

class Actualitzar {
    /**
     * Actualiza un producto en la base de datos.
     *
     * @param int $id ID del producto a actualizar.
     * @param string $nom Nombre del producto.
     * @param string $descripcio Descripción del producto.
     * @param float $preu Precio del producto.
     * @param int $categoria ID de la categoría del producto.
     * @return void
     */
    public function actualizar($id, $nom, $descripcio, $preu, $categoria) {
        if (!isset($id, $nom, $descripcio, $preu, $categoria)) {
            echo '<p>Se requieren todos los campos para actualizar el producto.</p>';
            return;
        }

        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        $id = $conexion->real_escape_string($id);
        $nom = $conexion->real_escape_string($nom);
        $descripcio = $conexion->real_escape_string($descripcio);
        $preu = $conexion->real_escape_string($preu);
        $categoria = $conexion->real_escape_string($categoria);

        $consulta = "UPDATE productes
                     SET nom = '$nom', descripció = '$descripcio', preu = '$preu', categoria_id = '$categoria'
                     WHERE id = '$id'";

        if ($conexion->query($consulta) === TRUE) {
            header('Location: Principal.php');
            exit();
        } else {
            echo '<p>Error al actualizar el producto: ' . $conexion->error . '</p>';
        }

        $conexion->close();
    }
}

// Procesa la solicitud de actualización
$id = $_POST['id'] ?? null;
$nom = $_POST['nom'] ?? null;
$descripcio = $_POST['descripcio'] ?? null;
$preu = $_POST['preu'] ?? null;
$categoria = $_POST['categoria'] ?? null;

$actualizarProducto = new Actualitzar();
$actualizarProducto->actualizar($id, $nom, $descripcio, $preu, $categoria);

?>