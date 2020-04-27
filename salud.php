<?php
$server = "x.x.x.x";
    $options = array("UID" => "user",  "PWD" => "password",  "Database" => "dbname");
    $conn = sqlsrv_connect($server, $options);
if( $conn === false ) {
die( FormatErrors( sqlsrv_errors()));
}
//Select Query
$tsql= "SELECT sqltext.TEXT, req.session_id, req.status, req.command, req.cpu_time, req.total_elapsed_time FROM sys.dm_exec_requests req CROSS APPLY sys.dm_exec_sql_text(sql_handle) AS sqltext ";
//Executes the query
$getResults= sqlsrv_query($conn, $tsql);
//Error handling
if ($getResults == FALSE){
	die(FormatErrors(sqlsrv_errors()));
}else{
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
	    echo 'TEXT '.$row['TEXT'] . "<br/>";
	    echo 'Session Id '.$row['session_id'] . "<br/>";
	    echo 'Status '.$row['status'] . "<br/>";
	    echo 'Command '.$row['command'] . "<br/>";
	    echo 'CPU Time '.$row['cpu_time'] . "<br/>";
	    echo 'Total Elapsed Time '.$row['total_elapsed_time'] . "<br/>";
	}
}
?>
