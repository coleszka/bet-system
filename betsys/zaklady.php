<?php

session_start();
if(!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}


				



if (!isset($_SESSION['numer_kuponu'])) {


	$_SESSION['numer_kuponu']=rand(1,100000);
	
}

// if (isset($_SESSION['zmiana_numeru_kuponu'])) {
// 	$_SESSION['numer_kuponu']=rand(1,100000);
// 	unset($_SESSION['zmiana_numeru_kuponu']);
// }

$suma_kurs=1;


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
		<table width="600" align="center" border="0" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
        <tr>
		<?php
			
		
			$today=date("Y-m-d");
			echo "Witaj w ".$today;

			require_once "connect.php"; 
			echo "<br /><br /><br />";
			$conn = @new mysqli($host, $db_user, $db_password, $db_name);
			mysqli_query($conn, "SET CHARSET utf8");
			mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			$query_bets = $conn->query("SELECT * FROM bets");  /*WHERE date='$today'*/
			$rows = $query_bets->num_rows;
					//$column = $query_bets->fetch_assoc();

echo '<form method="POST">';
					for ($i=0; $i < $rows ; $i++) { 
						# code...
					
					//$query_bets->data_seek($i);
					//$query_bets->fetch_array();
					//echo "| <b>bets: </b>".$query_bets->fetch_array()[$i];
						$column = $query_bets->fetch_assoc();
					// echo "| <b>S: </b>".$column['sport'];
					// echo "| <b>P1: </b>".$column['player1'];
					// echo "| <b>P2: </b>".$column['player2'];
						$a0 = $column['id'];
						$a1 = $column['date'];
						$a2 = $column['start_time'];
						$a3 = $column['sport'];
						$a4 = $column['player1'];
						$a5 = $column['player2'];
						$a6 = $column['odd_1'];
						$a7 = $column['odd_x'];
						$a8 = $column['odd_2'];
						$tab[] = $a0;
						


// echo<<<END

// <td style="border-top: 3px solid white" colspan=6 width="50" align="center" bgcolor="#999999">$a3</td>
// </tr><tr></tr><tr>
// <td colspan=6 width="50" align="center" bgcolor="#666666">$a4 vs $a5</td>
// </tr><tr></tr><tr>
// <td class="row" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">$a4  $a6 <input type="checkbox" value="+" name="win" id="win">

// </a></td>
// <td class="row" style="border-left: 3px solid #666666; border-right: 3px solid #666666" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">Remis  $a7</a></td>
// <td class="row" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">$a4  $a8</a></td>			
// </tr><tr>

// END;


echo<<<END

<td style="border-top: 3px solid white" colspan=6 width="50" align="center" bgcolor="#999999">$a3</td>
</tr><tr></tr><tr>
<td colspan=6 width="50" align="center" bgcolor="#666666">$a4 vs $a5</td>
</tr><tr></tr><tr>
END;
echo '<td class="row" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">'.$a4." ".$a6.' <input type="submit" value="1" name="'.$a0.'home'.'" id="win"></a></td>';


echo '<td class="row" style="border-left: 3px solid #666666; border-right: 3px solid #666666" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">Remis  '.$a7.' <input type="submit" value="x" name="'.$a0.'draw'.'" id="win"></a></td>';
echo '<td class="row" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">'.$a5.' '.$a8.' <input type="submit" value="2" name="'.$a0.'away'.'" id="win"></a></td>			
</tr><tr>';



				
					}
					
		?>
		</tr></table>
		<!-- <input  style='float: right; margin-right: 50px; ' type="submit" value="Dodaj do kuponu"> -->
		<!-- <script>
function myFunction() {
var zm=1;
document.getElementById("win").setAttribute("name", zm); 
zm++;
}
myFunction();	
</script> -->
		</form>
		

		</div>
		<div class="bets_right">
			
			<?php 
				// if (isset($_POST['2'])) {
				// 	$_SESSION['create_kupon']=true;
				// 	$kupon[]=2;
				// 	$_SESSION['liczba']++;
				// 	$_SESSION['kupon'][$_SESSION['liczba']]=$kupon;

				// }

				// if (isset($_POST['1'])) {
				// 	$_SESSION['create_kupon']=true;
				// 	$kupon[]=1;
				// 	$_SESSION['liczba']++;
				// 	$_SESSION['kupon'][$_SESSION['liczba']]=$kupon;

				// }

				// for ($i=0; $i <= $rows; $i++) { 
					
				// 	if (isset($_POST[$i])) {
				// 	$_SESSION['create_kupon']=true;
				// 	$kupon[]=$i;
				// 	$_SESSION['liczba']++;
				// 	$_SESSION['kupon'][$_SESSION['liczba']]=$kupon;

				// 	}

				// }
// $kupon[]=+$ads;

				// if ($_SESSION['create_kupon']==true) {
					
				// 	echo "dodany zaklad";
				// 	 var_dump($_SESSION['kupon']);


				// 	}
				// if (isset($_SESSION['postawiono'])) {
				// 	echo "postawiono!";
				// 	unset($_SESSION['postawiono']);
				// 	exit();
				// }
				// else
				// {
				// echo $_SESSION['numer_kuponu'];
				
				for ($i=0; $i < $rows; $i++) { 
					
					if (isset($_POST[$tab[$i].'home'])) {
						$pokaz=$tab[$i];
						echo '<br/>Nr ID zakladu:'.$pokaz;
						echo '<br/>Home';

						if ($conn->query("INSERT INTO koszyk(id_koszyk,id_user,id_bet,1x2,numer_kupon) VALUES (NULL,'{$_SESSION['id']}','$pokaz','1','{$_SESSION['numer_kuponu']}')")) {
        				unset($_POST[$tab[$i].'home']); ///niewiem!!!!!!!!!!!!!!!!!!!!!!
          				// $_SESSION['udanarejestracja']=true;
				          // header('Location: witajrejestracja.php');
        				$_SESSION['nie_koszyk_pusty']=true;
				        }
				        else
				        {
				          throw new Exception($conn->error);
				          
				        }


					}

					if (isset($_POST[$tab[$i].'draw'])) {
						$pokaz=$tab[$i];
						echo '<br/>Nr ID zakladu:'.$pokaz;
						echo '<br/>Draw';

						if ($conn->query("INSERT INTO koszyk(id_koszyk,id_user,id_bet,1x2,numer_kupon) VALUES (NULL,'{$_SESSION['id']}','$pokaz','x','{$_SESSION['numer_kuponu']}')")) {
        				unset($_POST[$tab[$i].'draw']); ///niewiem!!!!!!!!!!!!!!!!!!!!!!
          				// $_SESSION['udanarejestracja']=true;
				          // header('Location: witajrejestracja.php');
        				$_SESSION['nie_koszyk_pusty']=true;
				        }
				        else
				        {
				          throw new Exception($conn->error);
				          
				        }
					}

					if (isset($_POST[$tab[$i].'away'])) {
						$pokaz=$tab[$i];
						echo '<br/>Nr ID zakladu:'.$pokaz;
						echo '<br/>Away';

						if ($conn->query("INSERT INTO koszyk(id_koszyk,id_user,id_bet,1x2,numer_kupon) VALUES (NULL,'{$_SESSION['id']}','$pokaz','2','{$_SESSION['numer_kuponu']}')")) {
        				unset($_POST[$tab[$i].'away']); ///niewiem!!!!!!!!!!!!!!!!!!!!!!
          				// $_SESSION['udanarejestracja']=true;
				          // header('Location: witajrejestracja.php');
        				$_SESSION['nie_koszyk_pusty']=true;
				        }
				        else
				        {
				          throw new Exception($conn->error);
				          
				        }
					}
				}

				// if (isset($_SESSION['postawiono'])) {
				// 	echo "postawiono!";
				// 	unset($_SESSION['postawiono']);
				// 	exit();
				// }
				// else
				// {
				$query_kupon = $conn->query("SELECT * FROM koszyk WHERE numer_kupon='{$_SESSION['numer_kuponu']}'");
				$rows_kupon = $query_kupon->num_rows;

				// $query_kupon_dane = $conn->query("SELECT player1, player2, odd_1, odd_x, odd_2 FROM bet WHERE numer_kupon='{$_SESSION['numer_kuponu']}'");
				

				for ($i=0; $i < $rows_kupon; $i++) { 
					
						

						$column_kupon = $query_kupon->fetch_assoc();
						$id_koszyk = $column_kupon['id_koszyk'];
						$id_user = $column_kupon['id_user'];
						$id_bet = $column_kupon['id_bet'];
						$typ = $column_kupon['1x2'];
						$numer_kupon = $column_kupon['numer_kupon'];
						$tab_usun[] = $id_koszyk;

						
							
						$query_kupon_dane = $conn->query("SELECT player1, player2, odd_1, odd_x, odd_2 FROM bets WHERE id='$id_bet'");

						$column_kupon_dane = $query_kupon_dane->fetch_assoc();

						$player1_kupon_dane = $column_kupon_dane['player1'];
						$player2_kupon_dane = $column_kupon_dane['player2'];
						$odd_1_kupon_dane = $column_kupon_dane['odd_1'];
						$odd_x_kupon_dane = $column_kupon_dane['odd_x'];
						$odd_2_kupon_dane = $column_kupon_dane['odd_2'];

						// if (!isset($_SESSION['nie_koszyk_pusty'])) {
							
						// 	exit();
						// }


						echo '<div class="zaklad">';
						echo '<form method="post"><input class="x" type="submit" value="x" name="'.$id_koszyk.'"></form><br/>';
						echo $player1_kupon_dane." vs ".$player2_kupon_dane."<br/>";
						echo "Typ: ".$typ;

						if ($typ=='1') {
							echo "<br/>Kurs: ".$odd_1_kupon_dane;
							$suma_kurs *= $odd_1_kupon_dane;
							
						}
						else
						{
							if ($typ=='x') {
								echo "<br/>Kurs: ".$odd_x_kupon_dane;
								$suma_kurs *= $odd_x_kupon_dane;

							}
							else
							{
								echo "<br/>Kurs: ".$odd_2_kupon_dane;
								$suma_kurs *= $odd_2_kupon_dane;
							}
						}
						

						echo "</div>";

						
						if (isset($_POST[$tab_usun[$i]])) {
						$usun=$tab[$i];
						// echo '<br/>usun:'.$usun." ".$id_koszyk;
						if ($conn->query("DELETE FROM koszyk WHERE id_koszyk='$id_koszyk'")) {
        				unset($_POST[$tab_usun[$i]]); ///niewiem!!!!!!!!!!!!!!!!!!!!!!
          				// $_SESSION['udanarejestracja']=true;
				          // header('Location: witajrejestracja.php');
				        }
				        else
				        {
				          throw new Exception($polaczenie->error);
				          
				        }
						}

					// }//isset
					



						if (isset($_POST['stawka'])) {


											
											$wygrana=round($_POST['stawka']*$suma_kurs, 2);
											$stawka=round($_POST['stawka'], 2);
											$suma_kurs=round($suma_kurs, 2);
											$today=date("Y-m-d");
											if ($conn->query("INSERT INTO postawione_kupony (id_postawione_kupony,id_user , numer_kuponu, kurs, stawka, wygrana, wynik, data_dodania) VALUES (NULL,'{$_SESSION['id']}','{$_SESSION['numer_kuponu']}','$suma_kurs','$stawka','$wygrana', '0' , '$today')"))
											{


												$_SESSION['points']=$_SESSION['points']-$_POST['stawka'];
												unset($_POST['stawka']);
												$_SESSION['postawiono']=true;
												echo "Postawione zakłady o numerze: ".$_SESSION['numer_kuponu'];
												
												echo '<br/><a href="zaklady.php">Dodaj kolejny kupon</a>';
												unset($_SESSION['nie_koszyk_pusty']);


												$query_move = $conn->query("SELECT * FROM koszyk WHERE numer_kupon='{$_SESSION['numer_kuponu']}'");
												$rows_move = $query_move->num_rows;
												// $conn->query("INSERT INTO postawione_zaklady (id_postawione_zaklady, numer_kuponu, id_bets) VALUES (NULL, '{$_SESSION['numer_kuponu']}','$id_bet')");
												
												// if ($i == $rows_kupon) {
													
												for ($i=0; $i < $rows_move; $i++) { 
					
						

												$column_move = $query_move->fetch_assoc();
												$id_koszyk_move = $column_move['id_koszyk'];
												$id_bet_move = $column_move['id_bet'];
												$numer_kupon_move = $column_move['numer_kupon'];
												$wynik_move = $column_move['1x2'];
												echo "<br/>to przeniose: IDbet".$id_bet_move." NR kupon: ".$numer_kupon_move;
												$conn->query("INSERT INTO postawione_zaklady(id_postawione_zaklady, numer_kuponu, id_bets, 1x2) VALUES (NULL,'$numer_kupon_move','$id_bet_move','$wynik_move')");
												$conn->query("DELETE FROM koszyk WHERE id_koszyk='$id_koszyk_move'");

												}
													

												// 	exit();
												// }
												unset($_SESSION['numer_kuponu']);
												exit();

											}
				        else
				        {
				          throw new Exception($conn->error);
				          
				        }

					}

					

					// if (isset($_POST['stawka'])) {
											
					// 						$wygrana=round($_POST['stawka']*$suma_kurs, 2);
					// 						$stawka=round($_POST['stawka'], 2);
					// 						$suma_kurs=round($suma_kurs, 2);
					// 						if ($conn->query("INSERT INTO postawione_kupony (id_postawione_kupony,id_user , numer_kuponu, kurs, stawka, wygrana, wynik) VALUES (NULL,'{$_SESSION['id']}','{$_SESSION['numer_kuponu']}','$suma_kurs','$stawka','$wygrana', '0')"))
					// 						{
					// 							unset($_POST['stawka']);
					// 							echo "udalo sie";
					// 							$_SESSION['zmiana_numeru_kuponu']=true;
												
					// 						}
				 //        else
				 //        {
				 //          throw new Exception($conn->error);
				          
				 //        }

										}					

					echo '<script>',
'function change()',
'{',
'document.getElementById("wygrana").innerHTML = document.getElementById("input").value*'.$suma_kurs.';',
'}',
'</script>',
			'<form method="post"><input id="input" type="text" name="stawka" onKeyup="change();"><input type="submit" name="postaw" value="postaw"></form>',
			'<br/><p class="error">Zbyt duża stawka!</p></br><b>Kurs: '.$suma_kurs.'</b> ',
			'<br/><b>Wygrana: </b><b id="wygrana"></b>';



					
			?>
			<!-- <script>
function change()
{
document.getElementById("wygrana").innerHTML = document.getElementById("input").value*<?php echo $suma_kurs; ?>;
}
</script>
			<input id="input" type="text" name="stawka" onKeyup="change();">
			<br/><p>Kurs: <?php echo $suma_kurs;?></p> 
			<br/><p>Wygrana: </p><p id="wygrana"></p> -->
			

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