<?php

session_start();
if(!isset($_SESSION['zalogowany']) && $_SESSION['perm']==1)
{
	header('Location: index.php');
	exit();
}
     
 function verifyzaklady(){

 	require_once "connect.php"; 
      
      $conn = @new mysqli($host, $db_user, $db_password, $db_name);
      mysqli_query($conn, "SET CHARSET utf8");
      mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
      $query_bets = $conn->query("SELECT postawione_zaklady.id_postawione_zaklady, postawione_zaklady.id_bets, bets.result, bets.id, postawione_zaklady.1x2, postawione_zaklady.pz_result FROM postawione_kupony, postawione_zaklady, bets WHERE postawione_kupony.wynik='0' AND postawione_kupony.numer_kuponu = postawione_zaklady.numer_kuponu AND postawione_zaklady.id_bets = bets.id ");
      $rows = $query_bets->num_rows;


      // $query_temp = $conn->query("SELECT numer_kuponu, wynik FROM postawione_kupony WHERE wynik='0'");
      // $b_for = $query_temp->fetch_assoc();
      // $temp_nr = $b_for['numer_kuponu'];
      // echo $temp_nr;
      // $wynik_kuponu=true;
      // $oczekuje=false;
      // $temp_wynik=true;

      for ($i=0; $i < $rows ; $i++) { 
          
        $column = $query_bets->fetch_assoc();
        mysqli_query($conn, "SET CHARSET utf8");
        mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
        // $id_postawione_kupony = $column['id_postawione_kupony'];
        // $numer_kuponu = $column['numer_kuponu'];
        // $wynik = $column['wynik'];
        // $id_user = $column['id_user'];
        $result = $column['result'];
        // $id_bets = $column['id_bets'];
        $id = $column['id'];
        $typ = $column['1x2'];
        // $result_zaklad = $column['pz_result'];
        $id_postawione_zaklady = $column['id_postawione_zaklady'];

        
        // $temp_nr=$numer_kuponu;
        // echo "<br/>ID PK:".$id_postawione_kupony." ";
        // echo "ID USER:".$id_user." ";
        // echo "NR KUP:".$numer_kuponu." ";
        // echo "WYNIK:".$wynik." ";
        // echo "RESULT:".$result." ";
        // echo "ID BETS:".$id_bets." ";
        // echo "ID:".$id." <br/>";
        // echo "TYP:".$typ." <br/>";
        // echo "ID PZ:".$id_postawione_zaklady." <br/>";




        // TUTAJ FOR DO SPRAWDZENIA WYNIKOW
        if ($result==$typ) {
        	echo "WYGRANA<br/>";
        	$query_win = $conn->query("UPDATE postawione_zaklady SET pz_result='W' WHERE id_postawione_zaklady='$id_postawione_zaklady'");
        	
        }
        else
        {
        	if ($result=='') {
        		echo "OCZEKUJE<br/>";
        		
        	}
        	else
        	{
        	echo "PRZEGRANA<br/>";
        	$query_lose = $conn->query("UPDATE postawione_zaklady SET pz_result='L' WHERE id_postawione_zaklady='$id_postawione_zaklady'");
        	//MOZNA JUZ DODAC PRZEGRANY KUPON
        	}
        }





    //     // if ($temp_nr==$numer_kuponu) {
    //     // 	echo "ten sam kupon<br/>";
    //     // }
    //     // else
    //     // {
    //     // $temp_nr=$numer_kuponu;	
    //     // echo "       -zmiana kuponu<br/>";
    //     // }

        //POPRZEDNI

    //     if ($temp_nr!=$numer_kuponu || ($i==$rows-1)) {
        	
        	
    //     		if ($result!=$typ) {
        		
    //     		echo "|false|<br/>";
    //     		}
    //     		else
    //     		{
    //     			if ($result=="") {
    //     			$oczekuje=true;
    //     			$wynik_kuponu=false;
    //     			echo "|oczekuje|<br/>";
    //     			}
    //     			else
    //     			{
        			
    //     			echo "|true|<br/>";}
    //     		}


    //     		if ($wynik_kuponu==false) {
        			
    //     			if ($oczekuje==true) {
        			
    //     			echo "<br/>-KUPON OCZEKUJE<br/>";
        			
    //     			$oczekuje=true;
    //     			$wynik_kuponu=true;
    //     			}

    //     			if ($oczekuje==false)
    //     			{
    //     			echo "<br/>-Przegrany KUPON: ".$temp_nr."<br/>";
    //     			$wynik_kuponu=true;
    //     			$oczekuje=false;
    //     			}
    //     		}
    //     		else
    //     		{
    //     			echo "<br/>-WYGRANY KUPON: ".$temp_nr."<br/>";
    //     			$wynik_kuponu=true;
    //     			$oczekuje=false;
    //     		}
				// $temp_nr=$numer_kuponu;
        	

    //     }
    //     else
    //     {

    //     	if ($result==$typ) {
        	
    //     	echo "|true|<br/>";
    //     	}
    //     	else
    //     	{
    //     	if ($result=="") {
    //     		$oczekuje=true;
    //     		$wynik_kuponu=false;
    //     		echo "|oczekuje|<br/>";
    //     		}
    //     		else
    //     		{
    //     		$wynik_kuponu=false;
    //     		echo "|false|<br/>";
    //     		}
    //     	}

    //     }


        // TUTAJ IF CZY FOR ZWROCIL TRUE JESLI TAK TO DOPISZ TRUE JESLI NIE TO FALSE



     //    $query_postawione_zaklady = $conn->query("SELECT id_postawione_zaklady FROM postawione_zaklady WHERE numer_kuponu='$numer_kuponu'");
     //  	$rows_pz = $query_postawione_zaklady->num_rows;

     //  	for ($i=0; $i < $rows_pz ; $i++) { 
          
     //    $pz = $query_postawione_zaklady->fetch_assoc();
     //    mysqli_query($conn, "SET CHARSET utf8");
     //    mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
     //    $id_pz = $pz['id_postawione_zaklady'];

     //    	if ($id_pz > 0) {
     //    		echo "PZ: ".$id_pz;
     //    	}
        
    	// }	




       }
		echo "string";
} 
      

function verifykupony()
{

require_once "connect.php"; 
      
      $conn = @new mysqli($host, $db_user, $db_password, $db_name);
      mysqli_query($conn, "SET CHARSET utf8");
      mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	  $query_vkupony = $conn->query("SELECT numer_kuponu, wygrana, id_user FROM postawione_kupony WHERE postawione_kupony.wynik='0'");
      $rows_v = $query_vkupony->num_rows;

      echo "liczba kuponow: 	".$rows_v."<br/>";

      for ($i=0; $i < $rows_v ; $i++) { 
          
        $column_v = $query_vkupony->fetch_assoc();
        mysqli_query($conn, "SET CHARSET utf8");
        mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

        $numer_kuponu=$column_v['numer_kuponu'];
        $wygrana=$column_v['wygrana'];
        // $points=$column_v['points'];
        $id_user=$column_v['id_user'];
        // $points+=$wygrana;

        echo $numer_kuponu." ";

        $query_vkupony_vzaklady = $conn->query("SELECT id_postawione_zaklady, pz_result FROM postawione_zaklady WHERE numer_kuponu='$numer_kuponu'");
      	$rows_vz = $query_vkupony_vzaklady->num_rows;

      	$stan=true;

 
	      	for ($j=0; $j < $rows_vz; $j++) {
	      	$column_vz = $query_vkupony_vzaklady->fetch_assoc();
	        mysqli_query($conn, "SET CHARSET utf8");
	        mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	      	$id_postawione_zaklady_v1 = $column_vz['id_postawione_zaklady'];
	      	$pz_result=$column_vz['pz_result'];

	      	echo $id_postawione_zaklady_v1." - ".$pz_result."<br/>";

		      	if ($pz_result=='') {
		      		$stan=false;
		      		echo "OCZEKUJE<br/>";
		      		break;
		      	}
		      	if ($pz_result=='W') {
		      		$stan=true;
		      		
		      	}
		      	if ($pz_result=='L') {
		      		$stan=false;
		      		echo "Przegrywa<br/>";
		      		$query_kupon_lose = $conn->query("UPDATE postawione_kupony SET wynik='L' WHERE numer_kuponu='$numer_kuponu'");
		      		break;
		      	}
			}		


	    if ($stan==true) {
	    echo "Wygrana: <br/>.$wygrana";
	    $query_kupon_select = $conn->query("SELECT points FROM uzytkownicy WHERE id='$id_user'");
	    $wiersz = $query_kupon_select->fetch_assoc();
	    $points = $wiersz['points'];
	    $wynik = $points+$wygrana;

	    $query_kupon_win = $conn->query("UPDATE postawione_kupony SET wynik='W' WHERE numer_kuponu='$numer_kuponu'");
	    $query_kupon_win_addpoints = $conn->query("UPDATE uzytkownicy SET points='$wynik' WHERE id='$id_user'");
	    }
	      	

    	}

echo "kupony";
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
				<div class="option">Home</div>
				<div class="option">Typy</div>
				<div class="option">Typerzy</div>
				<div class="option">Statystyki</div>
				<div class="right-menu">pts</div>
				<div class="right-menu">user</div>
				<div class="right-menu">logout</div>
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
		
		
	   <form method="post"><input type="submit" name="asd" value="zaklady" ></form>
	
	<?php

	if (isset($_POST['asd'])) {
		verifyzaklady();
		// unset($_POST['asd']);
	}



	?>

	<form method="post"><input type="submit" name="kupon" value="kupony" ></form>
	
	<?php

	if (isset($_POST['kupon'])) {
		verifykupony();
		// unset($_POST['asd']);
	}



	?>
	
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