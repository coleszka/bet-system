
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

table.win {
  text-align: left;
  line-height: 40px;
  border-collapse: separate;
  border-spacing: 0;
  border: 2px solid #06C20F;
  width: 900px;
  margin: 50px auto;
  border-radius: .25rem;
}

thead.win tr:first-child {
  background: #06C20F;
  color: #fff;
  border: none;
}

table.lose {
  text-align: left;
  line-height: 40px;
  border-collapse: separate;
  border-spacing: 0;
  border: 2px solid #ed1c40;
  width: 900px;
  margin: 50px auto;
  border-radius: .25rem;
}

thead.lose tr:first-child {
  background: #ed1c40;
  color: #fff;
  border: none;
}

table.wait {
  text-align: left;
  line-height: 40px;
  border-collapse: separate;
  border-spacing: 0;
  border: 2px solid gray;
  width: 900px;
  margin: 50px auto;
  border-radius: .25rem;
}

thead.wait tr:first-child {
  background: gray;
  color: #fff;
  border: none;
}
		
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
						
						<?php
						if(isset($_SESSION['blad']))	{echo $_SESSION['blad'];
							unset($_SESSION['blad']);}
						?>
						
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="content">
		
		

<?php

			require_once "connect.php"; 
			
			$conn = @new mysqli($host, $db_user, $db_password, $db_name);
			mysqli_query($conn, "SET CHARSET utf8");
			mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			$query_moje_kupony = $conn->query("SELECT id_user, numer_kuponu, stawka, wygrana, kurs, wynik, data_dodania  FROM postawione_kupony WHERE postawione_kupony.id_user='{$_SESSION['id']}'");  /*WHERE date='$today'*/
			$rows = $query_moje_kupony->num_rows;
					


					for ($i=0; $i < $rows ; $i++) { 
						
						$moje_kupony = $query_moje_kupony->fetch_assoc();
						$numer_kuponu = $moje_kupony['numer_kuponu'];
						$stawka = $moje_kupony['stawka'];
						$wygrana = $moje_kupony['wygrana'];
						$kurs = $moje_kupony['kurs'];
						$wynik = $moje_kupony['wynik'];
						$data_dodania = $moje_kupony['data_dodania'];

						// $query_liczba_naj = $conn->query("SELECT id_bets FROM postawione_zaklady WHERE id_bets='$id_bets'");  /*WHERE date='$today'*/
						// $liczba_naj = $query_liczba_naj->num_rows;

						
						if ($wynik=='W') {
							echo '<table class="win"><thead class="win">';
						}
						if ($wynik=='L') {
							echo '<table class="lose"><thead class="lose">';
						}
						if ($wynik=='0') {
							echo '<table class="wait"><thead class="wait">';
						}
						
echo<<<END


    <tr>
    	
      <th colspan="2">Numer kuponu: $numer_kuponu</th>
      <th colspan="1">Stawka: $stawka</th>
      <th colspan="1">Łączny kurs: $kurs</th>
      <th colspan="1">Wygrana: $wygrana</th>
      <th colspan="2">Data: $data_dodania</th>
    </tr>
    <tr>
      <th colspan="1">#</th>
      <th colspan="1">Data / Czas</th>
      <th colspan="1">Nr</th>
      <th colspan="1">Zakład</th>
      <th colspan="1">Typ</th>
      <th colspan="1">Wynik</th>
      <th colspan="1">Kurs</th>
    </tr>
  </thead>
END;

$query_moje_zaklady = $conn->query("SELECT numer_kuponu, id_bets, 1x2, pz_result, player1, player2, start_time, date, id   FROM postawione_zaklady, bets WHERE postawione_zaklady.numer_kuponu='$numer_kuponu' AND postawione_zaklady.id_bets=bets.id");  /*WHERE date='$today'*/
$rows_zaklady = $query_moje_zaklady->num_rows;
					


					for ($j=0, $temp=1; $j < $rows_zaklady ; $j++, $temp++) { 
						
						$moje_zaklady = $query_moje_zaklady->fetch_assoc();
						$start_time = $moje_zaklady['start_time'];
						$id = $moje_zaklady['id'];
						$player1 = $moje_zaklady['player1'];
						$player2 = $moje_zaklady['player2'];
						$typ = $moje_zaklady['1x2'];
						$pz_result = $moje_zaklady['pz_result'];


echo<<<END
<tbody>
    <tr>
      <td>$temp</td>
      <td>$start_time </td>
      <td>$id</td>
      <td>$player1 vs $player2</td>
      <td>$typ</td>
      <td>$pz_result</td>
      <td>2.66</td>
      </tr>
  </tbody>

END;
}


}

?>
</table>

  

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