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
    $U_ID = $_SESSION['u_id'];
    $row_per_page = 7;
    $start = ($page -1 ) * $row_per_page;
    $sql1 = "select S_ID, S_Name, S_Email, S_Password, Title, S_IsActive
             from tbl_students s 
                join tbl_education e on e.id = s.S_Assign
             where S_Assign in (
                select id from tbl_education where pid in (
                    select id from tbl_education where pid = '$U_ID'))
              
            limit $start, $row_per_page";
    $rs = $db->dbQuery($sql1);
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
    <div class="row">
        <div class="panel-heading">
            <div class="panel-title">Students List</div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Department</th>
                            <th>Is Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $rows = $db->row($rs);
                            if($db->numRows($rs) > 0){
                                foreach ($rows as $row) {
                        ?>
                        <tr>
                            <td><?=$row[0] ?></td>
                            <td><?=$row[1] ?></td>
                            <td><?=$row[2] ?></td>
                            <td><?=$row[3] ?></td>
                            <td><?=$row[4] ?></td>
                            <td><?=$row[5] ?></td>
                            <td>
                                <i class="glyphicon glyphicon-plus-sign" aria-hidden="true">
                                    <a href="index.php?view=add">New</a>
                                </i>

                                <i class="glyphicon glyphicon-edit" aria-hidden="true">
                                    <a href="index.php?view=modify&id=<?= $row[0] ?>">
                                     Edit
                                    </a>
                                </i>
                                <i class="glyphicon glyphicon-remove-circle" aria-hidden="true">
                                    <a href="delete.php?id=<?= $row[0] ?>" onclick="return confirm('Are You Sure!');">
                                     Delete
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
                            <td colspan="7" align="Center"> لا يوجد بيانات حتى الآن </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    $sql = "select * from tbl_students where S_Assign in (
                                select id from tbl_education where pid in (
                                    select id from tbl_education where pid = '$U_ID'))";
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
                            <a class="page-link" href="index.php?view=add"">Add New Student</a>
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