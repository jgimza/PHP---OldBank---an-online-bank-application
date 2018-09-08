<?php
    session_start();
    if((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
      header('Location: index.php');
      exit();
    }
    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_pass, $db_name);

    if($polaczenie->connect_errno!=0) {
      echo "Błąd połączenia: ".$polaczenie->connect_errno;
    } else {
      $login = $_POST['login'];
      $haslo = md5($_POST['haslo']);

      $login = htmlentities($login, ENT_QUOTES, "UTF-8");
      $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

      if($wynik = @$polaczenie->query(
        sprintf("CALL Zaloguj('%s', '%s')",
        mysqli_real_escape_string($polaczenie,$login),
        mysqli_real_escape_string($polaczenie,$haslo)))) {
        $licz_userow = $wynik->num_rows;
        if($licz_userow > 0) {
          $_SESSION['zalogowany']=true;
          $rekord = $wynik->fetch_assoc();

          $_SESSION['id'] = $rekord['idUzytkownika'];
          $_SESSION['imie'] = $rekord['imie'];
          $_SESSION['nazwisko'] = $rekord['nazwisko'];
          $_SESSION['durodzenia'] = $rekord['dataUrodzenia'];
          $_SESSION['pesel'] = $rekord['pesel'];
          $_SESSION['telefon'] = $rekord['nrTelefonu'];
          $_SESSION['mail'] = $rekord['email'];
          $_SESSION['miejscowosc'] = $rekord['miejscowosc'];
          $_SESSION['ulica'] = $rekord['ulica'];
          $_SESSION['budynek'] = $rekord['nrBudynku'];
          $_SESSION['lokal'] = $rekord['nrLokalu'];

          unset($_SESSION['blad']);
          $wynik->free();
          header('Location: account.php');
        } else {
          $_SESSION['blad'] = '<p class="error log">Niepoprawny login lub hasło! <a href="reminder.php">Nie pamiętasz hasła?</a></p>';
          header('Location: index.php');
        }
      }
      $polaczenie->close();
    }
?>
