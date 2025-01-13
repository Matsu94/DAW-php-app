<?php

require_once('Connexio.php');
require_once('Header.php');

/**
 * Classe Principal
 * Mostra la llista de productes i gestiona l'afegit de nous productes.
 */
class Principal
{

    /**
     * Mostra la llista de productes amb les seves categories i el formulari per afegir un nou producte.
     *
     * @return void
     */
    public function mostrarProductes()
    {
        // Obté la connexió a la base de dades
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        // Consulta per obtenir la llista de productes amb informació de categories
        $consulta = "SELECT p.id, p.nom, p.descripció, p.preu, c.nom as categoria
                     FROM productes p
                     INNER JOIN categories c ON p.categoria_id = c.id";
        $resultado = $conexion->query($consulta);

        // Genera la interfície HTML
        echo '<!DOCTYPE html>
              <html lang="es">
              <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Llista de productes</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
              </head>
              <body>
                <div class="container mt-5" style="margin-bottom: 100px">';

        if ($resultado->num_rows > 0) {
            // Mostra la taula de productes
            echo '<table class="table table-striped">';
            echo '<thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Descripció</th>
                        <th>Preu</th>
                        <th>Categoria</th>
                        <th colspan="2">Accions</th>
                    </tr>
                  </thead>';
            echo '<tbody>';
            $i = 1;

            // Itera sobre els resultats
            while ($fila = $resultado->fetch_assoc()) {
                echo '<tr>
                        <td>' . $i . '</td>
                        <td>' . 'prod-' . $fila['id'] . '</td>
                        <td>' . $fila['nom'] . '</td>
                        <td>' . $fila['descripció'] . '</td>
                        <td>' . $fila['preu'] . '</td>
                        <td>' . $fila['categoria'] . '</td>
                        <td><a href="Modificar.php?id=' . $fila['id'] . '" class="btn btn-warning">Modificar</a></td>
                        <td><a href="Eliminar.php?id=' . $fila['id'] . '" class="btn btn-danger">Eliminar</a></td>
                      </tr>';
                $i++;
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No hi ha productes.</p>';
        }

        // Formulario per afegir nous productes
        echo '<div class="mt-4">
                <h4>Afegir nou producte</h4>
                <form action="Nou.php" method="POST" class="row g-3">
                    <div class="col-md-4">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcio" class="form-label">Descripció:</label>
                        <input type="text" name="descripcio" id="descripcio" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="preu" class="form-label">Preu:</label>
                        <input type="number" name="preu" id="preu" step="0.01" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <select name="categoria" id="categoria" class="form-select" required>
                            <option value="1">Electrònics</option>
                            <option value="2">Roba</option>
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Afegir producte</button>
                    </div>
                </form>
              </div>';

        // Inclou el footer
        require_once('Footer.php');
        $conexion->close();
    }
}

// Instancia la classe Principal
$listaProductos = new Principal();
$listaProductos->mostrarProductes();

?>