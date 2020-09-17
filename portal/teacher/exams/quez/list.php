<?php
    $db = new Database();
    $db->CheckUser(1);
    $errMsg = "";
    ////////////////////////////////////////
   @$page = $_GET['page'];
    if(isset($page)){
        $page = $page;
    }
    else{
        $page = 1;
    }
    $row_per_page = 5;
    $start = ($page -1 ) * $row_per_page;
    ///////////////////////////////////////
    if(!isset($_GET['id'])){
        header("location: ../courses/index.php");
       // echo "<meta http-equiv='refresh' content='0;URL=../courses/index.php?view=list'>";
    }
    $id = $_GET['id'];
    $sql = "SELECT e.Title from tbl_teacrs tc
            JOIN tbl_education e on e.ID = tc.course_id
            WHERE tc.id = '$id'";
    $crs_title = $db->dbRecord($db->dbQuery($sql))[0];
    /////////////////////////////////////////////////////
    $sql = "SELECT * FROM tbl_exam e
            JOIN tbl_teacrs tc on tc.id = e.tc_id 
            where e.tc_id = $id
            limit $start, $row_per_page";
    $rs = $db->dbQuery($sql);
    $rows = $db->row($rs);
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <div class="row">
        <h4 class="page-head-line">
            <icon class="glyphicon glyphicon-tasks"></icon>
                <?= $crs_title ?> | Exams List
        </h4>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exam Title</th>
                            <th>Exam Date</th>
                            <th>Exam Duration</th>
                            <th>Full Mark</th>
                            <th>Is Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <?php
                            if($db->numRows($rs) > 0){
                                foreach ($rows as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?= $row[0] ?></th>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[4] ?></td>
                            <td><?= $row[3] ?></td>
                            <td>0</td>
                            <td>
                                <?php 
                                    if($row[5] == 1){
                                ?>
                                <icon style="color: green;" class="glyphicon glyphicon-play"></icon>
                                <?php } if($row[5] == 0){ ?>
                                <icon style="color: red;" class="glyphicon glyphicon-pause"></icon>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="index.php?view=add&id=<?=$id?>">
                                    <i class="glyphicon glyphicon-plus-sign"></i>
                                </a>
                                <li class="glyphicon">|</li>
                                <a href="index.php?view=modify&eid=<?= $row[0] ?>">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                <li class="glyphicon">|</li>
                                <a href="delete.php?eid=<?= $row[0] ?>" onclick="return confirm('Are You Sure!');">
                                    <i class="glyphicon glyphicon-remove-circle"></i>
                                </a>
                                <li class="glyphicon">|</li>
                                
                                <a href="index.php?view=course&id=<?= $row[0] ?>">
                                    <i class="glyphicon glyphicon-list" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                         <?php
                                }
                            }
                            else{
                        ?>
                        <tr>
                            <td colspan="5" align="Center"> لا يوجد بيانات حتى الآن </td>
                        </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                    </tbody>
                </table>
                <?php
                    $sql = "SELECT * FROM tbl_exam e
                            JOIN tbl_teacrs tc on tc.id = e.tc_id 
                            WHERE e.tc_id = $id";
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
                        <?php 
                            if($total_record == 0){
                        ?>
                        <li class="page-item <?php if($page ==$total_pages){ ?> disabled <?php } ?>">
                            <a class="page-link" href="index.php?view=add&id=<?= $id ?>">Add New Exam</a> 
                        </li>
                        <?php } ?>
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
</body>
</html>