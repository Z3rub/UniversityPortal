<?php
    $db = new Database();
    $db->CheckUser(1);
    $errMsg = "";
    /////////////////////////////////////////
    if(!isset($_GET['eid'])){
        header("location: ../courses/index.php");
    }
    $e_id = $_GET['eid'];
    $sql = "SELECT * FROM tbl_exam WHERE ID = '$e_id';";
    $exam = $db->dbRecord($db->dbQuery($sql));
    if($db->numRows() == 0)
         header("location: ../courses/index.php");
    $id= $exam[2];
    ////////////////////////////////////////
    if(isset($_POST['btnEdit'])){
        $title = $_POST['txtname'];
        $time = $_POST['txttime'];
        $date = $_POST['txtdate'];
        if(isset($_POST['cbActive'])){
            $cb = 1;
        }
        else{
            $cb = 0;
        }
        $sql = "UPDATE tbl_exam SET 
            Title = '$title',
            e_time = '$time',
            e_date = '$date',
            is_active = '$cb'
            WHERE ID = $e_id;";
        $rs = $db->dbQuery($sql);
        header("location: ../exams/index.php?view=list&id=$id");
    }
    //////////////////////////////////////////
?>

<h4 class="page-head-line">New Exam</h4>
    
    <form action="" method="post" style="width: 30%; margin:50px;">
        <?php
            if($errMsg !="") {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $errMsg; ?>
        </div>
        <?php
            }
        ?>
        <!-- Add Exam Title -->
        <div >
            <label for="exampleInputEmail1">Exam Title</label>
            <input type="text" value="<?= $exam[1]?>" name="txtname" class="form-control" placeholder="Enter-Name">
        </div>
        <!-- Add Exam Date -->
        <div >
            <label for="exampleInputEmail1">Exam Date</label>
            <input type="date" value="<?= $exam[4]?>" name="txtdate" class="form-control" placeholder="E-mail">
        </div>
        <!-- Add Exam Duratiom/ Time -->
        <div >
            <label for="exampleInputPassword1">Exam Duration/ Time</label>
            <input type="number" value="<?= $exam[3]?>" name="txttime" class="form-control" placeholder="Enter By Minutes">
        </div>
        <!-- Determine is Active or Dis -->
        <div class="form-check"> 
            <label class="form-check-label">
                <input type="checkbox" name="cbActive" <?php if($exam[5]==1){?> checked <?php } ?> class="form-check-input">
                Active / Disactive
            </label>
        </div>
        <button type="submit" class="btn btn-primary" name="btnEdit">Edit Exam</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php?view=list&id=<?=$id?>'"name="btnCncl">
            Cancel
        </button>
    </form>