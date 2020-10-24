<?php
#Azure SQL Databaseに接続する222
echo "test";
$serverName = "tcp:mon8serv.database.windows.net,1433";
$connectionOptions = array("Database"=>"mon8DB","UID"=>"T78050", "PWD"=>"Trusco9830", "CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect($serverName, $connectionOptions);
 
#接続できているかチェック
if( $conn ) {
     echo "Connection established.<br />";
     var_dump($conn);
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
 
#SQL文
$tsql = "INSERT INTO dbo.user (
name,
blood
)
VALUES
(	'yassan',
	'1'
)";
$stmt = sqlsrv_query($conn, $tsql);
 
#クエリの成否をチェック
if( $stmt === false )
{
  echo "Error in statement execution.\n";
  die( print_r( sqlsrv_errors(), true));
}
while(sqlsrv_fetch( $stmt ) === true )
{
  echo "table name: ".sqlsrv_get_field( $stmt, 0 )."<br/>\n";
  echo "<br/>\n";
}
sqlsrv_free_stmt( $stmt);
 
#接続を切る
sqlsrv_close( $conn);
?>