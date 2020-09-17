  <?php 
 // echo __FILE__."<br>";
   $this_file= str_replace('\\', '/', __FILE__);
 // echo $_SERVER['DOCUMENT_ROOT']."<br>";
  $docRoot = $_SERVER['DOCUMENT_ROOT']; // المجلد الرئيسي الذي يتم فيه تخزين الموقع
  $webRoot = str_replace(array($docRoot, '/include/db/Database.php'), '', $this_file);
  define('WEBROOT', $webRoot);
  //echo WEB_ROOT."<br>";

  @session_start();
  class Database{
  
     protected $link, $result, $numrows;

     public function __construct(){

     $this->link = mysqli_connect("localhost", "root", "", "e4x");
      mysqli_set_charset($this->link, 'utf8');
     }

     public function disconnect(){
      mysqli_close($this->link);
     }

     public function dbQuery($sql){

     $this->result= mysqli_query($this->link, $sql);
     @$this->numrows = mysqli_num_rows($this->result);  
    }

    public function numRows(){
      return  $this->numrows;
    }
   
    public function row(){

    	$rows = array();   
    	for($x=0; $x <$this->numrows; $x++){
    		$rows[] = mysqli_fetch_array($this->result);
    	}
    	return $rows;
    }

   public function dbRecord(){
    return mysqli_fetch_array($this->result);
   }

   public function doLogin($id){ //1 to teacher 0 to student
   
     $errorMessage = '';
     if($id==0){ //student
      $username = $_POST['studentname'];
      $password = $_POST['studentspass'];
      $sql= "SELECT S_ID from tbl_students WHERE S_Email = '$username' AND
      BINARY S_Password = BINARY '$password'"; 
     }
     elseif($id==1){ //teacher
      $username = $_POST['teachername'];
      $password = $_POST['teacherpass'];
      $sql= "SELECT T_ID from tbl_teachers WHERE T_Email = '$username' AND
      BINARY T_Password = BINARY '$password'"; 
     }

     if($username == ""){
       $errorMessage = "الرجاء ادخال اسم المستخدم";
     }else if($password == ""){
       $errorMessage = "الرجاء  ادخال كلمة المرور";
     }else{
     
       
       $result = $this->dbQuery($sql);

      if($this->numRows($result)==1){
        $row = $this->dbRecord($result);

        $this->dbQuery($sql);
        if($id==0){
          $_SESSION['st_id'] = $row[0];
          header("location:student/index.php");
        }
        elseif($id==1){
          $_SESSION['tr_id'] = $row[0];
          header("location:teacher/index.php");
        }
        exit;

      }else

          $errorMessage = "الرجاء التأكد من اسم المستخدم أو كلمة المرور";


     }
   
      return $errorMessage;

   }

   public function CheckUser($id){
    if($id==0){
      if(!isset($_SESSION['st_id'])){
        if(!isset($_SESSION['tr_id'])){
          header("location:".WEBROOT."/login.php");
        }
        else{
          header("location:".WEBROOT."/teacher");
        }
        exit;
      }
    }
    elseif ($id==1){
      if(!isset($_SESSION['tr_id'])){
        if(!isset($_SESSION['st_id'])){
          header("location:".WEBROOT."/login.php");
        }
        else{
          header("location:".WEBROOT."/student");
        }
        exit;
      }
    }
   }

	public function CheckLogin(){
    if(isset($_SESSION['st_id'])){
        header("location:index.php");
        exit;
      }
  }
  }

  ?>