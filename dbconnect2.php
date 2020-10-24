<?php
 
#Azure SQL Databaseに接続する
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
$tsql = "SELECT * from user2";
 
$stmt = sqlsrv_query($conn, $tsql);
 
#クエリの成否をチェック
if( $stmt === false )
{
  echo "Error in statement execution.\n";
  die( print_r( sqlsrv_errors(), true));
}
$result = sqlsrv_query($conn, $tsql);
?>
  <table>
 
<?php
    //実行結果を描画
    while($row = sqlsrv_fetch_array($result)) {
         printf("<tr><td class='hdr'>".$row['name']."</td>");
        printf("<td>".$row['blood']."</td></tr>");
    }
?>
</table>
<?php
sqlsrv_free_stmt( $stmt);
 
#接続を切る
sqlsrv_close( $conn);
?>