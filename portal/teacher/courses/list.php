<?php
   $db = new Database();
   $db->CheckUser(1);
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
   $sql = " SELECT tc.id, c.Title from tbl_teacrs tc
            join tbl_teachers t on t.T_ID = tc.teacher_id
            join tbl_education c on c.ID = tc.course_id
            WHERE tc.teacher_id = '$t_id'
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
                            <th>Title</th>
                            <th># of Students</th>
                            <th># of Exams</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($db->numRows() > 0){
                                foreach ($rows as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?= $row[0] ?></th>
                            <td><?= $row[1] ?></td>
                            <td>
                                <?php
                                $csql = "SELECT COUNT(*) FROM tbl_stdcrs WHERE COURSE_ID = '$row[0]';";
                                echo $db->dbRecord($db->dbQuery($csql))[0];
                                ?>
                            </td>
                            <td>
                                <?php
                                    $csql = "SELECT COUNT(*) FROM tbl_exam WHERE tc_id = '$row[0]';";
                                    echo $db->dbRecord($db->dbQuery($csql))[0];
                                ?>
                            </td>
                            <td>
                                <i class="glyphicon glyphicon-tasks" aria-hidden="true">
                                    <a href="../exams/index.php?view=list&id=<?= $row[0] ?>">
                                        Exams
                                    </a>
                                </i>
                                <li class="glyphicon">&nbsp;|&nbsp;</li>
                                <i class="glyphicon glyphicon-book" aria-hidden="true">
                                    <a href="index.php?view=students&id=<?=$row[0]?>">
                                    Students</a>
                                </i>
                                <!- Actions Ends ->
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
                    </tbody>
                </table>
                <?php
                    $sql = "SELECT tc.id, c.Title from tbl_teacrs tc
                            join tbl_teachers t on t.T_ID = tc.teacher_id
                            join tbl_education c on c.ID = tc.course_id
                            WHERE tc.teacher_id = '$t_id'";
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