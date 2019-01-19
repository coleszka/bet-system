
<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
	header("Location: gra.php");
	exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>betsys - system bukmacherski</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<style type="text/css">
		table {
  text-align: left;
  line-height: 40px;
  border-collapse: separate;
  border-spacing: 0;
  border: 2px solid #06C20F;
  width: 900px;
  margin: 50px auto;
  border-radius: .25rem;
}

thead tr:first-child {
  background: #06C20F;
  color: #fff;
  border: none;
}

th:first-child, td:first-child { padding: 0 15px 0 20px; }

thead tr:last-child th { border-bottom: 3px solid #ddd; }

tbody tr:hover { background-color: rgba(23,282,64,.1); cursor: default; }
tbody tr:last-child td { border: none; }
tbody td { border-bottom: 1px solid #ddd; }

td:last-child {
  text-align: right;
  padding-right: 10px;
}


	</style>

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
    <li class="option">Zakłady
      <ul>
        <li><a href="zaklady.php">Zakłady</a></li>
        
      </ul>
    </li>

    <li class="option">Moje kupony
      <ul>
        <li><a href="moje_kupony.php">Moje kupony</a></li>
        
      </ul>
    </li>

    

    <li class="option">Statystyki
      <ul>
        <li><a href="naj_wygrane_kupony.php">Najwyższe wygrane kupony</a></li>
        <li><a href="najdluzsze_wygrane_kupony.php">Najdłuższe wygrane kupony</a></li>
        <li><a href="popularne_zaklady.php">Najpopularniejsze zakłady</a></li>
        <li><a href="statystyki_typowania.php">Satystyki typowania</a></li>
        <li><a href="podsumowanie_miesiaca.php">Podsumowanie miesiąca</a></li>
        <li><a href="ranking_graczy.php">Ranking graczy</a></li>
      </ul>
    </li>
  </ol>
				<div class="right-menu"><?php echo $_SESSION['points'].' pkt'; ?></div>
				<div class="right-menu"><?php echo $_SESSION['user']; ?></div>
				<div id="log-in">
					
					<b>Jesteś zalogowany!</b>
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
		
	

<?php
require_once "connect.php"; 
			
			
			$today=date("m");
			

			$conn = @new mysqli($host, $db_user, $db_password, $db_name);
			mysqli_query($conn, "SET CHARSET utf8");
			mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			$query_stat = $conn->query("SELECT COUNT(id_user), data_dodania FROM postawione_kupony WHERE id_user='{$_SESSION['id']}' AND data_dodania BETWEEN '2017-".$today."-01' AND '2017-".$today."-30'");  /*WHERE date='$today'*/
					
			$stat = $query_stat->fetch_assoc();
			$liczba_k = $stat['COUNT(id_user)'];

			$rows_zaklady=0;
			$wygrana=0;
			$przegrana=0;
			$l_zwer_kup=0;
			$l_w_k=0;
			$l_p_k=0;
			$query_moje_kupony = $conn->query("SELECT id_user, numer_kuponu, wygrana, wynik, data_dodania FROM postawione_kupony WHERE postawione_kupony.id_user='{$_SESSION['id']}' AND data_dodania BETWEEN '2017-".$today."-01' AND '2017-".$today."-30'"); 
			$rows = $query_moje_kupony->num_rows;
					

					for ($i=0; $i < $rows ; $i++) { 
						
						$moje_kupony = $query_moje_kupony->fetch_assoc();
						$numer_kuponu = $moje_kupony['numer_kuponu'];
						$wynik = $moje_kupony['wynik'];

						if ($wynik=='W') {
							$wygrana+=$moje_kupony['wygrana'];
							$l_zwer_kup++;
							$l_w_k++;
						}
						if ($wynik=='L') {
							$przegrana+=$moje_kupony['wygrana'];
							$l_zwer_kup++;
							$l_p_k++;
						}
						

						$query_moje_zaklady = $conn->query("SELECT numer_kuponu FROM postawione_zaklady WHERE postawione_zaklady.numer_kuponu='$numer_kuponu'");  /*WHERE date='$today'*/
						$rows_zaklady += $query_moje_zaklady->num_rows;

					}




				echo "Łączna liczba postawionych kuponów: <b>".$liczba_k."</b>";

				
				echo "<br/>Łączna liczba postawionych zakładów: <b>".$rows_zaklady."</b>";

				echo "<br/><br/>Liczba zweryfikowanych kuponów: <b>".$l_zwer_kup."</b>";
						if ($l_w_k==0) {
							$iwk=0;
						}else{$iwk=number_format(($l_w_k/$l_zwer_kup)*100, 2);}
				echo "<br/>Ilość wygranych kuponów: <b>".$iwk."%</b>";
						if ($l_p_k==0) {
							$ipk=0;
						}else{$ipk=number_format(($l_w_k/$l_zwer_kup)*100, 2);}
				echo "<br/>Ilość przegranych kuponów: <b>".$ipk."%</b>";

				echo "<br/><br/>Łączna wygrana: <b>".$wygrana."</b>";
					
				echo "<br/>Łączna przegrana: <b>".$przegrana."</b>";
				$bilans=$wygrana-$przegrana;
				echo "<br/>Bilans: <b>".$bilans."</b>";

?>


  
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
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