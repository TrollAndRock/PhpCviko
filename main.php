<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
</head>
<?php
include 'DBlogin.php'
?>
<body>
<form method="POST" action="main.php">
	Znění otázky:
	<textarea name="otazka"></textarea>
	<input type="submit" value="Vložit" >
    
</form>

<?php
if (isset($_POST["otazka"])) {
    $nazev = addslashes($_POST["otazka"]);
if (!($con = mysqli_connect("sql5.webzdarma.cz", "jakubciganek2929", "Garridan1620marg*", "jakubciganek2929")))
{
	die("Nelze se připojit k databázovému serveru!</body></html>");
}
mysqli_query($con,"SET NAMES 'utf8'");

if (mysqli_query($con,
		"INSERT INTO AnketaOtazky (dotaz_ankety) VALUES('" .
		addslashes($_POST["otazka"]) . "')"))
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
if (!($con = mysqli_connect("sql5.webzdarma.cz", "jakubciganek2929", "Garridan1620marg*", "jakubciganek2929"))) 
{
    die("Nelze se připojit k databázovému serveru!</body></html>");
}
mysqli_query($con, "SET NAMES 'utf8'");
if (!($vysledek = mysqli_query($con, "SELECT id_ankety, dotaz_ankety 
FROM AnketaOtazky"))) 
{
    die("Nelze provést dotaz.</body></html>");
}
?>
<h1>Ankety</h1>
<?php
while ($radek = mysqli_fetch_array($vysledek)) 
{
?>
<h2> <a href="ankety/otazka.php?id=<?php echo $radek["id_ankety"];?>">Anketa číslo:<?php echo $radek["id_ankety"];?></a> </h2>
<p><?php echo $radek["dotaz_ankety"]; ?></p>
<?php

}
mysqli_free_result($vysledek);
mysqli_close($con);
?>

</body>
</html>
