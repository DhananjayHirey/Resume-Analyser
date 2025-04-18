<?php


if($_SERVER['REQUEST_METHOD']=='POST'){

        $other_fac = $_POST['man_inp'];
        $other_fac_arr = explode(" ",$other_fac,-1);
        $year1 = $_POST['year1'];
        $year2 = $_POST['year2'];
        $year3 = $_POST['year3'];
        $uni = $_POST['uni'];
        $dept = $_POST['dept'];

        $keys = [];
        if(sizeof($other_fac_arr)>0){
            $keys = array_merge($keys,$other_fac_arr);
        }
        
        if(strlen($year1)>0){
            array_push($keys,$year1);
        }
        if(strlen($year2)>0){
            array_push($keys,$year2);
        }
        if(strlen($year3)>0){
            array_push($keys,$year3);
        }
        if(strlen($uni)>0){
            array_push($keys,$uni);
        }
        if(strlen($dept)>0){
            array_push($keys,$dept);
        }
        
        // var_dump($other_fac_arr);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user_details";

    //creating a connection
    $conn = mysqli_connect($servername,$username,$password,$database);
    $sql = "SELECT * FROM `info`";
    $result = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0){
        $finds = [];
        while($row = mysqli_fetch_assoc($result)){
            $push=true;

            for($i=0;$i<count($keys);$i++){

                
                if(!str_contains($row['file_text'],$keys[$i])){
                    $push=false;
                    break;
                }
                
            }
            if($push==true){
                if(strlen($row['file_ref'])>0){
                    $obj = [
                        'ref'=>$row['file_ref'],
                        'reg'=>$row['reg_number'],
                        'name'=>$row['full_name']
                    ];

                    array_push($finds,$obj);
                }

            }
        }
        echo json_encode($finds);
    }
}
?>