<?php
    session_start();
    if(!isset($_SESSION['zalogowany'])) {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
        if($polaczenie->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $wynik = $polaczenie->query("CALL WyswietlKonto(".$_SESSION['id'].")");
            if(!$wynik) throw new Exception($polaczenie->error);
            $licz_konta = $wynik->num_rows;
            if($licz_konta > 0) {
                $rekord = $wynik->fetch_assoc();
                $_SESSION['stankonta'] = $rekord['stanKonta'];
                $_SESSION['nrrachunku'] = $rekord['nrRachunku'];
                $_SESSION['lokata'] = $rekord['lokata'];
                $wynik->free();
            }
            $polaczenie->close();
        }
    }
    catch(Exception $e) {
        echo "Błąd połączenia!";
        echo "Error: ".$e;
    }
?>
