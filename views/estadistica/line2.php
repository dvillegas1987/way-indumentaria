<?php


$link=mysql_connect("localhost", "root", "12qwaszx");
mysql_select_db("way",$link) OR DIE ("Error: No es posible establecer la conexión");
    

if(isset($_POST['mesdesde']) and (($_POST['mesdesde'])!=0)  and  isset($_POST['aniodesde']) and (($_POST['aniodesde'])!=0) and isset($_POST['meshasta']) and (($_POST['meshasta'])!=0) and isset($_POST['aniohasta']) and (($_POST['aniohasta'])!=0))
    {
        $mesdesde=$_POST['mesdesde'];
        $aniodesde=$_POST['aniodesde'];
        $meshasta=$_POST['meshasta'];
        $aniohasta=$_POST['aniohasta']; 
        $ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
    } else {
        $mesdesde=date('n');
        $aniodesde=date('Y');
        $meshasta=date('n');
        $aniohasta=date('Y');   
        $ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
    }
        
    $fechadesde=$aniodesde."-".$mesdesde."-01";
    $fechahasta=$aniohasta."-".$meshasta."-".$ultimodiameshasta;





 /*-----------------------------------------------------------------------------------------------------*/
//funcion para obtener categorias
function getcategory($start,$end){

   $range = array();

    $range['name']='mesanio';

    if (is_string($start) === true) $start = strtotime($start);
    if (is_string($end) === true ) $end = strtotime($end);

    if ($start > $end) return createDateRangeArray($end, $start);

    do {
        $range['data'][] = date('M Y', $start);
        $start = strtotime("+ 1 month", $start);
    } while($start <= $end);

    return $range;

}       




/*-----------------------------------------------------------------------------------------------*/
//funcion para obtener multiples series
function getseries($cod,$ape,$fdesde,$fhasta){

    mysql_query("set names 'utf8'");
    $query2 = mysql_query("select v.fecha_venta,ifnull(v.importe,0) as imp
     from ventas v, vendedores ven
     where v.vendedor = ven.id and v.fecha_venta>='".$fdesde."' and v.fecha_venta<='".$fhasta."' and ven.id = ".$cod." ");

    $series=array();
    $series['name'] = $ape;
  
    while($r = mysql_fetch_array($query2)){

        $series['data'][] = $r['imp']+0;    

    }

    return $series;
}




/*--------------------------------------------------------------------------------------------*/
//genero series por vendedor 
$query_vend = mysql_query("select id,apellido from vendedores");

$result = array();

$rows1 = getcategory('2017-01-01','2017-08-02');
array_push($result, $rows1);

while($rr = mysql_fetch_array($query_vend)){

    $rows2= getseries($rr['id'],$rr['apellido'],'2017-01-01','2017-08-02');
    
    array_push($result,$rows2); 
 
}


/*--------------------------------------------------------------------------------------------*/
//imprimo objeto json
print json_encode($result);

?> 
