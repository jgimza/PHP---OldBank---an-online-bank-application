<?php
    session_start();
    if(!isset($_SESSION['zalogowany'])) {
        header('Location: index.php');
        exit();
    }

//PRZELEWY
    if(isset($_POST['numer-rachunku'])) {
        // FLAGA
        $poprawnosc = true;

        //Sprawdzenie poprawności nazwy odbiorcy
        $odbiorca = $_POST['nazwa-odbiorcy'];

        if(strlen($odbiorca) > 255) {
            $poprawnosc = false;
            $_SESSION['e_odbiorca'] = 'Nazwa odbiorcy jest zbyt długa (maksymalnie 255 znaków)!';
        }

        //Sprawdzenie poprawności numeru rachunku
        $rachunek = $_POST['numer-rachunku'];

        /*if(strlen($rachunek) != 26) {
          $poprawnosc = false;
          $_SESSION['e_rachunek'] = 'Numer rachunku odbiorcy musi składać się z 26 cyfr!';
        }*/

        //Sprawdzenie poprawności kwoty
        $kwota = $_POST['kwota'];

        if(is_numeric($kwota) == false) {
          $poprawnosc = false;
          $_SESSION['e_kwota'] = 'Podana kwota jest nieprawidłowa!';
        }

        //Sprawdzenie poprawności tytułu przelewu
        $tytul = $_POST['tytul-przelewu'];

        if(strlen($tytul) > 255) {
            $poprawnosc = false;
            $_SESSION['e_tytul'] = 'Tytuł przelewu jest zbyt długi (maksymalnie 255 znaków)!';
        }

        //Sprawdzenie bazy
        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        //Sprawdzenie istnienia numeru rachunku odbiorcy
        try {
            $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
            if($polaczenie->connect_errno!=0) {
                throw new Exception(mysqli_connect_errno());
            } else {
                $wynik = $polaczenie->query("CALL SprawdzRachunek('$rachunek')");

                if(!$wynik) throw new Exception($polaczenie->error);

                $licz_rachunki = $wynik->num_rows;
                if($licz_rachunki == 0) {
                  $poprawnosc = false;
                  $_SESSION['e_rachunek'] = 'Nie istnieje taki numer rachunku bankowego!';
                }
                $polaczenie->close();
            }
        }
        catch(Exception $e) {
            echo "Błąd połączenia!";
            echo "Error: ".$e;
        }

        //Sprawdzenie kwoty
        try {
            $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
            if($polaczenie->connect_errno!=0) {
                throw new Exception(mysqli_connect_errno());
            } else {
                $wynik = $polaczenie->query("CALL SprawdzKwote(".$_SESSION['id'].",$kwota)");

                if(!$wynik) throw new Exception($polaczenie->error);

                $licz_kwote = $wynik->num_rows;
                if($licz_kwote == 0) {
                  $poprawnosc = false;
                  $_SESSION['e_kwota'] = 'Nie masz wystarczającej ilości środków na koncie, aby wykonać ten przelew!';
                }
                $polaczenie->close();
                if($poprawnosc == true) {
                  try {
                      $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
                      if($polaczenie->connect_errno!=0) {
                          throw new Exception(mysqli_connect_errno());
                      } else {
                          $opis = "Od ".$_SESSION['imie']." ".$_SESSION['nazwisko']." do ".$odbiorca.", ".$tytul;
                          if($polaczenie->query("CALL WykonajPrzelew(".$_SESSION['id'].",$kwota,$rachunek,'$opis')")) {
                              $_SESSION['udanyprzelew'] = true;
                              header('Location: przelew.php');
                          } else {
                              throw new Exception($polaczenie->error);
                          }
                          $polaczenie->close();
                      }
                  }
                  catch(Exception $e) {
                      echo "Błąd połączenia!";
                      echo "Error: ".$e;
                }
              }
          }
        }
        catch(Exception $e) {
            echo "Błąd połączenia!";
            echo "Error: ".$e;
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Old Bank</title>
        <meta name="description" content="Old Bank is the best bank ...">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css?<?php echo time(); ?>">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&amp;subset=latin-ext" rel="stylesheet">
    </head>
    <body>
        <!-- HEADER STRONY -->
        <header class="site-header">
        <!-- LOGO STRONY -->
            <div class="wrapper">
                <h1 class="site-logo">
                    <a title="Przejdź do strony głównej" href="index.php">
                        <img src="img/site-logo.png" alt="Old Bank">
                    </a>
                </h1>
        <!-- MENU STRONY -->
                <nav class="site-navigation clearfix">
                    <h2 class="hidden">Nawigacja strony</h2>
                    <ul>
                        <li><a title="Zobacz ofertę banku" href="">Oferta</a></li>
                        <li><a title="Poznaj nas" href="">Grupa Old Bank</a></li>
                        <li><a title="Skontaktuj się z nami" href="">Kontakt</a></li>
                    </ul>
                </nav>
        <!-- PANEL (FORMULARZ) LOGOWANIA/REJESTRACJI -->
                <section class="account-bar logged-in">
                    <h2 class="hidden">Panel użytkownika</h2>
                    <ul>
                        <li class="account-profile"><a title="Zobacz swój profil" href="user-info.php">
                        <?php
                          echo $_SESSION['imie']."<br/>".$_SESSION['nazwisko'];
                        ?>
                        </a></li>
                        <div class="account-options">
                            <li class="account-option" id="account"><a title="Zobacz dane rachunku bankowego" href="#">Konto</a></li>
                            <li class="account-option" id="history"><a title="Zobacz historię operacji" href="#">Historia operacji</a></li>
                            <li class="account-option" id="transfer"><a title="Wykonaj przelew" href="#">Przelew</a></li>
                            <li class="account-option" id="deposit"><a title="Zobacz swoje lokaty" href="#">Lokata</a></li>
                            <li class="account-option"><a title="Wyloguj się" href="wylogowanie.php"><img src="img/logout-icon.png" alt="Przycisk do wylogowania"></a></li>
                        </div>
                    </ul>

                </section>
            </div>
        </header>
        <!-- CZĘŚĆ GŁÓWNA STRONY -->
        <main class="main-content">
        <!-- WYSUWANE OKNA -->
            <section class="account-details">
                 <table>
                     <tr>
                         <th>Stan konta&#58;</th>
                         <th>Numer rachunku bankowego&#58;</th>
                     </tr>
                     <tr>
                         <td>
                            <?php
                                require_once "account-details.php";
                                echo $_SESSION['stankonta'];
                             ?> zł
                         </td>
                         <td>
                            <?php
                                echo $_SESSION['nrrachunku'];
                             ?>
                         </td>
                     </tr>
                 </table>
            </section>
            <section class="operations-history">
                <table class="history-table">
                    <tr><th>Data</th><th>Typ</th><th>Opis</th><th>Kwota</th></tr>
                    <?php
                        require_once "operations-history.php";
                     ?>
                </table>
            </section>
            <section class="bank-transfer wrapper" style="display:block">
                <form class="transfer-form" method="POST" action="accountp.php">
                    <label class="clearfix">Nazwa odbiorcy&#58;<input class="transfer-input" type="text" name="nazwa-odbiorcy" placeholder="np. Adam Kowalski, UPC" required></label>
                    <?php
                        if(isset($_SESSION['e_odbiorca'])) {
                            echo '<p class="error">'.$_SESSION['e_odbiorca'].'</p>';
                            unset($_SESSION['e_odbiorca']);
                        }
                    ?>
                    <label class="clearfix">Numer rachunku&#58;<input class="transfer-input" type="numeric" name="numer-rachunku" placeholder="00 0000 0000 0000 0000 0000 0000" required></label>
                    <?php
                        if(isset($_SESSION['e_rachunek'])) {
                            echo '<p class="error">'.$_SESSION['e_rachunek'].'</p>';
                            unset($_SESSION['e_rachunek']);
                        }
                    ?>
                    <label class="clearfix">Kwota (PLN)&#58;<input class="transfer-input" type="number" min="1" step="0.01" name="kwota" placeholder="0.00" required></label>
                    <?php
                        if(isset($_SESSION['e_kwota'])) {
                            echo '<p class="error">'.$_SESSION['e_kwota'].'</p>';
                            unset($_SESSION['e_kwota']);
                        }
                    ?>
                    <label class="clearfix">Tytuł przelewu&#58;<input class="transfer-input" type="text" name="tytul-przelewu" placeholder="np. Opłata za prąd" required></label>
                    <?php
                        if(isset($_SESSION['e_tytul'])) {
                            echo '<p class="error">'.$_SESSION['e_tytul'].'</p>';
                            unset($_SESSION['e_tytul']);
                        }
                    ?>
                    <input class="transfer-button" type="submit" value="Dalej" name="wykonaj-przelew">
                </form>
            </section>
            <section class="bank-deposit wrapper">
                <table>
                   <tr>
                       <th>Stan lokaty&#58;</th>
                   </tr>
                   <tr>
                       <td>
                          <?php
                              echo $_SESSION['lokata'];
                           ?>
                       </td>
                   </tr>
               </table>
               <form method="POST" action="deposit.php">
                  <label>Wpłać na lokatę:<input class="deposit-input" required maxlength="48" type="number" min="1" step="0.01" placeholder="0.00" name="lokata"></label>
                  <input type="submit" value="Wpłać" name="wplac" class="deposit-button">
               </form>

               <form method="POST" action="depositout.php">
                  <label>Wypłać z lokaty:<input class="deposit-input" required maxlength="48" type="number" min="1" step="0.01" placeholder="0.00" name="lokata2"></label>
                  <input type="submit" value="Wypłać" name="wyplac" class="deposit-button">
               </form>
            </section>
        <!-- SLIDER -->
            <section class="slider clearfix">
        <!-- ARTYKUŁY W SLIDERZE -->
                <h2 class="hidden">Slider</h2>
                <article class="slider-article">
                    <div class="wrapper">
                        <div class="slider-content">
                            <h3 class="slider-headline"><a href="#">Lorem ipsum</a></h3>
                            <p class="slider-lead">Mauris neque augue, interdum sed turpis at, elementum scelerisque lorem. Donec justo leo, luctus id consequat vel, viverra consectetur enim.</p>
                            <a class="read-more-button" href="#">Zobacz więcej</a>
                        </div>
                    </div>
                </article>
                <article class="slider-article hidden">
                    <div class="slider-content">
                        <h3 class="slider-headline"><a title="" href="#">Aliquam sit amet</a></h3>
                        <p class="slider-lead"><a title="" href="#">Mauris neque augue, interdum sed turpis at, elementum scelerisque lorem. Donec justo leo, luctus id consequat vel,viverra consectetur enim.</a></p>
                    </div>
                </article>
                <article class="slider-article hidden">
                    <div class="slider-content">
                        <h3 class="slider-headline"><a title="" href="#">Sed tristique</a></h3>
                        <p class="slider-lead"><a title="" href="#">Mauris neque augue, interdum sed turpis at, elementum scelerisque lorem. Donec justo leo, luctus id consequat vel,viverra consectetur enim.</a></p>
                    </div>
                </article>
        <!-- LISTA ARTYKUŁÓW UMIESZCZONYCH W SLIDERZE -->
                <ul class="slider-bar">
                    <div class="wrapper">
                        <li><a title="" href="#">Lorem ipsum</a></li>
                        <li><a title="" href="#">Lorem ipsum</a></li>
                        <li><a title="" href="#">Lorem ipsum</a></li>
                    </div>
                </ul>
            </section>
        <!-- SEKCJA AKTUALNOŚCI -->
            <section class="news wrapper clearfix">
                <h2 class="news-headline">Aktualności</h2>
        <!-- KAŻDY <ARTICLE> TO NOWA WIADOMOŚĆ -->
                <article class="news-element">
                    <a href="#"><img class="news-image" src="img/articel-image-1.jpg" alt=""></a>
                    <time class="news-date" datetime="2016-12-01">1 grudnia 2016</time>
                    <h3 class="news-title"><a href="#">Aliquam sit amet eros ut mauris porta pulvinar vitae vitae ante</a></h3>
                    <p class="news-lead">Etiam eu purus pharetra, aliquet sem quis, eleifend lectus. Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turpis egestas. Interdum malesuada fames ac ante ipsum primis in faucibus.</p>
                </article>
                <article class="news-element">
                    <a href="#"><img class="news-image" src="img/articel-image-2.jpg" alt=""></a>
                    <time class="news-date" datetime="2016-12-01">1 grudnia 2016</time>
                        <h3 class="news-title"><a href="#">Aliquam sit amet eros ut mauris porta pulvinar vitae vitae ante</a></h3>
                        <p class="news-lead">Etiam eu purus pharetra, aliquet sem quis, eleifend lectus. Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turpis egestas. Interdum malesuada fames ac ante ipsum primis in faucibus.</p>
                </article>
                <article class="news-element">
                    <a href="#"><img class="news-image" src="img/articel-image-3.jpg" alt=""></a>
                    <time class="news-date" datetime="2016-12-01">1 grudnia 2016</time>
                        <h3 class="news-title"><a href="#">Aliquam sit amet eros ut mauris porta pulvinar vitae vitae ante</a></h3>
                        <p class="news-lead">Etiam eu purus pharetra, aliquet sem quis, eleifend lectus. Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turpis egestas. Interdum malesuada fames ac ante ipsum primis in faucibus.</p>
                </article>
            </section>
        </main>
        <!-- STOPKA STRONY -->
        <footer class="site-footer clearfix">
            <h2 class="hidden">Stopka strony</h2>
            <ul class="wrapper">
                <div class="footer-leftside">
                    <li class="law"><a href="#" target="_blank">Polityka prywatności</a></li>
                    <li class="law"><a href="#" target="_blank">Zastrzeżenia prawne</a></li>
                </div>
                <div class="footer-rightside">
                    <li class="copy">Copyright &copy; 2016</li>
                    <li class="social-media"><a href="https://pl-pl.facebook.com/" target="_blank"><img src="img/fb-icon.png" alt="Zobacz nasz profil na Facebooku"></a></li>
                    <li class="social-media"><a href="https://twitter.com/" target="_blank"><img src="img/twitter-icon.png" alt="Zobacz nasz profil na Twitterze"></a></li>
                    <li class="social-media"><a href="https://www.youtube.com/" target="_blank"><img src="img/yt-icon.png" alt="Zobacz nasz profil na YouTube"></a></li>
                </div>
            </ul>
        </footer>
        <!-- JQUERY -->
        <script src="jquery/jquery-3.1.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#account').click(function() {
                    $('.account-details').slideToggle("normal");
                });
                $('#history').click(function() {
                    $('.operations-history').slideToggle("normal");
                });
                $('#transfer').click(function() {
                    $('.bank-transfer').slideToggle("normal");
                });
                $('#deposit').click(function() {
                    $('.bank-deposit').slideToggle("normal");
                });
            });
        </script>
    </body>
</html>
