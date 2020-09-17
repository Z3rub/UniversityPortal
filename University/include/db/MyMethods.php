<?php
include_once("Database.php");
class MyMethods{
    public $db;

    public function __construct(){
        $this->db = new Database();
    }
//////////////////////////////////////////////////
/////////////////////////////////////////////////
    
    # Student Select
    public function std_select(){
        $sql = "SELECT * FROM tbl_students ;";
        $rs = $this->db->dbQuery($sql);
        $rows = $this->db->row($rs);
        return $rows;
    }

    # Student Insert
    public function std_insert(){
        $Name = func_get_arg(0);
        $Email = func_get_arg(1);
        $Password = func_get_arg(2);
        $Assign = func_get_arg(3);
        $Active = func_get_arg(4);
        
        $sql =  " 
                INSERT INTO tbl_students ( S_Name, S_Email, S_Password, S_Assign, S_IsActive)
                VALUES ('$Name', '$Email', '$Password', '$Assign', $Active);
                ";
        $rs = $this->db->dbQuery($sql);
        return "One Row is Inserted...";
    }

    # Student Update
    public function std_update(){
        $Name = func_get_arg(0);
        $Email = func_get_arg(1);
        $Password = func_get_arg(2);
        $Assign = func_get_arg(3);
        $Active = func_get_arg(4);
        $ID = func_get_arg(5);

        $sql =  "
                UPDATE tbl_students SET 
                    S_Name = '$Name',
                    S_Email = '$Email',
                    S_Password = '$Password',
                    S_Assign= '$Assign',
                    S_IsActive= '$Active'
                WHERE S_ID = '$ID';
                ";
        $rs = $this->db->dbQuery($sql);
        return "One Row is Updated...";
    }

    # Student Delete
    public function std_delete(){
        $ID = func_get_arg(0);
        $sql = "DELETE FROM tbl_students WHERE S_ID = '$ID'";
        $rs = $this->db->dbQuery($sql);
        return "One Row is Deleted...";
    }
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

    # Teacher Select
    public function ins_select(){
        $sql = "SELECT * FROM tbl_teachers";
        $rs = $this->db->dbQuery($sql);
        $rows = $this->db->row($rs);
        return $rows;
    }

    # Teacher Insert
    public function ins_insert(){
        $Name = func_get_arg(0);
        $Email = func_get_arg(01);
        $Password = func_get_arg(2);

        $sql =  "
                INSERT INTO tbl_teachers(T_Name, T_Email, T_Password)
                VALUES ('$Name', '$Email', '$Password');
                ";

        $rs = $this->db->dbQuery($sql);
        $rows = $this->db->row($rs);
        return "One Row is Inserted ..";
    }

    # Teacher Update
    public function ins_update(){
        $Name = func_get_arg(0);
        $Email = func_get_arg(01);
        $Password = func_get_arg(2);
        $ID = func_get_arg(3);



        $sql =  "
                UPDATE tbl_teachers SET ``=[value-1],
                    T_Name = '$Name',
                    T_Email = '$Email',
                    T_Password = '$Password'
                 WHERE T_ID = '$ID';
                ";

        $rs = $this->db->dbQuery($sql);
        $rows = $this->db->row($rs);
        return "One Row is Updated ..";
    }

    # Teacher Delete
    public function ins_delete(){
        $ID = func_get_arg(0);
        $sql = "DELETE FROM tbl_teachers WHERE T_ID = '$ID'";
        $rs = $this->db->dbQuery($sql);
        return "One Row is Deleted...";
    }

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

    # Education Select
    public function edu_select(){
        $PID = func_get_arg(0);
        $sql = "SELECT * FROM tbl_education WHERE PID = '$PID';";
        $rs = $this->db->dbQuery($sql);
        $rows = $this->db->row($rs);
        return $rows;
    }

    # Education Insert
    public function edu_insert(){
        $Title = func_get_arg(0);
        $PID = func_get_arg(01);

        $sql =  "
                INSERT INTO tbl_education( Title, PID)
                VALUES ('$Title','$PID');
                ";

        $rs = $this->db->dbQuery($sql);
        $rows = $this->db->row($rs);
        return "One Row is Inserted ..";
    }

    # Education Update
    public function edu_update(){
        $Title = func_get_arg(0);
        $PID = func_get_arg(1);
        $ID = func_get_arg(2);
        
        $sql =  "
                UPDATE  tbl_education SET
                    Title = '$Title',
                    PID = '$PID'
                WHERE ID = '$ID';
                ";

        $rs = $this->db->dbQuery($sql);
        $rows = $this->db->row($rs);
        return "One Row is Updated ..";
    }

    # Education Delete
    public function edu_delete(){
        $ID = func_get_arg(0);
        $sql = "DELETE FROM tbl_education WHERE T_ID = '$ID';";
        $rs = $this->db->dbQuery($sql);
        return "One Row is Deleted...";
    }
}
?>