<?php include 'conexion.php';

$p = "1003";
        $puntos = 0;
        $votos = 0;
        $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        mysqli_set_charset($conn, 'utf8');
        $sql = "SELECT PUNTUACION FROM HVALORACION WHERE PUNTO = '$p'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
                $votos = $votos + 1;
                $puntos = $puntos + $row["PUNTUACION"];
                echo $puntos;
            } 
        }
        $conn->close();
        if ($puntos > 0){
            $get_average_points = $puntos / $votos;
        }else{
            $get_average_points = "n/v";    
        }
echo $get_average_points;
        return $get_average_points;