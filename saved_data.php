<?php

// print_r($_POST);

require "Database.php";
error_reporting(E_ALL);
$database = new Database();
$db = $database->getConnection();
// echo '<pre>';
// print_r($_POST);
// exit;
if (!empty($_POST['submit'])) {
    $length = count($_POST['unitprc']);
    $i = 0;

    for ($i = 0; $i < $length; $i++)  {
        $username = $_POST['username'][$i];
        $email = $_POST['email'][$i];
        $mobile = $_POST['mobile'][$i];
        $address = $_POST['address'][$i];
        $qty = $_POST['qty'][$i];
        $unitprc = $_POST['unitprc'][$i];
        $total = $_POST['total'][$i];
        $option_val = isset($_POST['option'][$i]) ? $_POST['option'][$i] : null;

        $stmt = $db->prepare("INSERT INTO  userinfo (`username`,`email`,`mobile`,`address`,
       `qty`,`price`,`total`,`option_val`) values (:username,:email,:mobile,:address,:qty,:price,:total,:option_val)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':price', $unitprc);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':option_val', $option_val);
        $stmt->execute();
        $i++;
    }
    $_POST = [];
    header("Location:action.php");
    exit();

}
// exit('hello');

$stmt = $db->prepare("SELECT username, email,mobile,address,qty,price,
total, option_val from userinfo");
$stmt->execute();

$objects = $stmt->fetchAll();
// echo '<pre>';
// print_r($objects);
// exit;
$data = [];
foreach ($objects as $key => $v) {
    if ($v['option_val'] !== null) { 
    $data[$v['option_val']][] = [
        'username' => $v['username'],
        'email' => $v['email'],
        'mobile' => $v['mobile'],
        'address' => $v['address'],
        'qty' => $v['qty'],
        'price' => $v['price'],
        'total' => $v['total'],
        'option_val'=>$v['option_val']

    ];
}
}
// if ($stmt->rowCount() >= 1) {
//     // echo("Updated");
    
//  }
//  else
//  {
//      echo("ERROR");
//  }



// echo '<pre>';
// print_r($data);

// exit;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <style>
        .button {
            margin: 10px;
        }

        . #savecontainer {
            padding: 15px;
            margin: 11px;
        }

        .striped-table {
            width: 100%;
            border-collapse: collapse;
        }

        .striped-table thead th {
            background-color: #f2f2f2;
        }

        .striped-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .striped-table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .striped-table td,
        .striped-table th {
            padding: 8px;
            border: 1px solid #dddddd;
        }
    </style>
</head>

<body>
    <h1 style="text-align:center">Saved Data</h1>
    <a class="btn btn-primary" href="add_data.php" role="button">Add Data</a>
    <?php
    foreach ($data as $key => $val) { ?>
        <div id="savecontainer">
            Option:
            <?php echo $key ?>
            <!-- <input type="hidden" value="1"  name="option[]"></td> -->
            <div id="saveparentdiv">
                <table class="table table-bordered striped-table" id="savetable" style="width:100%">
                    <thead>
                        <tr>

                            <td>Name</td>
                            <td>Email</td>
                            <td>Mobile</td>
                            <td>Address</td>
                            <td>Qty</td>
                            <td>Unit Price</td>
                            <td>Total</td>
                            <td>option</td>

                        </tr>

                    </thead>
                    <tbody id="save_show_row">

                      
                           <?php 
                        //    foreach($val as $k1=>$v1){
                            foreach($val as $v1){
                             ?>
                            <tr id="save_row">
                                <td>
                                    <?= $v1['username'] ?>
                                </td>
                                <td>
                                    <?= $v1['email']; ?>
                                </td>
                                <td>
                                    <?php echo $v1['mobile']; ?>
                                </td>
                                <td>
                                    <?php echo $v1['address']; ?>
                                </td>
                                <td>
                                    <?php echo $v1['qty']; ?>
                                </td>
                                <td>
                                    <?php echo $v1['price']; ?>
                                </td>
                                <td>
                                    <?php echo $v1['total']; ?>
                                </td>
                                <td>
                                    <?php echo $v1['option_val']; ?>
                                </td>

                            </tr>
                        <?php 
                        }?>
                    </tbody>

                </table>

            </div>
        <?php } ?>

</body>

</html>