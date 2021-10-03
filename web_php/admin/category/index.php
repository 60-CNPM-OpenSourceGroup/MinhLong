<!-- nhúng từ các file khác -->
<?php
require_once('../../db/dbhelper.php');
require_once('../../common/unity.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Danh Mục</title>
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
	<ul class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link active" href="#">Quản Lý Danh Mục</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="../product/">Quản Lý Sản Phẩm</a>
	</li>
	</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý Danh Mục</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<a href="add.php">
							<button class="btn btn-success" style="margin-bottom: 15px;">Thêm Danh Mục</button>
						</a>
					</div>
					<div class="col-lg-6">
						<form method="get">
							<div class="form-group" style="width: 200px; float: right;">
							<input type="text" class="form-control" placeholder="Tìm kiếm..." id="s" name="s">
							</div>
						</form>
					</div>
				</div>
				
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Tên Danh Mục</th>
							<th width="50px"></th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody>
<?php
//số lượng sản phẩm trong 1 trang
$limit = 5;
$page = 1;
//trang cần lấy sp
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
//tránh tình trạng nhập page nhỏ hơn 0
if($page <= 0){
	$page = 1;
}
$firstIndex = ($page - 1)*$limit;
//dữ liệu tìm kiếm
$s= '';
if(isset($_GET['s'])){
	$s = $_GET['s'];
}
$additional = '';
if(!empty($s)){
	$additional = ' and name like "%'.$s.'%"';
}
//Láy danh sách danh mục từ data
$sql          = 'select * from category where 1 '.$additional.' limit '.$firstIndex.','.$limit;

$categoryList = executeResult($sql);

$sql = 'select count(id) as total from category where 1'.$additional;
$countR = executeSingleResult($sql);

$number = 0;
if($countR != null ){
	$count =  $countR['total'];
	$number = ceil($count/$limit);
}
foreach ($categoryList as $item) {
	//show số thứ tự
	echo '<tr>
			<td>'.(++$firstIndex).'</td>
			<td>'.$item['name'].'</td> 
			<td>
				<a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
			</td>
			<td>
				<button class="btn btn-danger" onclick="deleteCategory('.$item['id'].')">Xoá</button>
			</td>
		</tr>';
}
?>
					</tbody>
				</table>
				<!-- bài toán phân trang -->
				<?=paginarion($number, $page, '&s='.$s)?>
			</div>
		</div>
	</div>
	<!-- dùng để xóa  -->
	<script type="text/javascript">
		function deleteCategory(id) {
			//hiển thị alert
			var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
			if(!option) {
				return;
			}

			console.log(id)
			//ajax - lenh post
			$.post('ajax.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>

	
</body>
</html>