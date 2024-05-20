<?php 

class MotoImportada extends Moto {
    
    //Atributos 
    private $pais ; 
    private $impuestos; 

    //Constructor 
    public function __construct($clave, $precio, $anio , $caracteristicas , $porcentajeAnual , $actividad,$origenPais,$impuestosImportacion)
    {
        parent::__construct($clave, $precio, $anio , $caracteristicas , $porcentajeAnual , $actividad);
        $this->pais = $origenPais ; 
        $this->impuestos = $impuestosImportacion;
    }

    //Get 
    public function getPais(){
        return $this->pais ; 
    }
    public function getImpuestos(){
        return $this->impuestos ;
    }

    //Set 
    public function setPais($origenPais){
        $this->pais = $origenPais ; 
    }
    public function setImpuestos($impuestosImportacion){
        $this->impuestos = $impuestosImportacion ;
    }

    //ToString 
    public function __toString()
    {
        $cadenaPadre = parent::__toString();
        return $cadenaPadre . "Pais de origen: " . $this->getPais() . "\n" . 
        "Impuestos de importacion: " . $this->getImpuestos() . "\n";
    }

    //obtiene el precio del padre y le suma el impuesto pagado por la empresa 
    public function darPrecioVenta()
    {
        $precioBase = parent::darPrecioVenta() ; 
        $impuestos = $this->getImpuestos() ; 
        $precioFinal = $precioBase + $impuestos ;
        return $precioFinal;
    }

}