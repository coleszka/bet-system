
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
				<div id="logo"><b>Logo</b></div>
				<ol>
    <li class="option">Menu 1
      <ul>
        <li><a href="zaklady.php">Zakłady</a></li>
        
      </ul>
    </li>

    <li class="option">Menu 2
      <ul>
        <li><a href="moje_kupony.php">Moje kupony</a></li>
        
      </ul>
    </li>

    

    <li class="option">Menu 3
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
		<div style="background-color:white;" class="content">
		<h1>Główny kontener</h1>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		

		</div>
		
		<div class="footer">Stopka</div>
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