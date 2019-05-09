<?php
session_start();
require_once "connect.php";	
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
function get_data(){
    $connect = mysqli_connect("localhost","root","","pointer");
    $query ="Select imie,nazwisko from klienci limit 10";
    $result = mysqli_query($connect,$query);
    $data=array();
    $json="";
    while ($row = mysqli_fetch_array($result))
    {
        $data[] = array(
        'name' => $row['imie'],
        'surname' => $row['nazwisko'],
        'title' => 'Projekt Json',
        'date' => date('d-m-Y')
        
        );
        //echo json_encode($data)."#<br>";
        //$json.=json_encode($data);
        
    }
    //var_dump($data);
    // print_r ($data);
    //echo json_encode(utf8ize($data));
    return json_encode(utf8ize($data));
}

//echo 's<pre>';
//print_r (get_data());
//echo '</pre>e';
//get_data();

$file_name=date('d-m-Y').'.json';
if(file_put_contents($file_name, get_data())){
echo "dodano i stworzono";

}
else{
echo "jakiś problem" ;
}



?>