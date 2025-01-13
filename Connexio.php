<?php

/**
 * Classe Connexio
 * Proporciona una connexió a la base de dades "la_meva_botiga".
 */
class Connexio {
    /**
     * @var string $host Host de la base de dades.
     * @var string $usuario Nom d'usuari de la base de dades.
     * @var string $contraseña Contrasenya de la base de dades.
     * @var string $baseDatos Nom de la base de dades.
     */
    private $host = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $baseDatos = "la_meva_botiga";

    /**
     * Obté la connexió a la base de dades.
     *
     * @return mysqli Connexió a la base de dades.
     * @throws Exception Si hi ha un error en la connexió.
     */
    public function obtenirConnexio() {
        $conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->baseDatos);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}

?>