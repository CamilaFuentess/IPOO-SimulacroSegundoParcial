<?php 

class Empresa{

    //Atributos 
    private $denominacion ; 
    private $direccion ; 
    private $colMotos ; 
    private $colClientes ; 
    private $colVentas; 

    //Contructor 
    public function __construct($id, $ubicacion,  $coleccionMotos,$coleccionClientes, $coleccionVentas)
    {
        $this->denominacion = $id ; 
        $this->direccion = $ubicacion ; 
        $this->colMotos = $coleccionMotos ; 
        $this->colClientes = $coleccionClientes ; 
        $this->colVentas = $coleccionVentas;
    }

    //Get 
    public function getDenominacion(){
        return $this->denominacion;
    }
    public function getDireccion(){
        return $this->direccion ;
    }
    public function getColMotos(){
        return $this->colMotos ; 
    }
    public function getColClientes(){
        return $this->colClientes; 
    }
    public function getColVentas(){
        return $this->colVentas ;
    }

    //Set 
    public function setDenominacion($id){
        $this->denominacion = $id;
    }
    public function setDireccion($ubicacion){
        $this->direccion = $ubicacion ; 
    }
    public function setColMotos($coleccionMotos){
        $this->colMotos = $coleccionMotos ; 
    }
    public function setColClientes($coleccionClientes){
        $this->colClientes = $coleccionClientes ; 
    }
    public function setColVentas($coleccionVentas){
        $this->colVentas = $coleccionVentas;
    }

    //ToString
    public function __toString()
    {
        return "Denominacion: " . $this->getDenominacion() . "\n" . 
        "Direccion: " . $this->getDireccion() . "\n" .  
        "Lista de motos: \n" . $this->mostrarColMotos() . "\n" . 
        "Lista de clientes: \n" . $this->mostarColCliente() . "\n" .
        "Lista de ventas: \n" . $this->mostrarColVentas() . "\n"; 
    }

        
    //RECORRIDO DE LAS COLECCIONES PARA EL TO STRING 
    public function mostarColCliente(){
        $listaClientes = $this->getColClientes();
        $lista = "\n"; 
        foreach($listaClientes as $cliente){
            $lista = $lista . $cliente->__toString(). "\n";
        }
        return $lista;
    }
    public function mostrarColMotos(){
        $listaMotos = $this->getColMotos();
        $listaM ="\n";
        foreach($listaMotos as $lMoto){
            $listaM = $listaM . $lMoto->__toString() . "\n";
        }
        return $listaM;
    }
    public function mostrarColVentas(){
        $listaVenta = $this->getColVentas();
        $listaV = "\n";
        foreach($listaVenta as $lVenta) {
            $listaV = $listaV . $lVenta->__toString(). "\n";
        }
        return $listaV;
    }

    //PUNTOS DEL PRIMER SIMULACRO

    /**
     * recibe por parámetro una colección de códigos de motos, la cual es recorrida, y por cada
     * elemento de la colección se busca el objeto moto correspondiente al código y se incorpora
     * a la colección de motos de la instancia Venta que debe ser creada. Recordar que no todos
     * los clientes ni todas las motos, están disponibles para registrar una venta en un momento
     * determinado. El método debe setear los variables instancias de venta que corresponda y
     * retornar el importe final de la venta
     */
    public function registrarVenta($colCodigosMoto, $objCliente){
        $importeFinal = 0 ;
        if(!$objCliente->getEstadoBaja()){
            //CREO LA VENTA PARA LUEGO USARLA 
            $motosAVender = [];
            $copiaColVentas = $this->getColVentas();
            $idVenta = count($copiaColVentas) +1 ;
            $nuevaVenta = new Venta($idVenta,date('m-d-Y'),$objCliente,$motosAVender,$importeFinal);

            foreach($colCodigosMoto as $unCodigo){                         //encontramos las bicis que nos mandaron por parametro
                $unObjMoto = $this->retornarMoto($unCodigo);           //retorna el obj bici del codigo dado
                if($unObjMoto!=null){
                    $nuevaVenta->incorporarMoto($unObjMoto);
                    //si los codigos no existe, la colec moto va a ser vacia 
                }
            }

            //nuevaVenta->getColMotos() para obtener los articulos 
            if (count($nuevaVenta->getColMotos())>0){                 // si encontre motos para vender 
                $copiaColVentas[] = $nuevaVenta ; 
                $this->setColVentas($copiaColVentas);
                $importeFinal = $nuevaVenta->getPrecioFinal();
            }
        } 
        return $importeFinal;
    }


    /** recorre la colección de motos de la Empresa y retorna la referencia al objeto
     * moto cuyo código coincide con el recibido por parámetro
     */
    public function retornarMoto($codigoMoto){
        $i = 0 ; 
        $colMoto = $this->getColMotos();
        $count = count($colMoto);
        $conseguidaMoto = false ;
        $moto = null;                      //inicializo moto como null por si no se encuentra niguna moto con el codigo dado
        while ($i< $count && !$conseguidaMoto) {
            $obtengoCodigo = $colMoto[$i]->getCodigo();         //obtengo el codigo de la moto que se esta presentando en el bucle
            if ($obtengoCodigo == $codigoMoto) {
                $moto = $colMoto[$i];                      //se le asigna el objeto moto actual, que tiene que coincidir con el codigo ddo.
                $conseguidaMoto = true;
            }
            $i++;
        }
        return $moto; 
    }

    /**
     * recibe por parámetro el tipo y número de documento de un Cliente y retorna una colección
     * con las ventas realizadas al cliente.
     */
    public function retornarVentasXCliente($tipo,$numDoc){
        $coleccionVentas = $this->getColVentas() ; 
        $colVentasXCliente = [];
        foreach ($coleccionVentas as $unaVenta){
            $cliente = $unaVenta->getObjCliente() ; 
            if ($cliente->getNroDoc() == $numDoc && $cliente->getTipoDoc() == $tipo){
                $colVentasXCliente[] = $unaVenta ; 
            }
        }
        return $colVentasXCliente;
    }


    //METODOS SEGUNDO PARCIAL SIMULACRO 
    
    //recorre la colección de ventas realizadas por la empresa y retorna el
    //importe total de ventas Nacionales realizadas por la empresa
    public function informarSumaVentasNacionales(){
        $colDeVentas = $this->getColVentas(); 
        $importeTotal = 0;
        foreach ($colDeVentas as $unaVenta) { 
            $precio = $unaVenta->retornarTotalVentaNacional();
            $importeTotal = $importeTotal + $precio ;          
        }
        return $importeTotal ; 
    }

    /**recorre la colección de ventas realizadas por la empresa y retorna una
     * colección de ventas de motos importadas. Si en la venta al menos una de
     * las motos es importada la venta debe ser informada */
    //si es importada, la agrego a la coleccion de ventas a retornar 
    public function informarVentasImportadas(){
        $colDeVentas = $this->getColVentas() ; 
        $colMotosImportadas = [];
        foreach ($colDeVentas as $unaVenta){
            $motosVenta = $unaVenta->retornarMotosImportadas(); 
            $countMotosVenta = count($motosVenta); 
            if ($countMotosVenta>0){
                $colMotosImportadas[] = $motosVenta ;
            }
        }
        return $colMotosImportadas;
    }
}