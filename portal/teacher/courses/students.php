<?php
   $db = new Database();
   $db->CheckUser(1);
   $cid = $_GET['id'];
   @$page = $_GET['page'];
    if(isset($page)){
        $page = $page;
    }
    else{
        $page = 1;
    }
    $row_per_page = 5;
    $start = ($page -1 ) * $row_per_page;
   $t_id = $_SESSION['tr_id'];
   $sql = " SELECT s.S_ID, s.S_Name FROM tbl_stdcrs sc
            JOIN tbl_students s ON s.S_ID = sc.STUDENT_ID
            WHERE sc.COURSE_ID = '$cid'
            limit $start, $row_per_page"; 
    $db->dbQuery($sql);
    $rows = $db->row();
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <div class="row">
        <h4 class="page-head-line">
            <icon class="glyphicon glyphicon-book"></icon>
            Courses List
        </h4>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($db->numRows() > 0){
                                foreach ($rows as $row) {
                        ?>
                        <tr>
                            <th><?= $row[0] ?></th>
                            <td><?= $row[1] ?></td>
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
                    </tbody>
                </table>
                <?php
                    $sql = "SELECT s.S_ID, s.S_Name FROM tbl_stdcrs sc
                            JOIN tbl_students s ON s.S_ID = sc.STUDENT_ID
                            WHERE sc.COURSE_ID = '$cid'";
                    //$rs1 = $db->dbQuery($sql);
                    $total_record = $db->numRows($db->dbQuery($sql)); //
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
</body>
</html>