<?php
    $db = new Database();
    $U_ID = $_SESSION['u_id'];
    function select_data($p_id) {
        $e_sql = "SELECT * FROM tbl_education
                WHERE PID = '1';";
        $rse = $db->dbQuery($e_sql);
        $r_edu = $db->row($rse);
        echo "Hello";
        return $r_edu;
    }

    $errMsg="";
    if(isset($_POST['btnAdd'])){
        $stdname = $_POST['txtname'];
        $t_email = $_POST['txtemail'];
        $password = $_POST['txtpass'];
        $t_date = $_POST['txtdate'];
        $t_assign = $_POST['Assign'];
        
        if(isset($_POST['cbActive'])){
            $cb = 1;
        }
        else{
            $cb = 0;
        }
        #_ check if didn't enter Student Name
        if($stdname == ""){
            $errMsg ="Please, Enter Stdudent Name ..";
        }
        #_ check if didn't enter Student Email
        else if($t_email == ""){
            $errMsg = "You must Enter Email, Please !";
        }
        #_ check if didn't enter Student Password
        else if($password == ""){
            $errMsg = "You can not left Password Empty ..";
        }
        #_ If All Data is Entered == Addition (Insert) will done !
        else{
            $sql = "select * from tbl_students where T_Email = '$t_email';";
            $rs = $db->dbQuery($sql);
            if($db->numRows() >= 1)
                $errMsg = "البريد الإلكتروني مسجلاً بالفعل";
            else {
                $sql = " INSERT INTO tbl_students
                            (S_Name, S_Email, S_Password, S_Assign, S_IsActive)
                            VALUES
                            ('$stdname', '$t_email', '$password', '$t_assign', '$cb')";
                
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
    <div>
        <h4>Select Department</h4>
        <p>
            <select name="Assign" class="form-control form-control-lg">
                <?php
                    // Choose Faculty
                    $c_sql = "SELECT ID, Title FROM tbl_education ed WHERE PID = '$U_ID' and ID in (SELECT PID FROM tbl_education WHERE PID = ed.ID)";
                    $rs_c = $db->dbQuery($c_sql);
                    $c_rows = $db->row();
                    foreach ($c_rows as $c_row ) {
                ?>
                <optgroup label="<?= $c_row[1] ?>">
                    <?php 
                        // Choose Department
                        $sql = "SELECT * FROM tbl_education WHERE PID = $c_row[0];";
                        $rs_d = $db->dbQuery($sql);
                        $d_rows = $db->row();
                        foreach ($d_rows as $d_row ) {
                        ?>
                            <option value="<?= $d_row[0] ?>">
                            <?= $d_row[1] ?>
                            </option>
                    <?php } ?>
                </optgroup>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" name="cbActive" class="form-check-input">
            Active / Disactive
        </label>
    </div>
    <button type="submit" class="btn btn-primary" name="btnAdd">Add Student</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'"name="btnCncl">
        Cancel
    </button>
</form>