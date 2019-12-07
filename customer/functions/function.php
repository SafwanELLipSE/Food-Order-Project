<?php
// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","druglife");

if (mysqli_connect_errno())
  {
	echo "The Connection was not established: " . mysqli_connect_error();
  }


// getting latest the Items
function latestItem(){
	
		global $con; 
		$get_pro = "select * from product ORDER BY product_id DESC LIMIT 0,5";
		$run_pro = mysqli_query($con, $get_pro); 
		
		while($row_pro=mysqli_fetch_array($run_pro))
		{
			$pro_id = $row_pro['product_id'];
			$pro_cat = $row_pro['product_cat'];
			$pro_men = $row_pro['product_men'];
			$pro_name = $row_pro['product_name'];
			$pro_price = $row_pro['product_price'];
			$pro_image = $row_pro['product_image'];
		
			$get_men = "select * from menu where men_id = '$pro_men'"; 
			$run_men = mysqli_query($con, $get_men);
			$row_men = mysqli_fetch_array($run_men);

			$menu_name = $row_men['men_name'];
				 
			$get_cat = "select * from category where cat_id = '$pro_cat'"; 
			$run_cat = mysqli_query($con, $get_cat);
			$row_cat = mysqli_fetch_array($run_cat);

			$category_name = $row_cat['cat_name'];
			echo
			"
			<table class='table table-striped table-hover'>
				<tr>
					<th>Image</th>
					<th>Detail of Item</th>
				</tr> 
				<tr>
					<td><img src='../admin_area/product_images/$pro_image' style='width:110px; height:110px;'></td>
					<td>
						<h5><b>ID:</b> $pro_id</h5>
						<h5><b>Price:</b> $pro_price</h5>
						<h5><b>Menu:</b> $menu_name</h5> 
						<h5><b>Categroy:</b> $category_name</h5>
					</td>	
				</tr>
			</table>
			";
		}
}



















?>