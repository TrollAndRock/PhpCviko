<?php
include 'DBlogin.php'
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Otazka</title>
</head>
<body>

<?php
    if (!($con = mysqli_connect($server,$login,$password,$database))) {
        die("Nelze se připojit k databázovému serveru!</body></html>");
    }   
    mysqli_query($con,"SET NAMES 'utf8'");
    if (!($vysledek = mysqli_query($con, "SELECT id_ankety, dotaz_ankety FROM anketaotazky "))) {
        die("Nelze provést dotaz.</body></html>");
    }
    mysqli_query($con2,"SET NAMES 'utf8'");
    if (!($vysledek1 = mysqli_query($con, "SELECT odpoved FROM odpovedi WHERE id_ankety = '$id'"))) {
        die("Nelze provést dotaz.</body></html>");
    }
?>
<?php
    do {
?>
	<h2><?php echo $radek["id_ankety"];?></h2>		
	<p><?php echo $radek["dotaz_ankety"];?></p> 
    <?php
    do {
    ?>
    }







<?php   
    }
    while ($radek = mysqli_fetch_array($vysledek));
    mysqli_free_result($vysledek);
    mysqli_close($con);

?>

</table>
</body>
</head>