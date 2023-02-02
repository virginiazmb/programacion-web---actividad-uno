
<?php

include "empleados.php";
$_SESSION['listadedatosEmp'] = array();

session_start();

if (isset($_POST['btn'])){
    if(isset($_POST['nombre']) && !empty ($_POST['nombre']) && isset($_POST['apellido']) && !empty ($_POST['apellido']) && isset($_POST['edad']) && !empty ($_POST['edad']) && isset($_POST['gen']) && !empty ($_POST['gen']) && isset($_POST['civil']) && !empty ($_POST['civil']) && isset($_POST['sueldo']) && !empty ($_POST['sueldo'])){
        

        $empleadoval = new empleadodatos();

        $empleadoval->setNombre($_POST['nombre']);
        $empleadoval->setApellido($_POST['apellido']);
        $empleadoval->setEdad($_POST['edad']);
        $empleadoval->setGenero($_POST['gen']);
        $empleadoval->setEstadoCivil($_POST['civil']);
        $empleadoval->setSueldo($_POST['sueldo']);
        echo "<br>";
        echo "<br>";

            array_push($_SESSION['listadedatosEmp'], $empleadoval);

        echo "<h2 style='font-family: Gill Sans MT'>Listas a determinar: </h2>";
        listas();
    } else{
        echo "No funciona";
    }
}


function listas(){

    $viudo = 0;
    $casado = 0;
    $femenino = 0;
    $promedio = 0;
    $total = 0;
    $edad = 0;

    $init = count($_SESSION['listadedatosEmp']);

    if(isset($_SESSION['listadedatosEmp'])){
        for($i=0; $i<$init; $i++){
            if ($_SESSION['listadedatosEmp'][$i]->getGenero() == "Femenino") {
                $femenino ++;
            } 
        }
        echo "<br>";
        echo "Total de empleados femeninos: ". $femenino;
    }


    if(isset($_SESSION['listadedatosEmp'])){
        for($i=0; $i<$init; $i++){
            if ($_SESSION['listadedatosEmp'][$i]->getGenero() == "Masculino" && $_SESSION['listadedatosEmp'][$i]->getEstadoCivil() == 'Casado(a)' && $_SESSION['listadedatosEmp'][$i]->getSueldo() == 'mas de 2500') {
                $casado ++;
            } 
        }
        echo "<br>";
        echo "Total de hombres casados que ganan mas de 2500: ". $casado;
    }

    //total de mujeres viudas que ganan mas de 1000bs

    if(isset($_SESSION['listadedatosEmp'])){
        for($i=0; $i<$init; $i++){
            if ($_SESSION['listadedatosEmp'][$i]->getGenero() == "Femenino" && $_SESSION['listadedatosEmp'][$i]->getEstadoCivil() == 'Viudo(a)' && $_SESSION['listadedatosEmp'][$i]->getSueldo() == 'entre 1000 y 2500') {
                $viudo ++;
            } 
        }
        echo "<br>";
        echo "Total de mujeres viudas que ganan mas de 1000: ". $viudo;
    }

    // edad promedio de hombres
    if(isset($_SESSION['listadedatosEmp'])){
        for($i=0; $i<$init; $i++){
            if ($_SESSION['listadedatosEmp'][$i]->getGenero() == "Masculino") {
                $edad += $_SESSION['listadedatosEmp'][$i]->getEdad();
                $total++;
            }
        }

        $promedio = $edad/$total;
        echo "<br>";
        echo "Edad promedio de hombres: ". $promedio;
        
    }

}





?>


