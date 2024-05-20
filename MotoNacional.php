<?php 

class MotoNacional extends Moto {

    //Atributos 
    private $descuento;

    //Constructor 
    public function __construct($clave, $precio, $anio , $caracteristicas , $porcentajeAnual , $actividad)
    {
        parent::__construct($clave, $precio, $anio , $caracteristicas , $porcentajeAnual , $actividad);
        $this->descuento = 15;
    }

    //Get 
    public function getDescuento(){
        return $this->descuento ; 
    }

    //Set 
    public function setDescuento($porcentaje){
        $this->descuento = $porcentaje;
    }

    //ToString 
    public function __toString()
    {
        $cadenaPadre = parent::__toString() ; 
        return $cadenaPadre ; 
    }

    //obtiene el precio del padre y le aplica un descuento
    public function darPrecioVenta()
    {
        $precioBase = parent::darPrecioVenta() ;
        $porDescuento = $this->getDescuento(); 
        $precioFinal = $precioBase - ($precioBase * ($porDescuento/100)) ; 
        return $precioFinal ;
    }
}