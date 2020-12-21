<?php 
$anio= date("Y");
for ($i = 1980; $i <= 2070; $i++) { ?> 
<option <?php if ($anio == $i) echo "selected='selected' "; ?> ><?php echo $i; ?></option> 
<?php 
} 
?> 