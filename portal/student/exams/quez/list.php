<?php
    $db = new Database();
    $db->CheckUser(0);
    $errMsg = "";
    ////////////////////////////////////////
   @$page = $_GET['page'];
    if(isset($page)){
        $page = $page;
    }
    else{
        $page = 1;
    }
    $start = ($page -1 ) * 1;
    ///////////////////////////////////////
    if(!isset($_GET['qid'])){
        header("location: ../courses/index.php");
    }

    $q_id = $_GET['qid'];
    $sql = "SELECT * FROM tbl_mcq
            WHERE Exam_ID = $q_id
            limit $start, 1";
    $rs = $db->dbQuery($sql);
    $row = $db->dbRecord($rs);    

    //Paras 4 function
    $st_id = $_SESSION['st_id'];
    $qt_id = $row[0];
    
    //If Answer It Befor
    $sql = "SELECT st_ans FROM tbl_student_answer
                WHERE ST_ID = '$st_id'
                AND Q_ID = '$qt_id';";
    if($db->numRows($db->dbQuery($sql)) == 1){
        $urans = $db->dbRecord()[0];
    }
    else
        $urans = -1;
    /////////////////////////////////////

    $esql = "SELECT * FROM tbl_exam WHERE ID = '$q_id';";
    $exam_tit = $db->dbRecord($db->dbQuery($esql))[1];

?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <div class="row">
        <h4 class="page-head-line">
            <icon class="glyphicon glyphicon-tasks"></icon>
                <?= $exam_tit ?> | Quez List
        </h4>
         <form  action="" method="post" >
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" align="Center"><?=$row[1]?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>A</th>
                            <th><?=$row[2]?></th>
                            <th><input name="ck_ans" id="ck_1" onclick="ans(this.value)" value="1" type = "radio" <?php if($urans==1){ ?> checked <?php }?>></th>
                        </tr>
                        <tr>
                            <th>B</th>
                            <th><?=$row[3]?></th>
                            <th><input name="ck_ans" id="ck_2" onclick="ans(this.value)" value="2" type = "radio"
                                <?php if($urans==2){ ?> checked <?php }?> ></th>
                        </tr>
                        <tr>
                            <th>C</th>
                            <th><?=$row[4]?></th>
                            <th><input name="ck_ans" id="ck_3" onclick="ans(this.value)" value="3" type = "radio" <?php if($urans==3){ ?> checked <?php }?> ></th>
                        </tr>
                        <tr>
                            <th>D</th>
                            <th><?=$row[5]?></th>
                            <th><input name="ck_ans" id="ck_4" onclick="ans(this.value)" value="4" type = "radio" <?php if($urans==4){ ?> checked <?php }?>></th>
                        </tr>
                    </tbody>
                </table>
                <?php
                    $sql = "SELECT * FROM tbl_mcq
                            WHERE Exam_ID = $q_id";
                    $rs1 = $db->dbQuery($sql);
                    $total_record = $db->numRows($rs1); //3
                    $total_pages = $total_record;
                    //echo $total_pages;
                    //1
                    if($page != 1)
                        $prevpage = $page - 1;
                    if($page != $total_pages)
                        $nextpage = $page + 1;
                ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if($page !=1){ ?> 
                        <li class="page-item ">
                            <a class="page-link" href="?view=list&qid=<?=$q_id?>&page=<?= $prevpage ?>" tabindex="-1">
                                        Previous
                            </a>
                        </li>
                        <?php } ?>
                        <?php
                            for($i=1; $i <=$total_pages; $i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?view=list&qid=<?=$q_id?>&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php if($total_record !=0){?>
                            <?php if($page != $total_pages){ ?> 
                            <li class="page-item ">
                                <a class="page-link" href="?view=list&qid=<?=$q_id?>&page=<?= $nextpage ?>">Next</a>
                            </li>
                            <?php }
                            else{ ?>
                            <li class="page-item ">
                                <a class="page-link" href="../../courses">Finish</a>
                            </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </form>
    </div>

    <script>

        function ans(aid) {
            var sid = "<?= $st_id ?>";
            var qid = "<?= $qt_id ?>";
            
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById(ele_id).innerHTML = this.responseText;
                    //window.alert(this.responseText);
                    null;
                }
            };
            xhttp.open("GET", "add.php?sid="+sid+"&qid="+qid+"&aid="+aid, true);
            xhttp.send();
        }
    </script>
</body>
</html>