<html>
<head>
        <meta charset="utf-8">
        <title>Old Bank</title>
        <meta name="description" content="Old Bank is the best bank ...">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&amp;subset=latin-ext" rel="stylesheet">
</head>
<body style="background-color:1b456d; text-align:center;">
<a href="index.php"><p style="width:100%; font-weight: bold; padding:10px; text-color:black; background-color: white;">Wróć na stronę główną</p></a>

<?php
$dbhost = 'localhost';
$dbuser = '15_drozdowski';
$dbpass = 'J1a1h6x4t8';
$dbname = '15_drozdowski';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$conn ) {
die('Bład połączenia z serwerem: ' . mysql_error());
}
mysql_select_db($dbname);


if (isset($_POST['remind'])){
if (mysql_num_rows(mysql_query("SELECT login FROM uzytkownicy WHERE login = '".$_POST['login']."';")) == 1)
{
	if (mysql_num_rows(mysql_query("SELECT login FROM uzytkownicy WHERE login = '".$_POST['login']."' and pesel = '".$_POST['pesel']."';")) == 1)
	{
if ($_POST['haslo1'] == $_POST['haslo2'])
{
	mysql_query("update uzytkownicy set haslo = md5(".$_POST['haslo1'].")
	where login = ".$_POST['login']." and pesel = ".$_POST['pesel']."");

	echo '<span style="color:white; font-size:130%; font-weight: bold; display: inline-block;margin-top:1cm;">Hasło zostało zmienione.</span>';
}
else echo '<span style="color:white; font-size:130%; font-weight: bold; display: inline-block;margin-top:1cm;">Hasła nie są takie same.</span>';
}
else echo '<span style="color:white; font-size:130%; font-weight: bold; display: inline-block;margin-top:1cm;">Podaj poprawny login i pesel.</span>';
}
else echo '<span style="color:white; font-size:130%; font-weight: bold; display: inline-block;margin-top:1cm;">Taki login nie istnieje.</span>';
}


?>


<form method="post" action="reminder.php" style="margin: 0 auto; width:250px; padding-top: 2cm;">
<b style="color:white;">Podaj swój login:</b> <input required type="text" name="login" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Podaj swój pesel:</b> <input required type="text" name="pesel" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Podaj swoje nowe haslo:</b> <input required type="password" name="haslo1" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Powtórz swoje nowe haslo:</b> <input required type="password" name="haslo2" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<input type="submit" value="Zmień hasło" name="remind" style=" padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px; margin: 25 60 80 40;">
</form>


</body>
</html>
