<?php
include "basedatos.php";
 
$query = mysql_query("select apellido from vendedor
where activo=1");

?>
<option selected="selected" > </option>
<?php
$numero=1;
while($row1=mysql_fetch_array($query))
{ ?>
 	
<option ><?php echo $row1['apellido'] ?></option> 

<?php
}
?>





