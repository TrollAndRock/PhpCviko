<?php
include 'DBlogin.php'
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
</head>
<body>
<?php
if (!($con = mysqli_connect($server,$login,$password,$database))) 
{
    die("Nelze se připojit k databázovému serveru!</body></html>");
}
mysqli_query($con, "SET NAMES 'utf8'");
if (!($vysledek = mysqli_query($con, "SELECT id_ankety, dotaz_ankety 
FROM anketaotazky"))) 
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