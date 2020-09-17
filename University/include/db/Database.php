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

   public function doLogin(){
   
     $errorMessage = '';
     $username = $_POST['username'];
     $password = $_POST['password'];
   
     if($username == ""){
       $errorMessage = "الرجاء ادخال اسم المستخدم";
     }else if($password == ""){
       $errorMessage = "الرجاء  ادخال كلمة المرور";
     }else{
     
       $sql= "select ID  from tbl_education  WHERE  Title =  '$username' AND
      BINARY Password = BINARY '$password'";
       $result = $this->dbQuery($sql);

      if($this->numRows($result)==1){
        $row = $this->dbRecord($result);
        $_SESSION['u_id'] = $row[0];
        $_SESSION['uni_name'] =  $username;

        $sql = "update tbl_users set
                user_last_login = NOW()
                where id = '{$row[0]}'";
        $this->dbQuery($sql);

        header("location:admin/index.php");
        exit;

      }else

          $errorMessage = "الرجاء التأكد من اسم المستخدم أو كلمة المرور";


     }
   
      return $errorMessage;

   }

   public function CheckUser(){
    if(!isset($_SESSION['u_id'])){
        header("location:".WEBROOT."/login.php");
        exit;
      }
   }

	public function CheckLogin(){
    if(isset($_SESSION['u_id'])){
        header("location:index.php");
        exit;
      }

  }
  }

  ?>