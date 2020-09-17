<?php
    $db = new Database();
    $db->CheckUser(1);
    $errMsg = "";
    /////////////////////////////////////////
    if(!isset($_GET['qid'])){
        header("location: ../courses/index.php");
    }
    $id = $_GET['qid'];

    ////////////////////////////////////////
    if(isset($_POST['btnAdd'])){
        $title = $_POST['txtname'];
        $ch_1 =  $_POST['ch_1'];
        $ch_2 =  $_POST['ch_2'];
        $ch_3 =  $_POST['ch_3'];
        $ch_4 =  $_POST['ch_4'];
        $cb = $_POST['ck_ans'];

        $sql = "INSERT INTO tbl_mcq(Q_Title, Ch_A, Ch_B, Ch_C, Ch_D, Answer, Exam_ID, Mark)
                VALUES('$title','$ch_1','$ch_2', '$ch_3', '$ch_4', '$cb', $id, 1);";

        $rs = $db->dbQuery($sql);
        header("location: ../index.php?view=quiz&qid=$id");
    }
    //////////////////////////////////////////
?>
    <h4 class="page-head-line">New Question</h4>

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
                <textarea name="txtname" class="form-control" placeholder="Question Title" rows="3"></textarea>
            </div>
        </div>
        <!-- Add Choise One -->
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Choise One</label>
            <div class="col-sm-6">
                <input type="text" name="ch_1" class="form-control" placeholder="Choise One">
            </div>
        </div>
        <!-- Add Choise Tow -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Tow</label>
            <div class="col-sm-6">
                <input type="text" name="ch_2" class="form-control" placeholder="Choise Tow">
            </div>
        </div>
        <!-- Add Choise Three -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Three</label>
            <div class="col-sm-6">
                <input type="text" name="ch_3" class="form-control" placeholder="Choise Three">
            </div>
        </div>
        <!-- Add Choise Four -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Four</label>
            <div class="col-sm-6">
                <input type="text" name="ch_4" class="form-control" placeholder="Choise Four">
            </div>
        </div>
        <!-- Select Answer Choise-->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Choise Answer</label>
            <div class="col-sm-6">
                <p>
                    <input name="ck_ans" value="1" type = "radio" >
                    Choise One&nbsp;&nbsp;
                    <input name="ck_ans" value="2" type = "radio"  >
                    Choise Tow&nbsp;&nbsp;
                    <input name="ck_ans" value="3" type = "radio" >
                    Choise Three&nbsp;&nbsp;
                    <input name="ck_ans" value="4" type = "radio" >
                    Choise Four
                </p>
            </div>
        </div>
        <!-- Buttons -->
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary" name="btnAdd">Add Question</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='../index.php?view=quiz&qid=<?=$id?>'"name="btnCncl">
                    Cancel
                </button>
            </div>
        </div>
    </form>