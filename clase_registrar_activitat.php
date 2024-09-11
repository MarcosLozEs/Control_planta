<?php
class Registrar
{
    private $db;
    private $usuari_id;
    private $maquina_id;
    private $accions_id;
    private $fecha;
    private $hora;
    private $identificador;

    public function __construct($db, $usuari_id, $maquina_id=null, $accions_id=null, $fecha, $hora, $identificador = null)
    {
        $this->db = $db;
        $this->usuari_id = $usuari_id;
        $this->maquina_id = $maquina_id;
        $this->accions_id = $accions_id;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->identificador = $identificador;
    }

    public function registrar_activitat()
    {
        $insertar = $this->db->conn->prepare("INSERT INTO activitats (fecha, hora, usuari_id, maquina_id, accions_id, identificador) VALUES (?, ?, ?, ?, ?, ?)");
        $insertar->bind_param("ssiiss", $this->fecha, $this->hora, $this->usuari_id, $this->maquina_id, $this->accions_id, $this->identificador);
        if ($insertar->execute()) {
            echo "Registro añadido con éxito.";
        } else {
            echo "Error al añadir el registro.";
        }
    }
}
