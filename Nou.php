<?php

/**
 * Clase Nou
 * Permite añadir nuevos productos a la base de datos.
 */
require_once('Connexio.php');

class Nou {
    /**
     * Añade un nuevo producto a la base de datos.
     *
     * @param string $nom Nombre del producto.
     * @param string $descripcio Descripción del producto.
     * @param float $preu Precio del producto.
     * @param int $categoriaId ID de la categoría del producto.
     * @return void
     */
    public function afegirProducte($nom, $descripcio, $preu, $categoriaId) {
        if (empty($nom) || empty($descripcio) || empty($preu) || empty($categoriaId)) {
            echo '<p>Todos los campos son obligatorios.</p>';
            return;
        }

        $connexioObj = new Connexio();
        $connexio = $connexioObj->obtenirConnexio();

        $sql = "INSERT INTO productes (nom, descripció, preu, categoria_id) VALUES (?, ?, ?, ?)";
        $stmt = $connexio->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdi", $nom, $descripcio, $preu, $categoriaId);
            if ($stmt->execute()) {
                header('Location: Principal.php');
                exit();
            } else {
                echo '<p>Error al añadir el producto: ' . $stmt->error . '</p>';
            }
            $stmt->close();
        } else {
            echo '<p>Error al preparar la consulta: ' . $connexio->error . '</p>';
        }

        $connexio->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $descripcio = $_POST['descripcio'] ?? '';
    $preu = $_POST['preu'] ?? 0;
    $categoriaId = $_POST['categoria'] ?? 0;

    $nou = new Nou();
    $nou->afegirProducte($nom, $descripcio, $preu, $categoriaId);
}

?>