<?php
    $errMsg="";
    if(isset($_POST['btnAdd'])){
        $teachername = $_POST['txtname'];
        $t_email = $_POST['txtemail'];
        $password = $_POST['txtpass'];
        $t_date = $_POST['txtdate'];
    /*
        # this check status (isActive)
        # I didn't use it, so I commented it
        if(isset($_POST['cbActive'])){
            $cb = 1;
        }
        else{
            $cb = 0;
        }
    */
        #_ check if didn't enter Teacher Name
        if($teachername == ""){
            $errMsg ="Please, Enter Teacher Name ..";
        }
        #_ check if didn't enter Teacher Email
        else if($t_email == ""){
            $errMsg = "You must Enter Email, Please !";
        }
        #_ check if didn't enter Teacher Password
        else if($password == ""){
            $errMsg = "You can not left Password Empty ..";
        }
        #_ If All Data is Entered == Addition (Insert) will done !
        else{
            $sql = "select * from tbl_teachers where T_Email = '$t_email';";
            $rs = $db->dbQuery($sql);
            if($db->numRows() >= 1)
                $errMsg = "البريد الإلكتروني مسجلاً بالفعل";
            else {
                $uid = $_SESSION['u_id'];
                $sql = " INSERT INTO tbl_teachers
                            (T_Name, T_Email, T_Password, U_ID)
                            VALUES
                            ('$teachername', '$t_email', '$password', '$uid')";
                
                $rs = $db->dbQuery($sql);
                #    $sq = "SELECT `id` FROM `tbl_users` order by id desc limit 1";
                echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
            }
        }
    }
?>
<!- Form Begins->
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
    <!-- Add Teacher Name -->
    <div class="form-group">
        <label for="exampleInputEmail1">Full Name</label>
        <input type="text" name="txtname" class="form-control" placeholder="Full-Name">
    </div>
    <!-- Add Teacher Email -->
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name="txtemail" class="form-control" placeholder="E-mail">
    </div>
    <!-- Add Teacher Password -->
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="txtpass" class="form-control" placeholder="Password">
    </div>
<!--
    # I didn't use it, so I commented it
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" name="cbActive" class="form-check-input">
            فعال / غير فعال
        </label>
    </div>
-->
    <button type="submit" class="btn btn-primary" name="btnAdd">Add Teacher</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'"name="btnCncl">
        Cancel
    </button>
</form>