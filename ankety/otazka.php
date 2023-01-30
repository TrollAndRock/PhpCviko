
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Otazka</title>
</head>
<body>
<form method="POST">
	Znění odpovědi:
	<textarea name="odpoved"></textarea>
    <br>
    <input name="idAnkety" type="hidden" value="<?php echo htmlspecialchars($_GET["id"]) ?>">
	<input type="submit" value="Vložit" >
    <button><a href="../main.php"> Zpět </a></button>  
</form>
<?php

if (isset($_POST["odpoved"])) {
    $nazev = addslashes($_POST["odpoved"]);
if (!($con = mysqli_connect("sql5.webzdarma.cz", "jakubciganek2929", "Garridan1620marg*", "jakubciganek2929")))
{
	die("Nelze se připojit k databázovému serveru!</body></html>");
}
mysqli_query($con,"SET NAMES 'utf8'");

if (mysqli_query($con,
		"INSERT INTO odpovedi (odpoved, id_ankety) VALUES('" .
		addslashes($_POST["odpoved"]) . "', '" .
        addslashes($_POST["idAnkety"]) . "')")) 
{
	echo "Úspěšně vloženo.";
}
else
{
	echo "Nelze provést dotaz. " . mysqli_error($con);
}
mysqli_close($con); 
}
?>
<?php
if (isset($_GET["id"])){
    $id = addslashes($_GET["id"]);
    if (!($con = mysqli_connect("sql5.webzdarma.cz", "jakubciganek2929", "Garridan1620marg*", "jakubciganek2929"))) {
        die("Nelze se připojit k databázovému serveru!</body></html>");
    }   
    mysqli_query($con,"SET NAMES 'utf8'");
    if (!($vysledek = mysqli_query($con, "SELECT id_ankety, dotaz_ankety FROM AnketaOtazky WHERE id_ankety = '$id'"))) {
        die("Nelze provést dotaz.</body></html>");
    }
    if (!($vysledek1 = mysqli_query($con, "SELECT odpoved FROM odpovedi WHERE id_ankety = '$id'"))) {
        die("Nelze provést dotaz.</body></html>");
    }
?>
<h1>Otazka:</h1>
<?php
    while ($radek = mysqli_fetch_array($vysledek)) {
?>
	<h2><?php echo $radek["id_ankety"];?></h2>		
	<p><?php echo $radek["dotaz_ankety"];?></p>    
    
<?php   
    }
    mysqli_free_result($vysledek);
?>
<h1>Odpovedi</h1>
<?php
    while ($radek1 = mysqli_fetch_array($vysledek1)) {
?>
	
    <p><?php echo $radek1["odpoved"];?></p>
    
<?php   
    }
    mysqli_free_result($vysledek1);
    mysqli_close($con);
}
?>


</table>
</body>
</head>