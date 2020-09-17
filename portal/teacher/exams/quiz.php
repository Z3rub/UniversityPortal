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
    if(!isset($_GET['qid'])){
        header("location: ../courses/index.php");
       // echo "<meta http-equiv='refresh' content='0;URL=../courses/index.php?view=list'>";
    }
    $q_id = $_GET['qid'];
   
    /////////////////////////////////////////////////////
    $sql = "SELECT * FROM tbl_mcq
            WHERE Exam_ID = $q_id
            limit $start, $row_per_page";
    $rs = $db->dbQuery($sql);
    $rows = $db->row($rs);

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
            <?=$exam_tit?>  | Quez List
        </h4>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question Title</th>
                            <th>Answer</th>
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
                            <td>
                                <?php 
                                    echo $row[$row[6]+1];
                                ?>
                            </td>
                            <td>
                                <a href="quez/index.php?view=add&qid=<?= $q_id ?>">
                                    <i class="glyphicon glyphicon-plus-sign"></i>
                                </a>
                                <li class="glyphicon">|</li>
                                <a href="quez/index.php?view=modify&qid=<?= $row[0] ?>">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                <li class="glyphicon">|</li>
                                <a href="quez/delete.php?qid=<?= $row[0] ?>" onclick="return confirm('Are You Sure!');">
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
                    $qsql = "SELECT * FROM tbl_mcq
                            WHERE Exam_ID = $q_id";
                    $total_record = $db->numRows($db->dbQuery($qsql)); //3
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
                            <a class="page-link" href="?view=quiz&qid=<?=$q_id?>&page=<?= $prevpage ?>" tabindex="-1">
                                        Previous
                            </a>
                        </li>
                        <?php
                            for($i=1; $i <=$total_pages; $i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="?view=quiz&qid=<?=$q_id?>&page=<?= $i ?>">
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
                            <a class="page-link" href="quez\index.php?view=add&qid=<?=$q_id?>">Add New Quetsion</a> 
                        </li>
                        <?php } ?>
                        <?php if($total_record !=0){?>
                        <li class="page-item <?php if($page ==$total_pages){ ?> disabled <?php } ?>">
                            <a class="page-link" href="?view=quiz&qid=<?=$q_id?>&page=<?= $nextpage ?>">Next</a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>