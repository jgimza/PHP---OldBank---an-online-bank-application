<?php
    session_start();
    if(!isset($_SESSION['udanalokata'])) {
        header('Location: index.php');
        exit();
    } else {
        unset($_SESSION['udanalokata']);
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
      <div class="completed">
        <img src="img/check.png" alt=""><p class="transaction-completed">Pieniądze zostały wpłacone na lokatę!</p>
        <a class="home-return" href="account.php">Wróć na stronę główną</a>
      </div>
    </body>
</html>
