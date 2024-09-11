<?php class Consultar
{
    private $db;
    private $element_a_consultar;
    private $consulta;
    private $tipo_dada;

    public function __construct($db, $element_a_consultar, $consulta, $tipo_dada)
    {
        $this->db = $db;
        $this->element_a_consultar = $element_a_consultar;
        $this->consulta = $consulta;
        $this->tipo_dada = $tipo_dada;
    }
    public function consultar()
    {
        try {
            $consulta = $this->db->conn->prepare($this->consulta);
            if (!$consulta) {
                throw new Exception("Error al preparar la consulta");
            }

            if ($this->tipo_dada != "null") {
                $bind_params = array_merge([$this->tipo_dada], $this->element_a_consultar);
                $this->bindParams($consulta, $bind_params);
            }

            if (!$consulta->execute()) {
                throw new Exception("No se puede eliminar un supervisor con trabajadores a cargo.");
            }
                              
            if (stripos($this->consulta, 'SELECT') !== false) {  //diferencia entre select o delete
                return $consulta->get_result(); 
            } else {         
                $filas_eliminadas = $consulta->affected_rows;
                return $filas_eliminadas > 0; 
            }

        } catch (Exception $e) {
            echo json_encode(array("Error: " . $e->getMessage()));
            return false;
        }
    }
    function bindParams($consulta, $params) //SELECT nom_usuari FROM usuaris WHERE usuari_id = supervisor_id) AS nom_supervisor FROM usuaris WHERE usuari_id = ?', "s"
    {
        $bind_params = [];
        foreach ($params as $key => $value) {
            $bind_params[$key] = &$params[$key];
        }
        call_user_func_array(array($consulta, 'bind_param'), $bind_params);
    }
}
