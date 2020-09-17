<?php
    $errMsg = "";
    $id = $_GET['id'];
    if($id == ''){
         echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
    }
    $sql = "Select * from tbl_students where S_ID = $id";
    $rs = $db->dbQuery($sql);
    if($db->numRows() == 0){
         echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
    }
    
    $row = $db->dbRecord($rs);

    if(isset($_POST['btnEdit'])){
        $un = $_POST['txtname'];
        $te = $_POST['txtemail'];
        $ps = $_POST['txtpass'];

        if (!empty($_POST['Active'])) {
            $cb = 1;
        }
        else{
            $cb = 0;
        }
        $sql = "SELECT * FROM tbl_students WHERE S_Email = '$te' and S_ID != $id;";
        $rs = $db->dbQuery($sql);
        if($db->numRows() >= 1)
            $errMsg = "البريد الإلكتروني مسجل بالفعل لدى معلم آخر";
        else {
            $sql = "UPDATE tbl_students SET
                        S_Name = '$un',
                        S_Email = '$te',
                        S_Password = '$ps',
                        S_IsActive = '$cb'
                    WHERE S_ID = $id; ";
            $rs = $db->dbQuery($sql);
            echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
        }
    }
?>

<form action="" method="post" style="width: 30%; margin:50px;">
    <?php
        if($errMsg !=""){
    ?>
    <div class="alert alert-danger" role="alert">
        <?= $errMsg; ?>
    </div>
    <?php
        }
    ?>

    <div class="content">
        <div class="panel-body">
            <form action="" method="post">
                <fieldset>
                    <div class="form-group">
                        <label>Name</label>
                        <input name="txtname" value="<?= $row[1] ?>" class="form-control" placeholder="Name" type="text">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="txtemail" value="<?= $row[2] ?>" class="form-control" placeholder="Email" type="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="txtpass" value="<?= $row[3] ?>" class="form-control" placeholder="Password" type="password" value="mypassword">
                    </div>
                    
                    <div class="checkbox">
                        <label>
                            <input name="Active" type="checkbox" <?php if($row[5]==1){?> checked <?php } ?>>
                            Is Active 
                        </label>
                    </div>
                </fieldset>
                <div>
                    <button type="submit" class="btn btn-primary" name="btnEdit">Edit Student</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'"name="btnCncl">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</form>