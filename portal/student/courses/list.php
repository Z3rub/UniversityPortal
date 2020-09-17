<?php
   $db = new Database();
   $db->CheckUser(0);
   @$page = $_GET['page'];
    if(isset($page)){
        $page = $page;
    }
    else{
        $page = 1;
    }
    $row_per_page = 5;
    $start = ($page -1 ) * $row_per_page;
   $s_id = $_SESSION['st_id'];
   $sql = " SELECT sc.ID, c.Title, t.T_Name, tc.id FROM tbl_stdcrs sc
            JOIN tbl_students s ON s.S_ID = sc.STUDENT_ID
            JOIN tbl_teacrs tc ON tc.id = sc.COURSE_ID
            JOIN tbl_education c ON c.ID = tc.course_id
            JOIN tbl_teachers t ON t.T_ID = tc.teacher_id
            WHERE sc.STUDENT_ID = '$s_id'
            LIMIT $start, $row_per_page"; 
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
                            <th>Teacher Name</th>
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
                            <td><?= $row[2] ?></td>
                            <td>
                                <?php
                                    $csql = "SELECT COUNT(*) FROM tbl_exam WHERE tc_id = '$row[3]';";
                                    echo $db->dbRecord($db->dbQuery($csql))[0];
                                ?>
                            </td>
                            <td>
                                <i class="glyphicon glyphicon-tasks" aria-hidden="true">
                                    <a href="../exams/index.php?view=list&id=<?= $row[3] ?>">
                                        Exams
                                    </a>
                                </i>
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
                    $sql = "SELECT sc.ID, c.Title, tc.id FROM tbl_stdcrs sc
                            JOIN tbl_students s ON s.S_ID = sc.STUDENT_ID
                            JOIN tbl_teacrs tc ON tc.id = sc.COURSE_ID
                            JOIN tbl_education c ON c.ID = tc.course_id
                            WHERE sc.STUDENT_ID = '$s_id'";
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