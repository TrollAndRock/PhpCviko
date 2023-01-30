<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prehled otazek a odpovedi</title>
</head>
<body>
    <header>
        <ul>
            <li><a href="QandA.php">Prehled</a></li>
            <li><a href="main.php">Vlozeni otazky</a></li>
        </ul>
    </header>

<?php 
if (isset($_GET['id'])) {
    if (!($con = mysqli_connect("sql5.webzdarma.cz", "jakubciganek2929", "Garridan1620marg*", "jakubciganek2929")))
    {
        die("Nelze se pripojit k databazovemu serveru!</body></html>");
    }
    mysqli_query($con, "SET NAMES 'utf8'");
    if (!($vysledek = mysqli_query($con,"UPDATE `odpovedi` SET `hlasy` = `hlasy` + '1' WHERE `odpovedi`.`id_odpovedi` = '". addslashes($_GET['id']) ."'"))) 
    {
        die("Nelze provest dotaz.</body></html>");
    }

}
?>

<?php
if (!($con = mysqli_connect("sql5.webzdarma.cz", "jakubciganek2929", "Garridan1620marg*", "jakubciganek2929"))) {
    die("Nelze se pripojit k databazovemu serveru!</body></html>");
}
mysqli_query($con, "SET NAMES 'utf8'");
if (
!($vysledek = mysqli_query(
$con,
"SELECT id_ankety, dotaz_ankety FROM AnketaOtazky"
))
) {
    die("Nelze provest dotaz.</body></html>");
}

?>

<?php while ($item = mysqli_fetch_array($vysledek)) { ?>
        <table border="1" border-color="black"  style="width: 600px;">
        <tr>
            <th>ID Otazky:</th>
            <td><?php echo $item['id_ankety']; ?></td>
        </tr>
        <tr>
            <th>Dotaz:</th>
            <td><?php echo $item['dotaz_ankety']; ?></td>
        </tr>
        <tr>
            <th>Odpoved</th>
            <td>Hodnoceni</td>
        </tr>
        
        <?php
    if (!($vysledekOdp = mysqli_query($con, "SELECT id_odpovedi, o.id_ankety, odpoved, hlasy FROM odpovedi as o WHERE o.id_ankety = '" . $item['id_ankety'] . "'"))) {
        die("Nelze provest dotaz.</body></html>");
    }
    else {
        while ($itemOdp = mysqli_fetch_array($vysledekOdp)) { ?>
            <tr>
                <td>
                    <?php echo $itemOdp['odpoved']; ?>
                </td>
                <td>
                    <a href="?id=<?php echo $itemOdp['id_odpovedi'] ?>"><?php echo $itemOdp['hlasy']; ?></a>
                </td>
            </tr>
    <?php
        }?>
        </td>
        </table>
    <?php
    }
    ?>
    <br/>
<?php 
}
mysqli_close($con); ?>
</body>
</html>