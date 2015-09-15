<?php 
	Function removeaccents($string) {  
		$string= strtr($string,  
		"\xC0\xC1\xC2\xC3\xC4\xC5\xE0\xE1\xE2\xE3\xE4\xE5\xD2\xD3\xD4\xD5\xD6\xD7\xD8\xF2\xF3\xF4\xF5\xF6\xF7\xF8\xC8\xC9\xCA\xCB\xE8\xE9\xEA\xEB\xC7\xE7\xCC\xCD\xCE\xCF\xEC\xED\xEE\xEF\xD9\xDA\xDB\xDC\xF9\xFA\xFB\xFC\xFF\xD1\xF1",
		"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");  
		return $string;  
	}; 

	if(!empty($_POST['taille']) && isset($_POST['envoi'])) {		    
		$my_size = $_POST['taille'];
	} 
	else {
		$my_size = "1";
	}

	if(!empty($_POST['invert']) && isset($_POST['invert'])) {		    
		$invert = $_POST['invert'];
		if ($invert == "yes"){
			$chemin="neg/";
		}else $chemin="pos/";
	} 
	else {
		//$my_size = "1";
		$invert="";
		$chemin="pos/";
	}

	if(!empty($_POST['phrase']) && isset($_POST['envoi'])) {		    
		$my_text = $_POST['phrase'];
		$my_text = removeaccents($my_text);
		$my_text = strtoupper($my_text);
		$my_text = trim ($my_text);
		//$my_text = str_replace("\\","", $my_text);
	} 
	else {
		$my_text = "ZONE DE TEXTE";
	}
?>

<html>
	<head>
		<!-- Basic Page Needs -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Hot Keys - 2008</title>
		<meta name="description" content="Carine Bigot Hot Keys project">
		<meta name="author" content="Carine Bigot">
		<!-- Mobile Specific Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- CSS -->
		<link rel="stylesheet" href="hotkeysstyle.css">

		<?php 
		 //echo $my_text;	
		?>
	<script type='text/javascript'>
		<?php 
			echo "var letexte = '" . $my_text . "';";
			echo "var lataille = '" . $my_size . "';";
			echo "var lechemin = '" . $chemin . "';";
		?>
   
			var montimer;
			var cmpt = 0;   
			var cmpt2 = 0; 

		function typewriter(){
			lelien = document.getElementById('lien');
			ledebug = document.getElementById('debu');
	
			courant = ledebug.innerHTML.substring(0, ledebug.innerHTML.length);
			ledebug.innerHTML = courant;
	  
			if (courant != letexte)
			{ 	  	 	  	 	  		 	  	 
				 if (  (courant.charAt(courant.length -1) != letexte.charAt(courant.length -1)) )
				 { 	   	  	 	
				
					if ((letexte.charAt(courant.length -1) < 'A')||(letexte.charAt(courant.length -1) > 'Z')) courant = courant.substring(0,courant.length -1) + letexte.charAt(courant.length -1);
					else courant = courant.substring(0,courant.length -1) + String.fromCharCode(courant.charCodeAt(courant.length -1)+1);
			
				 }else{  	  	 	 	
					courant += "A";
				 } 

				   ledebug.innerHTML = courant;
				   cmpt2 = 0;
				   courant2 = "";

				   while( cmpt2 < courant.length ){
					   if (courant.charAt(cmpt2) == ' ') courant2 += "<img src=\""+ lechemin + "espace"+ lataille + ".png\">";
					   else if (courant.charAt(cmpt2) == ',') courant2 += "<img src=\""+ lechemin + "virgule"+ lataille + ".png\">";
					   else if (courant.charAt(cmpt2) == '.') courant2 += "<img src=\""+ lechemin + "point"+ lataille + ".png\">";
					   else if (courant.charAt(cmpt2) == '\'') courant2 += "<img src=\""+ lechemin + "apostrophe"+ lataille + ".png\">";
					   else if ((courant.charAt(cmpt2) >= 'A') && (courant.charAt(cmpt2) <= 'Z'))
					courant2 += "<img src=\""+ lechemin + courant.charAt(cmpt2)+ lataille + ".png\">";
					 else courant2 += "<img src=\""+ lechemin + "caractere_special" + lataille + ".png\">";

						 cmpt2 ++ ;
				   }
				   lelien.innerHTML = courant2;  	 
			  }
			  else
			  {
				/*ledebug.innerHTML = "debug 7";*/
				/* courant = " fini";
				lelien.innerHTML = courant; */
			  }
			  setTimeout("typewriter()",100);  
		   }
		   window.onload = function(){
			  typewriter();
		   }
	</script>
</head>

<body>
	<?php 
		if($invert=="yes") echo "<body bgcolor=\"#000000\">";
		else echo "<body bgcolor=\"#FFFFFF\">";
	?>
<div class="container">

	<header>
		<h1>Hot Keys</h1>
		<hr></hr>
	</header>
	<!--
	<div class="infos">
		<p>
			Considérant le geste du raccourci clavier comme un langage à part entière, cette typographie est élaborée à partir de la forme des mains effectuant une combinaison de touches.
		</p>
		<p>Carine Bigot, 2008<br/>
		Php, javascript : Jérôme Bigot</p>
		<hr></hr>
	</div>
	-->

	<div class="generator">
	<div class="ihm">
		<?php
			echo '<form action=' .$_SERVER['PHP_SELF']. ' method="POST" >';
		?>
		<?php
			$my_text_bof = str_replace("\\'", "'", $my_text);
			$my_text_bof = str_replace("\\\"", "&#34;", $my_text_bof);
			$my_text_bof = str_replace("\\\\", "\\", $my_text_bof);
			//echo $my_text_bof;
				echo 'Texte : <input type="text" name="phrase" value="' . $my_text_bof . '" size="60"><br>';
		?>
		<?php echo "Taille : <SELECT name=\"taille\">";
			echo "<OPTION VALUE=\"1\"";  
			if($my_size=="1") echo " SELECTED "; 
			echo ">1</OPTION>";

			echo "<OPTION VALUE=\"2\"";
			if($my_size=="2") echo " SELECTED ";
			echo ">2</OPTION>";		
		
			echo "<OPTION VALUE=\"3\"";
			if($my_size=="3") echo " SELECTED ";
			echo ">3</OPTION>";

			echo "<OPTION VALUE=\"4\"";  
			if($my_size=="4") echo " SELECTED "; 
			echo ">4</OPTION>";

			echo "<OPTION VALUE=\"5\"";
			if($my_size=="5") echo " SELECTED ";
			echo ">5</OPTION>";		
		
			echo "<OPTION VALUE=\"6\"";
			if($my_size=="6") echo " SELECTED ";
			echo ">6</OPTION>";
		
			echo "<OPTION VALUE=\"7\"";
			if($my_size=="7") echo " SELECTED ";
			echo ">7</OPTION>";
		
			echo "</SELECT>&nbsp;&nbsp;<input type=\"checkbox\" name=\"invert\" value=\"yes\"";
			if($invert=="yes") echo " CHECKED ";
			echo "> Négatif<br>";
		?>
		<?php
			echo '<input type="submit" name="envoi" value="OK">';
			echo '</form>';
		?>
	</div>

	<div class="cachee">
		<?php
			echo "
			<img src=\""."$chemin"."A$my_size.png\">
			<img src=\""."$chemin"."B$my_size.png\">
			<img src=\""."$chemin"."C$my_size.png\">
			<img src=\""."$chemin"."D$my_size.png\">
			<img src=\""."$chemin"."E$my_size.png\">
			<img src=\""."$chemin"."F$my_size.png\">
			<img src=\""."$chemin"."G$my_size.png\">
			<img src=\""."$chemin"."H$my_size.png\">
			<img src=\""."$chemin"."I$my_size.png\">
			<img src=\""."$chemin"."J$my_size.png\">
			<img src=\""."$chemin"."K$my_size.png\">
			<img src=\""."$chemin"."L$my_size.png\">
			<img src=\""."$chemin"."M$my_size.png\">
			<img src=\""."$chemin"."N$my_size.png\">
			<img src=\""."$chemin"."O$my_size.png\">
			<img src=\""."$chemin"."P$my_size.png\">
			<img src=\""."$chemin"."Q$my_size.png\">
			<img src=\""."$chemin"."R$my_size.png\">
			<img src=\""."$chemin"."S$my_size.png\">
			<img src=\""."$chemin"."T$my_size.png\">
			<img src=\""."$chemin"."U$my_size.png\">
			<img src=\""."$chemin"."V$my_size.png\">
			<img src=\""."$chemin"."W$my_size.png\">
			<img src=\""."$chemin"."X$my_size.png\">
			<img src=\""."$chemin"."Y$my_size.png\">
			<img src=\""."$chemin"."Z$my_size.png\">
			<img src=\""."$chemin"."espace$my_size.png\">
			<img src=\""."$chemin"."point$my_size.png\">
			<img src=\""."$chemin"."virgule$my_size.png\">
			<img src=\""."$chemin"."apostrophe$my_size.png\">
			<img src=\""."$chemin"."caractere_special$my_size.png\">
			";
		?>
	</div>
	<div class="font">
		<a href="#" id="debu" style="text-decoration: none;"></a>
		<a href="#" id="lien" style="text-decoration: none;"></a>
	</div>
	</div>


</div>
</body>
</html>