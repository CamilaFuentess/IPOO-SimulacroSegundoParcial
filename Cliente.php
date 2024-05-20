<?php 

class Cliente {
    //ATRIBUTOS 
    private $nombre;
    private $apellido;
    private $estadoBaja; //si un cliente esta dado de baja, no puede registrar compras
    private $tipoDoc;
    private $nroDoc;     

    //CONSTRUCTOR 
    public function __construct($nombre_cliente,$apellido_cliente,$estado, $tipo_documento,$numero_doc)
    {
        $this->nombre=$nombre_cliente;
        $this->apellido=$apellido_cliente;
        $this->estadoBaja = $estado;
        $this->tipoDoc = $tipo_documento;
        $this->nroDoc = $numero_doc;
    }

    //GET 
    public function getNombre(){
        return $this->nombre  ;
    }
    public function getApellido(){
        return $this-> apellido ;
    }
    public function getEstadoBaja(){
        return $this-> estadoBaja ;
    }
    public function getTipoDoc(){
        return $this->  tipoDoc;
    }
    public function getNroDoc(){
        return $this-> nroDoc ;
    }

    //SET 
    public function setNombre($nombre_cliente){
        $this-> nombre = $nombre_cliente  ;
    }
    public function setApellido($apellido_cliente){
        $this-> apellido = $apellido_cliente  ;
    }
    public function setEstadoBaja($estado){
        $this->estadoBaja  = $estado ;
    }
    public function setTipoDoc($tipo_documento){
        $this-> tipoDoc = $tipo_documento  ;
    }
    public function setNroDoc($numero_doc){
        $this-> nroDoc = $numero_doc  ;
    }

    //__toString
    public function __toString()
    {
        return "Nombre: " .$this->getNombre()."\n" . 
        "Apellido: " . $this->getApellido() . "\n" . 
        "Estado: " . $this->mostrarEstado() . "\n" . 
        "Tipo de documento: " . $this->getTipoDoc(). "\n" . 
        "Numero de documento: " . $this->getNroDoc() . "\n";
    }

    //El estado de baja es un operador ternario, por lo cual necesito modificarlo para mostrarlo en el tostring 
    public function mostrarEstado(){
        $estado = $this->getEstadoBaja();
        if ($estado){
            $i = "De baja";
        } else {
            $i = "Activo";
        }
        return $i;
    }
}