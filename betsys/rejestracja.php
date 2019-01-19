<?php

session_start();

if(isset($_SESSION['zalogowany']) && $_SESSION["zalogowany"] == true)
{
	header("Location: gra.php");
	exit();
}

if (isset($_POST["email"]) || isset($_POST["nick"]) || isset($_POST["haslo1"]) || isset($_POST["haslo2"])) 
{
//Udana walidacja? Załóżmy, że tak!
$wszystko_OK=true;

$nick = $_POST['nick'];	

//SPrawdzenie długości nicka
	if((strlen($nick)<3) || (strlen($nick)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_nick']='Nick musi posiadać od 3 do 20 znaków!';
	}

	if (ctype_alnum($nick)==false) {
		$wszystko_OK=false;
		$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr(bez polskich znaków)";
	}

	//sprawdzenie poprawnosci emaila
	$email=$_POST['email'];
	$emailB =filter_var($email, FILTER_SANITIZE_EMAIL);

	if (filter_var($emailB, FILTER_VALIDATE_EMAIL)==false || $emailB!=$email) {
		$wszystko_OK=false;
		$_SESSION['e_email']="Nieprawidłowy adres e-mail!";
	}

	//Sprawdz poprawnosc hasla
	$haslo1=$_POST['haslo1'];
	$haslo2=$_POST['haslo2'];

	if (strlen($haslo1)<8 || strlen($haslo1)>20) {
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Hasło musi składać się od 8 do 20 znaków!";
	}

	if ($haslo1!=$haslo2) {
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
	}

	$haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
	

	//regulamin
	if(!isset($_POST['regulamin']))	
		{
		$wszystko_OK=false;
		$_SESSION['e_regulamin']="Potwierdz akceptację regulaminu!";
	}

	//captcha
	$secret_key = '6Lcj9w0UAAAAAHt-UQd_2HSnjwD0oRXtfu9-W_mk';

	$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
	$odpowiedz = json_decode($sprawdz);

	if ($odpowiedz->success==false) {
		$wszystko_OK=false;
		$_SESSION['e_captcha']="Potwierdz że nie jesteś botem!";
	}

	require_once "connect.php";

	mysqli_report(MYSQLI_REPORT_STRICT);

	try
	{

		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno!=0) //
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			//czy email juz istnieje
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");

			if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if ($ile_takich_maili>0) {
					$wszystko_OK=false;
					$_SESSION['e_email']="Ten email istnieje już w bazie!";
				}

			//czy nick jest już zarezerwowany
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

			if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if ($ile_takich_nickow>0) {
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już taki nick w bazie!";
				}
			
			if ($wszystko_OK==true) {
			//Wszystkie testy zaliczone
				if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL,'$nick','$haslo_hash','$email',5000,0)")) {
				
					$_SESSION['udanarejestracja']=true;
					header('Location: witaj.php');
				}
				else
				{
					throw new Exception($polaczenie->error);
					
				}
			}

			$polaczenie->close();
		}

	}
	catch(Exception $e)
	{

		echo '<span style="color:red;">Błąd serwera!</span>';
		echo '<br/>Informacja deweloperska'.$e;
	}

}






?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>betsys - system bukmacherski</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
</head>
<body>

	<div class="wrapper">
		<div class="nav">
			
			<!-- <ol>
				<li><a href="#">Home</a></li>
				<li><a href="#">Typy</a></li>
				<li><a href="#">Typerzy</a></li>
				<li><a href="#">Statystyki</a></li>
			</ol> -->
			<div id="menu-container">
				<div id="logo"><b>Betsystem</b></div>
				<div class="option">Home</div>
				<div class="option">Typy</div>
				<div class="option">Typerzy</div>
				<div class="option">Statystyki</div>
				<div class="right-menu">pts</div>
				<div class="right-menu">user</div>
				<div class="right-menu">logout</div>
				<div id="log-in">
					
					<form action="zaloguj.php" method="post">
						<b>Login</b>:<input type="text" name="login"><br/>
						<b>Hasło:</b><input type="password" name="haslo"><br/>
						<input type="submit" value="Zaloguj się" >
						<a  href="rejestracja.php" style="color:white; font-size:11px;">Zarejestruj się</a>
					</form>
						
						<?php
						if(isset($_SESSION['blad']))	{echo $_SESSION['blad'];
							unset($_SESSION['blad']);}
						?>
						
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="content">
		
		<form method="POST">
			
			Nickname:  <br/><input type="text" name="nick"><br/>
			<?php 
				if (isset($_SESSION['e_nick'])) {
					echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
					unset($_SESSION['e_nick']);
				}
			?>
			Email:  <br/><input type="text" name="email"><br/>
			<?php 
				if (isset($_SESSION['e_email'])) {
					echo '<div class="error">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);
				}
			?>
			Hasło:  <br/><input type="password" name="haslo1"><br/>
			<?php 
				if (isset($_SESSION['e_haslo'])) {
					echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
					unset($_SESSION['e_haslo']);
				}
			?>
			Powtórz hasło:  <br/><input type="password" name="haslo2"><br/>
			
			<label>
			<input type="checkbox" name="regulamin"> Akceptuję regulamin
			</label>
			<?php 
				if (isset($_SESSION['e_regulamin'])) {
					echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
					unset($_SESSION['e_regulamin']);
				}
			?>
			
			<div class="g-recaptcha" data-sitekey="6Lcj9w0UAAAAADSZgc34TbSq_X1twx9W3e8l8Wfh"></div><br/>	
			
			<?php 
				if (isset($_SESSION['e_captcha'])) {
					echo '<div class="error">'.$_SESSION['e_captcha'].'</div>';
					unset($_SESSION['e_captcha']);
				}
			?>

			<input type="submit" value="Zarejestruj się">

		</form>

		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>	
		</div>
		<div class="footer">Wszystkie prawa zastrzeżone &copy</div>
	</div>
<script type="text/javascript" src="jquery-3.1.0.min.js"></script>
<script>
	<script src="jquery-1.11.3.min.js"></script>

<script>

$(document).ready(function() {
   var stickyNavTop = $('.nav').offset().top;

   var stickyNav = function(){
   var scrollTop = $(window).scrollTop();

   if (scrollTop > stickyNavTop) { 
      $('.nav').addClass('sticky');
   } else {
      $('.nav').removeClass('sticky');
    }
   };

   stickyNav();

   $(window).scroll(function() {
      stickyNav();
   });
   });

</script>
</script>
</body>
</html>