
<?php

session_start();

if(!isset($_SESSION['udanarejestracja']))
{
	header("Location: index.php");
	exit();
}
else
{
	unset($_SESSION['udanarejestracja']);
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
		Dziękujemy za rejestrację!
		<br/>Zaloguj się na swoje konto!
		
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