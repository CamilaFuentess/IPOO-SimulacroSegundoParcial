<?php 

include_once 'Cliente.php';
include_once 'Moto.php' ;
include_once 'MotoNacional.php' ; 
include_once 'MotoImportada.php' ; 
include_once 'Venta.php' ; 
include_once 'Empresa.php' ;

//TEST EMPRESA 

// 1. Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2.
$objCliente1 = new Cliente("Juan","Perez",true,"dni",123) ; 
$objCliente2 = new Cliente("Maria","Dominguez",false,"dni",234);          //false es que no esta dado de baja 


// 2. Cree 4 objetos Motos con la información visualizada en las tablas
$objMotoN1 = new MotoNacional(11,2230000,2022,"Benelli Imperiale 400",85,true,10);
$objMotoN2 = new MotoNacional(12,584000,2021,"Zanella Zr 150 Ohc",70,true,10);
$objMotoN3  = new MotoNacional(13,999900,2023,"Zanella Patagonian Eagle 250",55,false);
$objMotoI1 = new MotoImportada(14,12499900,2020,"Pitbike Enduro Motocross Apollo Aiii 190cc Plr",100,true,"Francia",6244400);


// 3. Se crea un objeto Empresa
$colCliente = [$objCliente1,$objCliente2];
$colMotos = [$objMotoN1,$objMotoN2,$objMotoN3,$objMotoI1];
$objEmpresa = new Empresa("Alta Gama","Av Argentina 123",$colMotos , $colCliente,[]);

/** 4. Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa
 * donde el $objCliente es una referencia a la clase Cliente almacenada en la variable
 * $objCliente2 (creada en el punto 1) y la colección de códigos de motos es la siguiente
 *  [11,12,13,14]. Visualizar el resultado obtenido */
$colCodigos = [11,12,13,14];
$importe = $objEmpresa->registrarVenta($colCodigos,$objCliente2);
if ($importe>0){
    echo "Venta exitosa. Total de importe a pagar: " . $importe . "\n";
} else {
    echo "La venta no se pudo realizar.\n";
}

/** 5. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase
 * Empresa donde el $objCliente es una referencia a la clase Cliente almacenada en la
 * variable $objCliente2 (creada en el punto 1) y la colección de códigos de motos es
 *la siguiente [13,14]. Visualizar el resultado obtenido */
$colCodigos = [13,14];
$importe = $objEmpresa->registrarVenta($colCodigos,$objCliente2);
if ($importe>1){
    echo "Venta exitosa. Total de importe a pagar: " . $importe . "\n";
} else {
    echo "La venta no se pudo realizar.\n";
}

/** 6. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase
 * Empresa donde el $objCliente es una referencia a la clase Cliente almacenada en la
 * variable $objCliente2 (creada en el punto 1) y la colección de códigos de motos es
 * la siguiente [14,2]. Visualizar el resultado obtenido. */
$colCodigos = [14,2];
$importe = $objEmpresa->registrarVenta($colCodigos,$objCliente2);
if ($importe>1){
    echo "Venta exitosa. Total de importe a pagar: " . $importe . "\n";
} else {
    echo "La venta no se pudo realizar.\n";
}

// 7. Invocar al método informarVentasImportadas(). Visualizar el resultado obtenido.
$ventasImportadas = $objEmpresa->informarVentasImportadas();
echo "Ventas importadas realizadas: \n";
print_r($ventasImportadas);

// 8. Invocar al método informarSumaVentasNacionales(). Visualizar el resultado obtenido.
$sumaVentasNacionales = $objEmpresa->informarSumaVentasNacionales() ; 
echo "Suma de las ventas de motos nacionales:" . $sumaVentasNacionales . "\n" ;

// 9. Realizar un echo de la variable Empresa creada en 2.
echo $objEmpresa->__toString();
