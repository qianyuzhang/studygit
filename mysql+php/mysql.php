<?php
//连接数据库
$con = mysql_connect('localhost','root','zhang');
if ($con) {
	echo "success!";
	echo "<br/>";
} else {
	echo "failure!";
}
//创建数据库 my_db
if (mysql_query('CREATE DATABASE my_db',$con)) {
	echo "Database created!";
	echo "<br/>";
} else {
	echo "Error creating database:".mysql_error();
}

//选取数据库 my_db
mysql_select_db('my_db',$con);

//创建名称为persons的表
$sql = "CREATE TABLE persons (
Id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(Id),
FirstName varchar(15),
LastName varchar(15),
Age int)";
mysql_query($sql,$con);

//向表中插入一行数据
$sql_insert1 = "insert into persons (FirstName,LastName,Age) value ('zhang','san','18')";
mysql_query($sql_insert1,$con);
//向表中插入一行数据
$sql_insert2 = "insert into persons (FirstName,LastName,Age) values ('li','si','20')";
mysql_query($sql_insert2,$con);

//查询表中的数据
$sql_sel = "select * from persons";
$result = mysql_query($sql_sel,$con);
while($row = mysql_fetch_array($result)){
	echo $row['FirstName'].$row['LastName'].' is '.$row['Age'].' years old';
	echo "<br/>";
}

//更新数据
$sql_update = "update persons set age=19 where id=1";
mysql_query($sql_update ,$con);

//删除数据
$sql_del = "delete from persons where id=2";
mysql_query($sql_del,$con);

mysql_close();
?>
