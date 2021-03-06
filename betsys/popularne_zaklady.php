
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
		
		<table>
  <thead>
    <tr>
      <th colspan="4">Popularne zakłady</th>
    </tr>
    <tr>
      <th colspan="1">#</th>
      <th colspan="1">Dyscyplina</th>
	  <th colspan="1">Mecz</th>
	  <th colspan="1">Liczba postawionych zakładów</th>
	  
    </tr>
  </thead>

<?php

			require_once "connect.php"; 
			
			$conn = @new mysqli($host, $db_user, $db_password, $db_name);
			mysqli_query($conn, "SET CHARSET utf8");
			mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			$query_ranking = $conn->query("SELECT id_bets, COUNT(id_bets), id, sport, player1, player2  FROM postawione_zaklady, bets WHERE postawione_zaklady.id_bets=bets.id GROUP BY id_bets");  /*WHERE date='$today'*/
			$rows = $query_ranking->num_rows;
					


					for ($i=0, $temp=1; $i < $rows ; $i++, $temp++) { 
						
						$ranking = $query_ranking->fetch_assoc();
						$id_bets = $ranking['id_bets'];
						$sport = $ranking['sport'];
						$player1 = $ranking['player1'];
						$player2 = $ranking['player2'];
						$count  = $ranking['COUNT(id_bets)'];

						// $query_liczba_naj = $conn->query("SELECT id_bets FROM postawione_zaklady WHERE id_bets='$id_bets'");  /*WHERE date='$today'*/
						// $liczba_naj = $query_liczba_naj->num_rows;

						
						
						
echo<<<END
<tbody>
    <tr>
      <td>$temp</td>
      <td>$sport</td>
      <td>$player1 vs $player2</td>
      <td>
        <i>$count</i>
      </td>
    </tr>
  </tbody>

END;
}

?>
</table>

  
<br/><br/><br/>
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