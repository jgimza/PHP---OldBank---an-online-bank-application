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
            $wynik = $polaczenie->query("CALL WyswietlHistorie(".$_SESSION['id'].")");
            if(!$wynik) throw new Exception($polaczenie->error);
            $licz_operacje = $wynik->num_rows;
            if($licz_operacje > 0) {
                while($rekord = $wynik->fetch_assoc()) {
                  if($rekord['idUzytkownikaOd'] == $_SESSION['id']) {
                      $typ = "wysłany";
                  } else {
                      $typ = "odebrany";
                  }
                  echo '<tr><td>'.$rekord['data'].'</td><td>'.$typ.'</td><td>'.$rekord['opis'].'</td><td>'.$rekord['kwota'].' zł</td></tr>';
                }
                $wynik->free();
            } else {
                echo '<p class="error" style="margin-top:20px">Nie przeprowadziłeś żadnych operacji bankowych.</p>';
            }
            $polaczenie->close();
        }
    }
    catch(Exception $e) {
        echo "Błąd połączenia!";
        echo "Error: ".$e;
    }
?>
