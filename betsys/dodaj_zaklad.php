<?php

session_start();
if(!isset($_SESSION['zalogowany']) && $_SESSION['perm']==1)
{
	header('Location: index.php');
	exit();
}

if (isset($_POST["dodaj_dysc"]) || isset($_POST["dodaj_home"]) || isset($_POST["dodaj_away"]) || isset($_POST["dodaj_data"]) || isset($_POST["dodaj_time"]) || isset($_POST["dodaj_1"]) || isset($_POST["dodaj_x"]) || isset($_POST["dodaj_2"])) 
{
//Udana walidacja? Załóżmy, że tak!
$wszystko_OK=true;

$dodaj_time = $_POST['dodaj_time'];
$dodaj_data = $_POST['dodaj_data'];
$dodaj_x = $_POST['dodaj_x'];
$dodaj_2 = $_POST['dodaj_2'];

$dodaj_dysc = $_POST['dodaj_dysc']; 


  if((strlen($dodaj_dysc)<3) || (strlen($dodaj_dysc)>20))
  {
    $wszystko_OK=false;
    $_SESSION['e_dodaj_dysc']='Dyscyplina musi posiadać od 3 do 20 znaków!';
  }

$dodaj_home = $_POST['dodaj_home']; 
  if((strlen($dodaj_home)<3) || (strlen($dodaj_home)>20))
  {
    $wszystko_OK=false;
    $_SESSION['e_dodaj_home']='Gospodarz musi posiadać od 3 do 20 znaków!';
  }

$dodaj_away = $_POST['dodaj_away']; 
  if((strlen($dodaj_away)<3) || (strlen($dodaj_away)>20))
  {
    $wszystko_OK=false;
    $_SESSION['e_dodaj_away']='Gość musi posiadać od 3 do 20 znaków!';
  }
 $min_kurs=1;
 $dodaj_1 = $_POST['dodaj_1']; 
  if($dodaj_1 < $min_kurs)
  {
    $wszystko_OK=false;
    $_SESSION['e_dodaj_1']='Kurs musi być wyższy niż 1.0!';
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
     
      if ($wszystko_OK==true) {
      //Wszystkie testy zaliczone
        if ($polaczenie->query("INSERT INTO bets(id,sport,player1,player2,start_time,date,odd_1,odd_x,odd_2) VALUES (NULL,'$dodaj_dysc','$dodaj_home','$dodaj_away','$dodaj_time','$dodaj_data','$dodaj_1','$dodaj_x','$dodaj_2')")) {
        
          $_SESSION['dodanie']=true;
          header('Location: dodaj_zaklad.php');
        }
        else
        {
          throw new Exception($polaczenie->error);
          
        }
      }

      $polaczenie->close();
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
				<ol>
    <li class="option">Dodaj zakład
      <ul>
        <li><a href="dodaj_zaklad.php">Dodaj zakład</a></li>
        
      </ul>
    </li>

    <li class="option">Dodaj wynik
      <ul>
        <li><a href="dodaj_wynik.php">Dodaj wynik</a></li>
        
      </ul>
    </li>
  </ol>
				<div id="log-in">
					
					<form action="logout.php" method="post">
						<!-- <b>Login</b>:<input type="text" name="login"><br/>
						<b>Hasło:</b><input type="password" name="haslo"><br/> -->
						<input type="submit" value="Wyloguj" >
					</form>

				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="content">
		
		<div style="color:black;font-size: 16px;width:900px; margin-left:100px;">
    
    <form method="POST">
      
      Dyscyplina:  <input type="text" name="dodaj_dysc"><br/>
      <?php 
        if (isset($_SESSION['e_dodaj_dysc'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_dysc'].'</div>';
          unset($_SESSION['e_dodaj_dysc']);
        }
      ?>

      Gospodarz:  <input type="text" name="dodaj_home">
      <?php 
        if (isset($_SESSION['e_dodaj_home'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_home'].'</div>';
          unset($_SESSION['e_dodaj_home']);
        }
      ?>

      Gość:  <input type="text" name="dodaj_away"><br/>
      <?php 
        if (isset($_SESSION['e_dodaj_away'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_away'].'</div>';
          unset($_SESSION['e_dodaj_away']);
        }
      ?>

      Data(1980-01-01):  <input type="date" name="dodaj_data">
      <?php 
        if (isset($_SESSION['e_dodaj_data'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_data'].'</div>';
          unset($_SESSION['e_dodaj_data']);
        }
      ?>
      
      Czas(12:00:00):  <input type="time" name="dodaj_time"><br/>
      <?php 
        if (isset($_SESSION['e_dodaj_time'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_time'].'</div>';
          unset($_SESSION['e_dodaj_time']);
        }
      ?>

      Kurs 1:  <input type="text" name="dodaj_1">
      <?php 
        if (isset($_SESSION['e_dodaj_1'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_1'].'</div>';
          unset($_SESSION['e_dodaj_1']);
        }
      ?>

      Kurs X:  <input type="text" name="dodaj_x">
      <?php 
        if (isset($_SESSION['e_dodaj_x'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_x'].'</div>';
          unset($_SESSION['e_dodaj_x']);
        }
      ?>

      Kurs 2:  <input type="text" name="dodaj_2"><br/>
      <?php 
        if (isset($_SESSION['e_dodaj_2'])) {
          echo '<div class="error">'.$_SESSION['e_dodaj_2'].'</div>';
          unset($_SESSION['e_dodaj_2']);
        }
      ?>
      

      <input type="submit" value="Dodaj zakład">
	
    </form>
<br/>
    <p class="error">Sprawdź poprawność wprowadzonych danych!</p>
    <?php

    if (isset($_SESSION['dodanie'])) {
    	echo "Dodano zakład!";
    	unset($_SESSION['dodanie']);
    }


    ?>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
		
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