<?php
    $db = new Database();
    $db->CheckUser();
    @$page = $_GET['page'];
    if(isset($page)){
        $page = $page;
    }
    else{
        $page = 1;
    }
    $row_per_page = 7;
    $start = ($page -1 ) * $row_per_page;
    $U_ID =  $_SESSION['u_id'];
    $sql = "select * from tbl_education
             where pid= '$U_ID'
             limit $start, $row_per_page";
    $rs = $db->dbQuery($sql);
    $rows = $db->row($rs);
?>

<!DOCTYPE html>
<html>
<head>
    <title>This is Demo Site</title>
    <script>
        function is_belong(sid) {
            var cid = document.getElementById("Teachers").value;
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    null;
                }
            };
            xhttp.open("GET", "stdcrs.php?sid="+sid+"&cid="+cid, true);
            xhttp.send();
        }

        function show_Teacher(cid) {
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("Teachers").innerHTML = this.responseText;
                    //window.alert(cid);
                }
            };
            xhttp.open("GET", "get_teachers.php?cid="+cid, true);
            xhttp.send();
        }

        function show_Student(pid, id, ik) {
            var xhttp;
            if(id==-1){
                pid = document.getElementById("Courses").value;
            }
            if(ik == 'B'){
                ik = document.getElementById("Teachers").value;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("Students").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "get_students.php?pid="+pid+"&id="+id+"&ik="+ik, true);
            xhttp.send();
        }

        function show(str, id, ik) { //UI
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(id==1){
                        document.getElementById("Assigns").innerHTML = this.responseText;
                        show(-1, 2,0);
                    }
                    if(id==2){
                        document.getElementById("Courses").innerHTML = this.responseText;
                        show(-1, 3,0);
                    }
                    if(ik ==1 && str != -1){
                        //window.alert(str+" "+id);
                        show_Student(str,id,'A');                        
                    }
                }
            };
            xhttp.open("GET", "get_collages.php?pid="+str+"&id="+id, true);
            xhttp.send();
        }

        function add(pid) {
            var str ;
            var id;
            var ele_id;
            if(pid == 1 ) {
                str = document.getElementById("in_Collages").value;
                id = "<?= $U_ID ?>";
                ele_id = "Collages";
                show_Student(id,0,'A');
            }
            else if (pid == 2) {
                str = document.getElementById("in_Assigns").value;
                id = document.getElementById("Collages").value;
                if(id == -1){
                    document.getElementById("c_alert").innerHTML = "يرجى إختيار جامعة";
                    return;
                }
                ele_id = "Assigns";
                show_Student(id,1,'A');
            }
            else if (pid == 3) {
                str = document.getElementById("in_Courses").value;
                id = document.getElementById("Assigns").value;
                if(id == -1 || id == ""){
                    document.getElementById("a_alert").innerHTML = "يرجى اختيار كلية";
                    return;
                }
                ele_id = "Courses";
                show_Student(id,2,'A');
            }

            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(ele_id).innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "add.php?st="+str+"&id="+id, true);
            xhttp.send();
        }
    </script>
</head>
<body>
    <div class="row ">
        <div class="panel-heading">
            <div class="panel-title">Faculties List</div>
        </div>
        <div class="panel-body">
            <form action="">
                <!__ Choose A Collage __!>
                <div class="content-box col-sm-3">
                    <div class="form-group">
                        <select class="form-control " id="Collages" name= "Collages" onchange="show(this.value,1,1)">
                            <option value="-1">Choose A Faculty</option>
                            <?php
                                foreach ($rows as $row) {
                            ?>
                            <option value="<?= $row[0] ?>"><?= $row[1] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="in_Collages" type="" name="in_Collages">
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-primary" type="button" onclick="add(1)">Add New Faculty</button>
                    </div>
                </div>
                <!__ Choose A Department __!>
                <div class="content-box col-sm-3">
                    <div class="form-group">
                        <select class="form-control form-control-lg" name="Assigns" id="Assigns" onchange="show(this.value, 2,1)" >
                            <option value="-1">Choose A Department</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="in_Assigns" type="" name="in_Assigns">
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-primary" type="button" onclick="add(2)">Add New Department</button>
                    </div>
                </div>
                <!__ Choose An Courses __!>
                <div class="content-box col-sm-3">
                    <div class="form-group">
                        <select class="form-control form-control-lg" name="Courses" id="Courses" onchange="show_Teacher(this.value)">
                            <option value="">Choose A Course</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="in_Courses" type="" name="in_Courses">
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-primary" type="button" onclick="add(3)">Add New Course</button>
                    </div>
                </div>
                <!__ Choose A Teachers __!>
                <div class="content-box col-sm-3">
                    <div class="form-group">
                        <select class="form-control form-control-lg" name="Teachers" id="Teachers" onchange="show_Student(0,-1,'B')">
                            <option value="">Choose A Teacher</option>
                        </select>
                    </div>
                </div>
            </form>

            <div class="panel-body col-sm-9">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Is Registered</th>
                        </tr>
                    </thead>
                    <tbody id="Students" name="Students">
                    </tbody>
                </table>
                <?php
                    $sql = "select * from tbl_students where S_Assign in (
                                select id from tbl_education where pid in (
                                    select id from tbl_education where pid in (
                                        select id from tbl_education where pid  = '$U_ID')))";
                    $rs1 = $db->dbQuery($sql);
                    $total_record = $db->numRows($rs1); //3
                    $total_pages = ceil($total_record / $row_per_page);
                    //echo $total_pages;
                    //1
                    if($page != 1)
                        $prevpage = $page - 1;
                    if($page != $total_pages)
                        $nextpage = $page + 1;
                ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if($page ==1){ ?> disabled <?php } ?>">
                            <a class="page-link" href="?page=<?= $prevpage ?>" tabindex="-1">
                                        Previous
                            </a>
                        </li>
                        <?php
                            for($i=1; $i <=$total_pages; $i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php if($total_record !=0){?>
                        <li class="page-item <?php if($page ==$total_pages){ ?> disabled <?php } ?>">
                            <a class="page-link" href="?page=<?= $nextpage ?>">Next</a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
        </div>
    </div>
</body>
</html>