<?php
    session_start();
    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) {
        header('Location: account.php');
        exit();
    }
?>

<!DOCTYPE html>
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
                <section class="account-bar clearfix">
                    <h2 class="hidden">Panel użytkownika</h2>
                    <form class="log-in-form clearfix" method="POST" action="logowanie.php">
                        <input class="log-in-input" type="text" name="login" placeholder="login" required>
                        <input class="log-in-input" type="password" name="haslo" placeholder="haslo" required>
                        <input class="log-in-button" type="submit" value="Zaloguj" name="zaloguj">
                    </form>
                    <a class="sign-up-button" href="rejestracja.php">Zarejestruj sie</a>
                    <?php if(isset($_SESSION['blad'])) echo $_SESSION['blad']; unset($_SESSION['blad']); ?>
                </section>
            </div>
        </header>
        <!-- CZĘŚĆ GŁÓWNA STRONY -->
        <main class="main-content">
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
    </body>
</html>
