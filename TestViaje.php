<?php

include 'Viaje.php';

echo "Bienvenidos/as a Viaje Feliz \n";
echo "Ingrese el codigo de viaje: ";
$codigo = trim(fgets(STDIN));
echo "Ingrese el destino del viaje: ";
$destino = trim(fgets(STDIN));
echo "Capacidad maxima de pasajeros: ";
$capacidadMaxima = trim(fgets(STDIN));
echo "Ingrese la cantidad de pasajeros que va a cargar: ";
$cantPasajeros = trim(fgets(STDIN));



if ($cantPasajeros <= $capacidadMaxima) {
    $pasajeros = informacionPasajeros($cantPasajeros);
    //Creo el objViaje, que es una nueva instancia de la clase Viaje
    $objViaje = new Viaje($codigo, $destino, $capacidadMaxima, $pasajeros);

    if ($capacidadMaxima < $cantPasajeros ) {
        echo "Quedan lugares disponibles. \n";
        do {
            $agregarPasajero = false; 
            
            echo "¿Quiere agregar a un nuevo pasajero/a? (si/no): \n";
            $respuesta = trim(fgets(STDIN));
            if ($respuesta == 'si') {
                $capacidadLimite = $objViaje->cantLugaresDisponibles();
                // echo $capacidadLimite;
                if ($capacidadLimite >= $cantPasajeros) {
                    echo "Quedan ".$capacidadLimite. " asientos disponibles. Cuantos pasajeros va a agregar?: ";
                    $cantNuevosPasajeros = trim(fgets(STDIN));
                    //$nuevaCantPasajeros va a guardar la cantidad actualizada de pasajeros
                    $nuevaCantPasajeros = $cantPasajeros + $cantNuevosPasajeros;
                    if ($nuevaCantPasajeros <= $capacidadMaxima) {
                        $nuevosPasajero = informacionPasajeros($cantNuevosPasajeros);
                        $objViaje-> agregarPasajero($nuevosPasajero);
                        $agregarPasajero = true;
                        echo "Datos guardados con exito. \n";
                    }else {
                        echo "No se puede agregar. Solo hay " . $capacidadLimite . " asiento/s disponibles \n";
                    }
                }else {
                    echo "No hay mas lugar en el viaje. \n";
                } 
            }
        } while ($agregarPasajero);
        echo "Viaje creado con exito. \n";
    }
    echo "Viaje creado con exito. \n";
}
else{
echo "No es posible guardar los datos del Viaje. La cantidad de pasajeros, supera el maximo. \n";
}


/**
 * Funcion del menu de opciones
 * @return Int
 */
function menu(){
    echo "Menu de opciones: \n
    1) Ver viaje 
    2) Ver codigo del viaje 
    3) Modificar codigo de viaje
    4) Ver el destino del viaje
    5) Modificar el destino del viaje
    6) Modificar datos de un pasajero
    7) Modificar capacidad maxima
    8) Salir \n";
    echo "Ingrese una opcion entre 1 y 8: ";
    $opcion = trim(fgets(STDIN));

    return $opcion;
}




/**
 * Funcion que va a almacenar la informacion de los pasajeros
 * @param Int $cantidad
 * @return Aray
 */
function informacionPasajeros($cantidad){
    //arrayPersonas: arreglo asociativo que va a guardar, nombre, apellido y dni. Estas son las claves
    $arrayPersonas = [];
    for ($i=0; $i < $cantidad; $i++) { 
        echo "Ingrese los datos del pasajero/a: \n " ;
        echo "Nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Dni: ";
        $dni = trim(fgets(STDIN));

        //Almaceno los datos de las personas
        $arrayPersonas[$i] = ['nombre' => $nombre, 'apellido' => $apellido, 'dni' =>$dni];
        
    }
    return $arrayPersonas;
}

/**
 * Funcion que busca a un pasajero, para luego modificarlo
 * @return array
 */
function pasajero(){
    echo "Nombre del pasajero: ";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellidoPasajero = trim(fgets(STDIN));
    echo "DNI: ";
    $dniPasajero = trim(fgets(STDIN));
    $arrayPasajero = [];
    $arrayPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'dni' => $dniPasajero];
    return $arrayPasajero;
}


// ************ PROGRAMA PRINCIPAL ************
do {

    $opcionSeleccionada = menu();
    switch ($opcionSeleccionada) {
        case '1':
            //Ver viaje
            echo "Los datos del viaje son: \n";
            echo $objViaje;
            break;
        case '2':
            // Ver codigo del viaje
            echo "El codigo del viaje es: ";
            echo $objViaje -> getCodigoViaje();

            break;
        case '3':
            // Modificar codigo de viaje \n
            echo "Ingrese el nuevo codigo del viaje: ";
            $nuevoCodigo = trim(fgets(STDIN));
            $objViaje->setCodigoViaje($nuevoCodigo);
            echo "Cambio realizado con exito. \n 
            Ahora el codigo es: ". $nuevoCodigo;
            break;
        case '4':
            //Ver el destino del viaje
            echo "El destino del viaje es: ";
            echo $objViaje->getDestino();
            break;
        case '5':
            //Modificar el destino del viaje
            echo "Ingrese el nuevo destino del viaje: ";
            $nuevoDestino = trim(fgets(STDIN));
            $objViaje-> setDestino($nuevoDestino);
            echo "Cambio exitoso. \n 
            Ahora el destino de viaje es: " . $nuevoDestino. "\n";
            break;
        case '6':
            //Modificar datos de un pasajero
            echo "Ingrese el DNI del pasajero que quiere modificar: ";
            $dni = trim(fgets(STDIN));
            $indice = $objViaje->buscarIndicePasajero($dni);
            if ($indice == -1) {
                echo "El dni no se encuentra registrado.\n";
            }else {
                $pasajeroModif = $objViaje->getArrayPasajeros($indice);
                echo "Ingrese el nuevo Nombre: ";
                $nuevoNombre = trim(fgets(STDIN));
                echo "Ingrese el nuevo apellido: ";
                $nuevoApellido = trim(fgets(STDIN));
                $pasajeroModif = $objViaje->modificarDatosPasajeros($indice, $nuevoNombre, $nuevoApellido);
                echo "Datos modificados con exito. \n";
            }
            
            break;
        case '7':
            //Modificar capacidad maxima
            echo "Ingrese la nueva capacidad Maxima: ";
            $nuevaCapMax = trim(fgets(STDIN));
            $objViaje->setCantMaxPasajeros($nuevaCapMax);
            echo "La nueva capacidad maxima es: ". $nuevaCapMax . "\n";
            break;
        default:
            # code...
            break;
    }
    
} while ($opcionSeleccionada != 8);

?>