<?php 

class Moto {

    //Atributos 
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porIncrementoAnual; 
    private $activa; 

    //CONSTRUCTOR 
    public function __construct($clave, $precio, $anio , $caracteristicas , $porcentajeAnual , $actividad)
    {
        $this-> codigo = $clave;
        $this-> costo = $precio;
        $this-> anioFabricacion = $anio;
        $this->descripcion = $caracteristicas; 
        $this->porIncrementoAnual = $porcentajeAnual; 
        $this->activa = $actividad;
    }

    //GET 
    public function getCodigo () {
        return $this->codigo  ;
    }
    public function getCosto () {
        return $this-> costo ;
    }
    public function getAnioFabricacion () {
        return $this-> anioFabricacion ;
    }
    public function getDescripcion () {
        return $this-> descripcion ;
    }
    public function getPorIncrementoAnual () {
        return $this-> porIncrementoAnual ;
    }
    public function getActiva() {
        return $this-> activa ;
    }

    //SET 
    public function setCodigo ($clave ){
        $this-> codigo = $clave ;
    }
    public function setCosto ($precio ){
        $this-> costo = $precio  ;
    }
    public function setAnioFabricacion ($anio ){
        $this-> anioFabricacion = $anio ;
    }
    public function setDescripcion ($caracteristicas ){
        $this-> descripcion = $caracteristicas ;
    }
    public function setPorIncrementoAnual ($porcentajeAnual ){
        $this-> porIncrementoAnual = $porcentajeAnual ;
    }
    public function setActiva ($actividad ){
        $this-> activa = $actividad  ;
    }

    //__toString
    public function __toString()
    {
        return "Codigo: " . $this->getCodigo() . "\n" . 
        "Costo: " . $this->getCosto() . "\n" . 
        "Año fabricacion: " . $this->getAnioFabricacion() . "\n" . 
        "Descripcion: " . $this->getDescripcion() . "\n" . 
        "Porcentaje de incremento anual: " . $this->getPorIncrementoAnual() . "\n" . 
        "Estado de actividad: " . $this->getActiva() . "\n";
    }

    //
    public function darPrecioVenta(){
        $venta = 0 ;
        if ($this->getActiva()) {
            $compra = $this->getCosto() ; 
            $anioActual = date('Y') ;
            $aniosTranscuridos = $anioActual - $this->getAnioFabricacion() ; 
            $venta = $compra + $compra * ($aniosTranscuridos * ($this->getPorIncrementoAnual()/100)) ;
        } 
        return $venta ;
    }


}