<?php
require_once ('config.php');

function execute($sql) {
	// lưu dữ liệu vào bảng
    // mở kết nối với cơ sở dữ liệu
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	mysqli_query($con, $sql);

	//close connection
	mysqli_close($con);
}

function executeResult($sql) {
	// lưu dữ liệu vào bảng
    // mở kết nối với cơ sở dữ liệu
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$data   = [];
	if ($result != null){
		while ($row = mysqli_fetch_array($result, 1)) {
			$data[] = $row;
		}
	}
	

	//close connection
	mysqli_close($con);

	return $data;
}
//lấy 1 sản phẩm 
function executeSingleResult($sql) {
	// lưu dữ liệu vào bảng
    // mở kết nối với cơ sở dữ liệu
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$row =null;
	if($result != null){
		$row    = mysqli_fetch_array($result, 1);
	}
	
	//close connection
	mysqli_close($con);

	return $row;
}