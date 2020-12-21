<?php 
$mes = date("n");
for ($i = 1; $i <= 12; $i++) { ?> 
<option <?php if ($mes == $i) echo "selected='selected' "; ?> value="<?php echo $i; ?>">
<?php 
switch($i)
          {
            case "01": $m = "Enero"; break;
            case "02": $m = "Febrero"; break;
            case "03": $m = "Marzo"; break;
            case "04": $m = "Abril"; break;
            case "05": $m = "Mayo"; break;
            case "06": $m = "Junio"; break;
            case "07": $m = "Julio"; break;
            case "08": $m = "Agosto"; break;
            case "09": $m = "Septiembre"; break;
            case "10": $m = "Octubre"; break;
            case "11": $m = "Noviembre"; break;
            case "12": $m = "Diciembre"; break;     
          }
echo $m; 
?>
</option> <?php } ?> 