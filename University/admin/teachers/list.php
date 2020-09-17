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
    $uid = $_SESSION['u_id'];
    $sql1 = "select * from tbl_teachers where U_ID = '$uid'  limit $start, $row_per_page";
    $rs = $db->dbQuery($sql1);

?>

<!doctype html>
<html>
<body>
    <div class="row">
        <div class="panel-heading">
            <div class="panel-title">Teachers List</div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rows = $db->row($rs);
                            if($db->numRows($rs) > 0){
                                foreach ($rows as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?= $row[0] ?></th>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td>
                                <!- Actions Begins ->
                                <!-- Modify Exsist Teacher -->
                                <!-- Delete Exsist Teacher -->
                                <i class="glyphicon glyphicon-plus-sign" aria-hidden="true">
                                    <a href="index.php?view=add">New</a>
                                </i>
                                <li class="glyphicon">&nbsp;</li>
                                <i class="glyphicon glyphicon-edit" aria-hidden="true">
                                    <a href="index.php?view=modify&id=<?= $row[0] ?>">
                                     Edit
                                    </a>
                                </i>
                                <li class="glyphicon">&nbsp;</li>
                                <i class="glyphicon glyphicon-remove-circle" aria-hidden="true">
                                    <a href="delete.php?id=<?= $row[0] ?>" onclick="return confirm('Are You Sure!');">
                                     Delete
                                    </a>
                                </i>
                                <li class="glyphicon">&nbsp;|&nbsp;</li>
                                <i class="glyphicon glyphicon-book" aria-hidden="true">
                                    <a href="index.php?view=course&id=<?= $row[0] ?>">Courses</a>
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
                    $sql = "select * from tbl_teachers where U_ID = '$uid'";
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
                            <a class="page-link" href="index.php?view=add"">Add New Teacher</a>
                        </li>
                        <?php } ?>
                        <?php if($total_record !=0){?>
                        <li class="page-item <?php if($page ==$total_pages){ ?> disabled <?php } ?>">
                            <a class="page-link" href="?page=<?= $nextpage ?>">Next</a>
                        </li>
                        <?php }?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>