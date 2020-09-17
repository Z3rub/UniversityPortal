<?php
    $errMsg = "";
    $id = $_GET['id'];
    if($id == ''){
         echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
    }
    $sql = "Select * from tbl_teachers where T_ID = $id";
    $rs = $db->dbQuery($sql);
    if($db->numRows() == 0){
         echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
    }
    
    $row = $db->dbRecord($rs);

    if(isset($_POST['btnEdit'])){
        $un = $_POST['txtname'];
        $te = $_POST['txtemail'];
        $ps = $_POST['txtpass'];

        $sql = "SELECT * FROM tbl_teachers WHERE T_Email = '$te' and T_ID != $id;";
        $rs = $db->dbQuery($sql);
        if($db->numRows() >= 1)
            $errMsg = "البريد الإلكتروني مسجل بالفعل لدى معلم آخر";
        else {
            $sql = "UPDATE tbl_teachers SET
                        T_Name = '$un',
                        T_Email = '$te',
                        T_Password = '$ps' 
                    WHERE T_ID = $id; ";
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

    <div class="form-group">
        <label for="exampleInputEmail1">Full Name</label>
        <input type="text" value="<?= $row[1] ?>" name="txtname"
            class="form-control" placeholder="اسم المستخدم">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" value="<?= $row[2] ?>"  name="txtemail"
            class="form-control" placeholder="البريد الإلكتروني">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" value="<?= $row[3] ?>"  name="txtpass"
            class="form-control" placeholder="كلمة المرور">
    </div>

    <button type="submit" class="btn btn-primary" name="btnEdit">Edit Teacher</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'"name="btnCncl">Cancel</button>
</form>