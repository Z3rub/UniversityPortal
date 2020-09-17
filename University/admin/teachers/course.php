<?php
    $errMsg = "";
    $id = $_GET['id'];
    if($id == ''){
         echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
    }
    $U_ID = $_SESSION['u_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script>
        window.onload = Show_Course();
        function Add_Course() {
            var xhttp;
            var it = <?= $id ?>;
            var ic = document.getElementById("Courses").value;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("add_alert").innerHTML = this.responseText;
                    Show_Course();
                }
            };
            xhttp.open("GET", "action.php?it="+it+"&ic="+ic, true);
            xhttp.send();
        }
        
        function Show_Course() {
            //window.alert("Hahahaha");
            var xhttp;
            var it = <?= $id ?>;
            var ic = "-1";
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("Show_Courses").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "action.php?it="+it+"&ic="+ic, true);
            xhttp.send();
        }
        
    </script>
</head>
<body>
<div class="row">
    <div class="col-md-12">
        <div class="panel-body">
            <div id="rootwizard">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a href="#tab1" data-toggle="tab">Courses</a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab">Add New</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="col-md-6">
                            <?php 
                                $sql = "SELECT T_Name FROM tbl_teachers WHERE T_ID = '$id';";
                                $rs = $db->dbQuery($sql);
                                $row = $db->dbRecord();
                            ?>
                            <label for="inputEmail3" class="col-sm-6 control-label">
                                <?= $row[0] ?>
                            </label>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Title</th>
                                    <th>Notes</th>
                                </tr>
                                </thead>
                                <tbody id="Show_Courses" name="Show_Courses">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="col-md-6">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Select A Course</label>
                                    <div class="col-sm-6">
                                        <select id="Courses" name="Courses" class="form-control form-control-lg">
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
                                                    $sql = "SELECT ID, Title FROM tbl_education ed WHERE PID = '$c_row[0]' and ID in (SELECT PID FROM tbl_education WHERE PID = ed.ID)";
                                                    $rs_d = $db->dbQuery($sql);
                                                    $d_rows = $db->row();
                                                    foreach ($d_rows as $d_row ) {
                                                ?>
                                                <optgroup label="<?= $d_row[1] ?>">
                                                        <?php 
                                                            // Choose Course
                                                            $sql = "SELECT * FROM tbl_education WHERE PID = $d_row[0];";
                                                            $rs_c = $db->dbQuery($sql);
                                                            $c_rows = $db->row();
                                                            foreach ($c_rows as $c_row ) {
                                                        ?>
                                                            <option value="<?= $c_row[0] ?>">
                                                                <?= $c_row[1] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </optgroup>
                                                <?php } ?>
                                            </optgroup>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-default" type="button">
                                                    Cancel
                                            </button>
                                            <button class="btn btn-success" type="button" onclick="Add_Course()">
                                                <i class="fa fa-save"></i>
                                                    Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <br>
                                    <div id="add_alert" class="col-md-12">
                                    </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>