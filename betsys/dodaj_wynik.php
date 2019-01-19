<?php

session_start();
if(!isset($_SESSION['zalogowany']) && $_SESSION['perm']==1)
{
	header('Location: index.php');
	exit();
}
     
      require_once "connect.php"; 
      
      $conn = @new mysqli($host, $db_user, $db_password, $db_name);
      mysqli_query($conn, "SET CHARSET utf8");
      mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
      $query_bets = $conn->query("SELECT * FROM bets");
      $rows = $query_bets->num_rows;

      


        for ($i=0; $i < $rows ; $i++) { 
          
        $column = $query_bets->fetch_assoc();
        mysqli_query($conn, "SET CHARSET utf8");
        mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
        $id = $column['id'];

        if(isset($_POST[$id])){
          // echo "NR: ".$id;
           

          if ($_POST[$id]=='1') {
            
            $conn->query("UPDATE bets SET result='1' WHERE id='$id'");
            
          }

          if ($_POST[$id]=='x') {
            
            $conn->query("UPDATE bets SET result='x' WHERE id='$id'");
            
          }

          if ($_POST[$id]=='2') {
            
            $_SESSION['dodanowynik']=true;
            $conn->query("UPDATE bets SET result='2' WHERE id='$id'");
            
            
          }

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
    
    <table width="400" align="left" border="0" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
        <tr>
	   <?php
    
      
      $query_bets = $conn->query("SELECT * FROM bets WHERE result=''");
      $rows = $query_bets->num_rows;
        
echo '<form method="POST">';
          for ($i=0; $i < $rows ; $i++) { 
           
            $column = $query_bets->fetch_assoc();
            mysqli_query($conn, "SET CHARSET utf8");
            mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            $a0 = $column['id'];
            $a1 = $column['date'];
            $a2 = $column['start_time'];
            $a3 = $column['sport'];
            $a4 = $column['player1'];
            $a5 = $column['player2'];
            

echo<<<END

<td style="border-top: 3px solid white" colspan=6 width="50" align="center" bgcolor="#999999">$a3</td>
</tr><tr></tr><tr>
<td colspan=6 width="50" align="center" bgcolor="#666666">$a4 vs $a5</td>
</tr><tr></tr><tr>
END;
echo '<td class="row" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">'.$a4.'</a></td>';
echo '<td class="row" colspan=2 width="50" align="center" bgcolor="#5E5E5E"><a href="#">'.$a5.'</a></td></tr><tr>';
echo '<td colspan=6 align="right">Wynik: <input style="border: 1px solid grey" type="text" name="'.$a0.'" id="wynik"></td></tr><tr>';

        }
      ?>
    
    </tr></table>
    <input style="float: right; margin-right: 300px; "  type="submit" value="Dodaj wyniki" name="dodaj_wyniki">
    </form>
    <br/> <p class="error" style="float: right; margin-right: 300px;">Źle wprowadzony wynik</p>
    </div>
		</div>
    <div class="bets_right">
    <!-- <form method="post" action="dodanie_wyniku.php"></form><br/> -->
    <?php
    if (isset($_SESSION['dodanowynik'])) {
      echo '<br/><p style=" float:right;margin-right:220px;"><b>Dodano wyniki</b></p>';

      unset($_SESSION['dodanowynik']);
            
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