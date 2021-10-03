<!DOCTYPE html>
<html>
<head>
	<title>News Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1 style="text-align: center;">DANH SACH BAI VIET</h1>
			</div>
			<div class="panel-body">
<?php
// su dung code PHP -> thuc hien lay du lieu tu database va hien thi ra website
//Ket noi toi CSDL (mysql - phpmyadmin)
$con = mysqli_connect('localhost', 'root', '', 'web_long');

//Thuc hien lay du lieu tu database
$sql    = 'select * from news';
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result, 1)) {
	echo '<div class="row">
			<div class="col-md-4">
				<img src="'.$row['thumbnail'].'" style="width: 100%">
			</div>
			<div class="col-md-8">
				<p>'.$row['title'].'</p>
				<p>'.$row['content'].'</p>
				<p>'.$row['updated_at'].'</p>
			</div>
		</div>';
}

//Dong ket noi.
mysqli_close($con);
?>
			</div>
		</div>
	</div>
</body>
</html>