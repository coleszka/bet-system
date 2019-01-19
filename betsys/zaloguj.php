<?php

	require_once "connect.php"; //include=wlacz plik do zrodla, require= wymagaj pliku w kodzie, once=wyskoczy blad jak uzyjesz dwa razy

	session_start();
	if(!isset($_POST['login']) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}


	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0) //polaczenie - obiekt, connect_errno - wlasciwosc
	{
		echo "Error: ".$polaczenie->connect_errno."Opis: ".$polaczenie->connect_error;
	}
	else
	{

		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		

		
	
	
	if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM uzytkownicy, bets WHERE user='%s'", mysqli_real_escape_string($polaczenie,$login))))
	{
		$ilu_userow = $rezultat->num_rows;
			if ($ilu_userow>0) 
			{

				$wiersz = $rezultat->fetch_assoc();
				if (password_verify($haslo, $wiersz['pass'])) {
					
					
					
					$_SESSION['zalogowany'] = true;
					
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['user'] = $wiersz['user'];
					$_SESSION['points'] = $wiersz['points'];
					$_SESSION['drewno'] = $wiersz['drewno'];
					$_SESSION['kamien'] = $wiersz['kamien'];
					$_SESSION['zboze'] = $wiersz['zboze'];
					$_SESSION['email'] = $wiersz['email'];
					$_SESSION['dnipremium'] = $wiersz['dnipremium'];
					$_SESSION['perm'] = $wiersz['perm'];
					$_SESSION['create_kupon'] = false;
					$_SESSION['liczba']=0;

					

					//unset($_SESSION['blad']);
					$rezultat->free_result();

					header('Location: gra.php');
				}
				else
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
				}
			else
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}



	}
		$polaczenie->close();
	
	}

		


?>