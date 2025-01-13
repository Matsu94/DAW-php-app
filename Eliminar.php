<?php

/**
 * Clase Eliminar
 * Permite eliminar productos de la base de datos.
 */
require_once('Connexio.php');

class Eliminar {
    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $id ID del producto a eliminar.
     * @return void
     */
    public function eliminarProducte($id) {
        if (empty($id)) {
            echo '<p>ID del producto no proporcionado.</p>';
            return;
        }

        $connexioObj = new Connexio();
        $connexio = $connexioObj->obtenirConnexio();

        $sql = "DELETE FROM productes WHERE id = ?";
        $stmt = $connexio->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                header('Location: Principal.php');
                exit();
            } else {
                echo '<p>Error al eliminar el producto: ' . $stmt->error . '</p>';
            }
            $stmt->close();
        } else {
            echo '<p>Error al preparar la consulta: ' . $connexio->error . '</p>';
        }

        $connexio->close();
    }
}

// Procesa la eliminación del producto
$id = $_GET['id'] ?? null;
$eliminar = new Eliminar();
$eliminar->eliminarProducte($id);

?>