<?php

/**
 * Clase Modificar
 * Permite mostrar un formulario para modificar productos.
 */
require_once('Connexio.php');
require_once('Header.php');

class Modificar {
    /**
     * Muestra un formulario para modificar un producto.
     *
     * @param int $id ID del producto a modificar.
     * @return void
     */
    public function mostrarFormulari($id) {
        if (!isset($id) || !is_numeric($id)) {
            echo '<p>ID de producto no válido.</p>';
            return;
        }

        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        $consulta = "SELECT id, nom, descripció, preu, categoria_id
                     FROM productes
                     WHERE id = $id";
        $resultado = $conexion->query($consulta);

        if ($resultado && $resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();
            echo '<!DOCTYPE html>
                  <html lang="es">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Modificar producte</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <h2>Modificar producte</h2>
                        <form action="Actualitzar.php" method="POST">
                            <input type="hidden" name="id" value="' . $producto['id'] . '">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nombre:</label>
                                <input type="text" name="nom" class="form-control" value="' . $producto['nom'] . '" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcio" class="form-label">Descripción:</label>
                                <input type="text" name="descripcio" class="form-control" value="' . $producto['descripció'] . '" required>
                            </div>
                            <div class="mb-3">
                                <label for="preu" class="form-label">Precio:</label>
                                <input type="number" name="preu" class="form-control" value="' . $producto['preu'] . '" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría:</label>
                                <select name="categoria" class="form-select" required>
                                    <option value="1" ' . ($producto['categoria_id'] == 1 ? 'selected' : '') . '>Electrònics</option>
                                    <option value="2" ' . ($producto['categoria_id'] == 2 ? 'selected' : '') . '>Roba</option>
                                </select>
                            </div>
                            <input type="submit" value="Guardar" class="btn btn-primary">
                            <a href="Principal.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>';
            require_once('Footer.php');
        } else {
            echo '<p>No se encontró el producto.</p>';
        }

        $conexion->close();
    }
}

$idProducto = $_GET['id'] ?? null;
$modificarProducto = new Modificar();
$modificarProducto->mostrarFormulari($idProducto);

?>