<!-- nhúng từ các file khác -->
<?php
require_once('../../db/dbhelper.php');
require_once('../../common/unity.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Sản Phẩm</title>
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
	    <a class="nav-link " href="../category">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="#">Quản Lý Sản Phẩm</a>
	  </li>
	</ul>
    <div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<a href="add.php">
					<button class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</button>
				</a>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Hình ảnh</th>
							<th>Tên sản phẩm</th>
							<th>Giá bán</th>
							<th>Danh mục</th>
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
//Lay danh sach danh muc tu database
$sql          = 'select product.id, product.title, product.price, product.thumbnail, 
category.name 
category_name from product left join category on product.id_category = category.id '.' limit '.$firstIndex.','.$limit;

$productList = executeResult($sql);

$sql = 'select count(id) as total from product where 1 ';
$countR = executeSingleResult($sql);

$number = 0;
if($countR != null ){
	$count =  $countR['total'];
	$number = ceil($count/$limit);
}

foreach ($productList as $item) {
    //show số thứ tự
	echo '<tr>
            <td>'.(++$firstIndex).'</td>
            <td><img src="'.$item['thumbnail'].'"
                style ="max-width: 100px"/></td> 
            <td>'.$item['title'].'</td> 
            <td>'.$item['price'].'</td> 
            <td>'.$item['category_name'].'</td> 
            <td>
                <a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
            </td>
            <td>
                <button class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Xoá</button>
            </td>
        </tr>';
}
?>
					</tbody>
				</table>
				<!-- bài toán phân trang -->
				<?=paginarion($number, $page, '')?>
			</div>
		</div>
	</div>
    <!-- dùng để xóa  -->
    <script type="text/javascript">
		function deleteProduct(id) {
            //hiển thị alert
			var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
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