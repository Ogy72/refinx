<?
include "../model/model_infrefill.php";
$get = new model_infrefill();

if(!empty($_POST)){

    $action = $_POST['action'];
    $get->month = date('m');
    $data = array();

    if($action == "dat-cartridge"){
    header('Content-Type: application/json');
        $dat = $get->get_cartridge();
        while($z = $get->fetch($dat)){
            $data[] = $z;
        }
    echo json_encode($data);
    }
    elseif($action == "dat-refill"){
        header('Content-Type: application/json');
        $dat = $get->count_refill();
        while($z = $get->fetch($dat)){
            $data[] = $z;
        }
    echo json_encode($data);
    }
    else{
        echo "none";
    }
}
?>