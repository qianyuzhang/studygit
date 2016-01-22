<?php
  // 1. Create a database connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "zhang";
  $dbname = "test";
  
  //链接数据库
  $connection = mysql_connect($dbhost, $dbuser, $dbpass);
  if (!$connection)
  {
	  die('Could not connect: ' . mysql_error());
  }else{
	  echo "success";
  }
  //选择数据库
  $db_selected = mysql_select_db("test",$connection);
  //mysql_query('set names utf8');
  
  $sqlstr='select * from student';
  $result=mysql_query($sqlstr,$connection);
  //echo "<br/>";print_r($result);
  //$row=mysql_fetch_array($result);print_r($row);
  //$row=mysql_result($result);print_r($row);
  //$row=mysql_fetch_assoc($result);
  while ($row=mysql_fetch_assoc($result)){
	  $name=$row['name'];
      echo "<br/>";echo $name;
  }




<?php
  // 1. Create a database connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "zhang";
  $dbname = "test";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   //Test if connection succeeded
  if(mysqli_connect_errno()) {echo "failure";
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }else{
    echo "success";
  }
  $sqlstr='select * from student';
  $result=$connection->query($sqlstr);
//print_r($result);exit;
  while($row=$result->fetch_object())
    { 
      $name=$row->name;
      echo $name;
    }
// 5. Close database connection
  mysqli_close($connection);
?>




