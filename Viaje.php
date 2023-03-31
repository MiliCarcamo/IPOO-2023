<?php

/**
 * La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. 
 * De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

 * Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase 
 * (incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros. Cada 
 * pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.

 * Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la 
 * información del viaje, modificar y ver sus datos.
 */


class Viaje{
    //Atributos
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $arrayPasajeros;

    //Metodo constructor
    public function __construct($codigoViaje, $destino, $cantMaxPasajeros, $arrayPasajeros){
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->arrayPasajeros = $arrayPasajeros ;
    }

    //Metodos Get
    public function getCodigoViaje(){
        return $this->codigoViaje;
    } 

    public function getDestino(){
        return $this->destino;
    }

    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function getArrayPasajeros(){
        return $this->arrayPasajeros;
    }

    //Metodos Set
    public function setCodigoViaje($codigoViaje){
        $this->codigoViaje = $codigoViaje;
    }

    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    public function setArrayPasajeros($arrayPasajeros){
        $this->arrayPasajeros = $arrayPasajeros;
    }

    //***************** FUNCIONES *****************

    /**
     * Funcion para agregar pasajeros
     * @param Array $nuevoPasajero
     * @return Array 
     */
    public function agregarPasajero($nuevoPasajero){
        $arrayPasajeros = [];
        $arrayPasajeros = $this->getArrayPasajeros();
        //arra_push inserta uno o mas elementos al final de un array
        array_push($arrayPasajeros, $nuevoPasajero);
        $this->setArrayPasajeros($arrayPasajeros);
    }

    /**
     * Busca la posicion del dni del pasajero
     * @param Int $dni
     * @return Int
     */
    public function buscarIndicePasajero($dni){
        $i=0;
        $indice = -1;
        $bandera = true;
        while ($i < count($this->arrayPasajeros) && $bandera) {
            if ($this->arrayPasajeros[$i]['dni'] == $dni) {
                $indice = $i;
                $bandera = false;
            }
            $i++;
        }
        return $indice;
    }

    /**
     * Modifica los datos de los pasajeros
     * @param Int $indice
     * @param Array $arrayPasajeros
     * @return Array 
     */
    public function modificarDatosPasajeros($indice, $nombreNuevo, $apellidoNuevo ){
        $unPasajero = $this->getArrayPasajeros();
        $unPasajero = $this->arrayPasajeros[$indice]['nombre'] = $nombreNuevo;
        $unPasajero = $this->arrayPasajeros[$indice]['apellido'] = $apellidoNuevo;
        $this->setArrayPasajeros($unPasajero);
    }


    /**
     * Metodo que muestra la cantidad de lugares disponibles
     * @return Int
     */
    public function cantLugaresDisponibles(){
        $lugarDisponible = $this->getCantMaxPasajeros() - count($this->arrayPasajeros);
        return $lugarDisponible;
    }


    //Metodo toString
    public function __toString()
    {
        $viaje = $this->getDestino();
        $codigo = $this->getCodigoViaje();
        $capacidadViaje = $this->getCantMaxPasajeros();
        $totalPasajeros = $this->getArrayPasajeros();
        $cadena = "El codigo de viaje es: " . $codigo . "\n".
        "El destino es del viaje es: " . $viaje . "\n" . 
        "La capacidad maxima de pasajeros es: " . $capacidadViaje . "\n" .
        "La cantidad de pasajeros a bordo es: " . count($totalPasajeros) . "\n" ;
        
        return $cadena;
    }


}

?>