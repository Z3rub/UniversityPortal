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
        $ed = $_POST['txtedu'];
        $td = $_POST['txtdate'];

        $Today = date('Y-m-d');
        $sql = "SELECT * FROM tbl_teachers WHERE T_Email = '$te' and T_ID != $id;";
        $rs = $db->dbQuery($sql);
        if($db->numRows() >= 1)
            $errMsg = "البريد الإلكتروني مسجل بالفعل لدى معلم آخر";
        elseif (@($Today - $td) < 23)
            $errMsg = "يجب ألا يقل عمر المعلم عن 23 عام";
        elseif ($ed == 'الماجستير' && @($Today - $td) < 26)
            $errMsg = "حملة الماجستير لا يقل أعمارهم عن 26 عام";
        else {
            $sql = "UPDATE tbl_teachers SET
                        T_Name = '$un',
                        T_Email = '$te',
                        T_Password = '$ps',
                        T_Edudeg = '$ed',
                        T_Birthdate = '$td' 
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
        <label for="exampleInputEmail1">الإسم كاملاً</label>
        <input type="text" value="<?= $row[1] ?>" name="txtname"
            class="form-control" placeholder="اسم المستخدم">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">البريد الإلكتروني</label>
        <input type="email" value="<?= $row[2] ?>"  name="txtemail"
            class="form-control" placeholder="البريد الإلكتروني">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">كلمة المرور</label>
        <input type="password" value="<?= $row[3] ?>"  name="txtpass"
            class="form-control" placeholder="كلمة المرور">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">المؤهل العلمي</label>
        <input type="text" value="<?= $row[4] ?>"  name="txtedu"
            class="form-control" placeholder="المؤهل العلمي">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">تاريخ الميلاد</label>
        <input type="date" value="<?= $row[5] ?>"  name="txtdate"
            class="form-control" placeholder="تاريخ الميلاد">
    </div>

    <button type="submit" class="btn btn-primary" name="btnEdit">تعديل مستخدم</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'"name="btnCncl">إلغاء التعديل</button>
</form>