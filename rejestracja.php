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

function filtruj($zmienna)
{
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna);

    return mysql_real_escape_string(htmlspecialchars(trim($zmienna)));
}

if (isset($_POST['rejestruj']))
{
	$imie = filtruj($_POST['imie']);
	$nazwisko = filtruj($_POST['nazwisko']);
	$dataUrodzenia = filtruj($_POST['dataUrodzenia']);
	$pesel = filtruj($_POST['pesel']);
	$nrTelefonu = filtruj($_POST['nrTelefonu']);
	$email = filtruj($_POST['email']);
	$miejscowosc = filtruj($_POST['miejscowosc']);
	$kodPocztowy = filtruj($_POST['kodPocztowy']);
	$ulica = filtruj($_POST['ulica']);
	$nrBudynku = filtruj($_POST['nrBudynku']);
	$nrLokalu = filtruj($_POST['nrLokalu']);
	$haslo1 = filtruj($_POST['haslo1']);
	$haslo2 = filtruj($_POST['haslo2']);

    $ile_pytan = 9;
    $ile_wylosowac = 6;
    $ile_juz_wylosowano=0;
    for ($i=1; $i<=$ile_wylosowac; $i++)
    {
		do
		{
				$liczba=rand(0,$ile_pytan);
				$losowanie_ok=true;
			if ($losowanie_ok==true)
			{
				$ile_juz_wylosowano++;
				$wylosowane[$ile_juz_wylosowano]=$liczba;
			}
		} while($losowanie_ok!=true);
    }
	echo "<br>";
	echo "<span style='color:white;'>Twój login to:</span>";
	echo "<br>";
    for ($i=1; $i<=$ile_wylosowac; $i++)
    {
		echo "<span style='color:white;'>".$wylosowane[$i]."</span>";
	}
	echo "<br>";
	echo "<span style='color:white;'>Zapisz go w bezpiecznym miejscu i zachowaj, login zostanie wyświetlony tylko raz!</span>";
	echo "<br>";
	$w=$wylosowane[1].$wylosowane[2].$wylosowane[3].$wylosowane[4].$wylosowane[5].$wylosowane[6];


	if (mysql_num_rows(mysql_query("SELECT login FROM uzytkownicy WHERE login = '".$w."';")) == 0)
	{
		if ($haslo1 == $haslo2)
		{
			mysql_query("INSERT INTO `uzytkownicy` (`imie`, `nazwisko`, `dataUrodzenia`, `pesel`, `nrTelefonu`, `email`, `miejscowosc`, `kodPocztowy`, `ulica`, `nrBudynku`, `nrLokalu`, `login`, `haslo`)
				VALUES ('".$imie."', '".$nazwisko."', '".$dataUrodzenia."','".$pesel."', '".$nrTelefonu."', '".$email."', '".$miejscowosc."', '".$kodPocztowy."', '".$ulica."', '".$nrBudynku."', '".$nrLokalu."', '".$w."', '".md5($haslo1)."');");

				    $ile_pytan = 9;
					$ile_wylosowac = 26;
					$ile_juz_wylosowano=0;
					for ($i=1; $i<=$ile_wylosowac; $i++)
					{
					do
					{
					$liczba=rand(0,$ile_pytan);
					$losowanie_ok=true;
					if ($losowanie_ok==true)
					{
					$ile_juz_wylosowano++;
					$wylosowane[$ile_juz_wylosowano]=$liczba;
					}
					} while($losowanie_ok!=true);
					}
					$r=$wylosowane[1].$wylosowane[2].$wylosowane[3].$wylosowane[4].$wylosowane[5].$wylosowane[6].$wylosowane[7].$wylosowane[8].$wylosowane[9].$wylosowane[10].$wylosowane[11].$wylosowane[12]
					.$wylosowane[13].$wylosowane[14].$wylosowane[15].$wylosowane[16].$wylosowane[17].$wylosowane[18].$wylosowane[19].$wylosowane[20].$wylosowane[21].$wylosowane[22].$wylosowane[23].$wylosowane[24]
					.$wylosowane[25].$wylosowane[26];

					$iduz = mysql_query("SELECT max(idUzytkownika) FROM uzytkownicy");
					$result = mysql_fetch_array($iduz);
					foreach($result as $value);

			mysql_query("INSERT INTO `konta` (`idUzytkownika`,`nrRachunku`,`stanKonta`, `lokata`)
				VALUES ('".$value."', '".$r."', '1000', '0')");
			echo '<span style="color:white; font-size:130%; font-weight: bold; display: inline-block; margin-top:1cm;">Konto zostało utworzone.</span>';
		}
		else echo '<span style="color:white; font-size:130%; font-weight: bold; display: inline-block;margin-top:1cm;">Hasła nie są takie same.</span>';
	}
	else echo '<span style="color:white; font-size:130%; font-weight: bold; display: inline-block;margin-top:1cm;">Podany login jest już zajęty.</span>';
}
?>

<form method="POST" action="rejestracja.php" style="margin: 0 auto; width:250px; padding-top: 2cm;">
<b style="color:white;">Imię:</b> <input required maxlength="48" type="text" name="imie" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Nazwisko:</b> <input required maxlength="48" type="text" name="nazwisko" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Data urodzenia:</b> <input required type="date" name="dataUrodzenia" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Pesel:</b> <input required minlength="11" maxlength="11" type="text" name="pesel" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Numer telefonu:</b> <input required minlength="9" maxlength="9" type="text" name="nrTelefonu" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Email:</b> <input required maxlength="255" type="text" name="email" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Miejscowość:</b> <input required maxlength="48" type="text" name="miejscowosc" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Kod pocztowy:</b> <input required minlength="5" maxlength="5" type="text" name="kodPocztowy" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Ulica:</b> <input required maxlength="255" type="text" name="ulica" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Numer budynku:</b> <input required maxlength="5" type="text" name="nrBudynku" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Numer lokalu:</b> <input required maxlength="5" type="text" name="nrLokalu" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Hasło:</b> <input required minlength="6" maxlength="255" type="password" name="haslo1" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<b style="color:white;">Powtórz hasło:</b> <input required type="password" name="haslo2" style="width: 100%; padding:12px 20px; margin: 8px 0;box-sizing: border-box; "><br><br>
<input type="submit" value="Utwórz konto" name="rejestruj" style=" padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px; margin: 25 60 80 40;">
<a href="http://wierzba.wzks.uj.edu.pl/~15_gimza/OldBank"><p style="float:left;font-weight: bold; text-color:black; background-color: white; padding:10px;">Wróć na stronę główną</p></a>

</form>
</body>
</html>
