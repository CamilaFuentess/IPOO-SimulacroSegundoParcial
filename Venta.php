<?php 

class Venta {

    //Atributos 
    private $numero ;
    private $fecha ;
    private $objCliente ;
    private $colMotos; 
    private $precioFinal ; 
    
    //Constructor 
    public function __construct($nro,$data,$objetoCliente,$coleccionMotos,$costoFinal)
    {
        $this->numero = $nro;
        $this->fecha = $data;
        $this->objCliente = $objetoCliente; 
        $this->colMotos = $coleccionMotos ; 
        $this->precioFinal = $costoFinal ; 
    }

    //Get 
    public function getNumero(){
        return $this->numero ; 
    }
    public function getFecha(){
        return $this->fecha; 
    }
    public function getObjCliente(){
        return $this->objCliente ; 
    }
    public function getColMotos(){
        return $this->colMotos ; 
    }
    public function getPrecioFinal(){
        return $this->precioFinal ; 
    }

    //Set 
    public function setNumero($nro){
        $this->numero = $nro;
    }
    public function setFecha($data){
        $this->fecha = $data;
    }
    public function setObjCliente($objetoCliente){
        $this->objCliente = $objetoCliente;
    }
    public function setColMotos($coleccionMotos){
        $this->colMotos = $coleccionMotos ; 
    }
    public function setPrecioFinal($costoFinal){
        $this->precioFinal = $costoFinal;
    }

    //ToString
    public function __toString()
    {
        return "Numero de venta: " . $this->getNumero() . "\n" . 
        "Fecha: " . $this->getFecha() . "\n" . 
        "Cliente: \n" . $this->getObjCliente() . "\n" . 
        "Motos: \n" . $this->mostrarColMotos() . "\n" . 
        "Precio final: " . $this->getPrecioFinal() . "\n"; 
    }

    //muestra la colecicon de motos compradas 
    public function mostrarColMotos(){
        $colMotos = $this->getColMotos() ; 
        $lista = "" ; 
        foreach ($colMotos as $unaMoto){
            $lista = $lista . $unaMoto . "\n" ; 
        }
        return $lista; 
    }
    
    /**
     * Recibe por parametro un objeto moto y lo incorpora a la colecion de motos de la venta
     *  siempre y cuando sea posible la venta. El método cada vez que incorpora una moto a la venta,
     *  debe actualizar la variable instancia precio final de la venta. Utilizar el método que 
     * calcula el precio de venta de la moto donde crea necesario.
     */
    public function incorporarMoto($objMoto) {
        $cliente = $this->getObjCliente();
        $colecMotos = $this->getColMotos();
        $ventaPrecioFinal = $this->getPrecioFinal();
        if ($objMoto->getActiva() && $cliente->getEstadoBaja() == false ){
            $colecMotos[] = $objMoto;
            $this->setColMotos($colecMotos);
            $precioFinal = $ventaPrecioFinal + $objMoto->darPrecioVenta() ;
            $this->setPrecioFinal($precioFinal);
        }
    }


    //METODS SEGUNDO PARCIAL SIMULACRO 

    // retorna la sumatoria del precio venta de cada una de las motos Nacionales
    //vinculadas a la venta
    public function retornarTotalVentaNacional(){
        $colDeMotos = $this->getColMotos() ; 
        $sumatoria = 0 ;
        foreach($colDeMotos as $unaMoto){
            if ($unaMoto instanceof MotoNacional){
                $precioVenta = $unaMoto->darPrecioVenta() ;
                $sumatoria = $sumatoria + $precioVenta; 
            }
        }
        return $sumatoria ;
    }

    //retorna una colección de motos importadas vinculadas a la venta. Si la venta
    //solo se corresponde con motos Nacionales la colección retornada debe ser vacía.
    public function retornarMotosImportadas(){
        $colMotosImportadas = [] ; 
        $colDeMotos = $this->getColMotos() ; 
        foreach($colDeMotos as $unaMoto){
            if ($unaMoto instanceof MotoImportada){
                $colMotosImportadas[] = $unaMoto;
            }
        }
        return $colMotosImportadas ;
    }


}