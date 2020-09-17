<?php
    $db = new Database();
    $db->CheckUser(0);
    $errMsg = "";
    /////////////////////////////////////////
    if(!isset($_GET['qid'])){
        header("location: ../courses/index.php");
    }
    $q_id = $_GET['qid'];
    $sql = "SELECT * FROM tbl_mcq WHERE Q_ID = '$q_id';";
    $quiz = $db->dbRecord($db->dbQuery($sql));
    if($db->numRows() == 0)
         header("location: ../courses/index.php");
    $id= $quiz[7];
    ////////////////////////////////////////
    if(isset($_POST['btnEdit'])){
        $title = $_POST['txtname'];
        $ch_1 =  $_POST['ch_1'];
        $ch_2 =  $_POST['ch_2'];
        $ch_3 =  $_POST['ch_3'];
        $ch_4 =  $_POST['ch_4'];
        $cb = $_POST['ck_ans'];

        $sql = "UPDATE tbl_mcq SET 
            Q_Title = '$title',
            Ch_A = '$ch_1',
            Ch_B = '$ch_2',
            Ch_C = '$ch_3',
            Ch_D = '$ch_4',
            Answer = '$cb'
            WHERE Q_ID = '$q_id';";

        $rs = $db->dbQuery($sql);
        //echo $sql;   
        header("location: ../index.php?view=quiz&qid=$id");
    }
    //////////////////////////////////////////
?>

<h4 class="page-head-line">Edit Quez</h4>
    
    <form class="form-horizontal" action="" method="post" >
        <?php
            if($errMsg !="") {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $errMsg; ?>
        </div>
        <?php
            }
        ?>
        <!-- Add Question Title -->
        <div class="form-group">
            <label class="col-sm-3 control-label">Question Title</label>
            <div class="col-sm-6">
                <textarea name="txtname" value="" class="form-control" placeholder="Question Title" rows="3"><?= $quiz[1]?></textarea>
            </div>
        </div>
        <!-- Add Choise One -->
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Choise One</label>
            <div class="col-sm-6">
                <input type="text" value="<?= $quiz[2]?>" name="ch_1" class="form-control" placeholder="Choise One">
            </div>
        </div>
        <!-- Add Choise Tow -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Tow</label>
            <div class="col-sm-6">
                <input type="text" value="<?= $quiz[3]?>" name="ch_2" class="form-control" placeholder="Choise Tow">
            </div>
        </div>
        <!-- Add Choise Three -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Three</label>
            <div class="col-sm-6">
                <input type="text" value="<?= $quiz[4]?>" name="ch_3" class="form-control" placeholder="Choise Three">
            </div>
        </div>
        <!-- Add Choise Four -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Four</label>
            <div class="col-sm-6">
                <input type="text" value="<?= $quiz[5]?>" name="ch_4" class="form-control" placeholder="Choise Four">
            </div>
        </div>
        <!-- Select Answer Choise-->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Answer</label>
            <div class="col-sm-6">
                <p>
                    <input name="ck_ans" value="1" type = "radio" <?php if($quiz[6]==1){?> checked <?php } ?> >
                    Choise One&nbsp;&nbsp;
                    <input name="ck_ans" value="2" type = "radio" <?php if($quiz[6]==2){?> checked <?php } ?> >
                    Choise Tow&nbsp;&nbsp;
                    <input name="ck_ans" value="3" type = "radio"<?php if($quiz[6]==3){?> checked <?php } ?> >
                    Choise Three&nbsp;&nbsp;
                    <input name="ck_ans" value="4" type = "radio"<?php if($quiz[6]==4){?> checked <?php } ?> >
                    Choise Four
                </p>
            </div>
        </div>
        <!-- Buttons -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary" name="btnEdit">Edit Question</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='../index.php?view=quiz&qid=<?=$id?>'"name="btnCncl">
                    Cancel
                </button>
            </div>
        </div>
    </form>