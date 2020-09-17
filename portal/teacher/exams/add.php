<?php
    $db = new Database();
    $db->CheckUser(1);
    $errMsg = "";
    /////////////////////////////////////////
    if(!isset($_GET['id'])){
        header("location: ../courses/index.php");
    }
    $id = $_GET['id'];

    ////////////////////////////////////////
    if(isset($_POST['btnAdd'])){
        $title = $_POST['txtname'];
        $time = $_POST['txttime'];
        $date = $_POST['txtdate'];
        if(isset($_POST['cbActive'])){
            $cb = 1;
        }
        else{
            $cb = 0;
        }
        $sql = "INSERT INTO tbl_exam(Title, tc_id, e_time, e_date, is_active)
                VALUES('$title','$id','$time', '$date', '$cb');";
        $rs = $db->dbQuery($sql);
        header("location: ../courses/index.php");
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
            <input type="text" name="txtname" class="form-control" placeholder="Enter-Name">
        </div>
        <!-- Add Exam Date -->
        <div >
            <label for="exampleInputEmail1">Exam Date</label>
            <input type="date" name="txtdate" class="form-control" placeholder="E-mail">
        </div>
        <!-- Add Exam Duratiom/ Time -->
        <div >
            <label for="exampleInputPassword1">Exam Duration/ Time</label>
            <input type="number" name="txttime" class="form-control" placeholder="Enter By Minutes">
        </div>
        <!-- Determine is Active or Dis -->
        <div class="form-check"> 
            <label class="form-check-label">
                <input type="checkbox" name="cbActive" class="form-check-input">
                Active / Disactive
            </label>
        </div>
        <button type="submit" class="btn btn-primary" name="btnAdd">Add Exam</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php?view=list&id=<?=$id?>'"name="btnCncl">
            Cancel
        </button>
    </form>