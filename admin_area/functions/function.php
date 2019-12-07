<?php
// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","druglife");

if (mysqli_connect_errno())
  {
	echo "The Connection was not established: " . mysqli_connect_error();
  }


// counting the category
function countCategory() {
	
		global $con; 
		
		$get_cat = "select * from category";
		$run_cat = mysqli_query($con, $get_cat); 
		$count_cats = mysqli_num_rows($run_cat);
		
		echo $count_cats;
}
// counting the Menu
function countMenu() {
	
		global $con; 
		
		$get_men = "select * from menu";
		$run_men = mysqli_query($con, $get_men); 
		$count_men = mysqli_num_rows($run_men);
		
		echo $count_men;
}
// counting the User
function countUser() {
	
		global $con; 
		
		$get_user = "select * from customer";
		$run_user = mysqli_query($con, $get_user); 
		$count_user = mysqli_num_rows($run_user);
		
		echo $count_user;
}
// counting the Item
function countItem() {
	
		global $con; 
		
		$get_pro = "select * from product";
		$run_pro = mysqli_query($con, $get_pro); 
		$count_pro = mysqli_num_rows($run_pro);
		
		echo $count_pro;
}
// counting the Contact
function countContact() {
	
		global $con; 
		
		$get_con = "select * from contact";
		$run_con = mysqli_query($con, $get_con); 
		$count_con = mysqli_num_rows($run_con);
		
		echo $count_con;
}

// counting the Reservation
function countReservation() {
	
		global $con; 
		
		$get_res = "select * from reservation";
		$run_res = mysqli_query($con, $get_res); 
		$count_res = mysqli_num_rows($run_res);
		
		echo $count_res;
}

// counting the Order
function countOrder() {
	
		global $con; 
		
		$get_ord = "select * from ordertbl";
		$run_ord = mysqli_query($con, $get_ord); 
		$count_ord = mysqli_num_rows($run_ord);
		
		echo $count_ord;
}

// getting latest the Items
function latestItem(){
	
		global $con; 
		$get_pro = "select * from product ORDER BY product_id DESC LIMIT 0,2";
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
					<th></th>
				</tr> 
				<tr>
					<td><img src='product_images/$pro_image' style='width:110px; height:110px;'></td>
					<td>
						<h5><b>ID:</b> $pro_id</h5>
						<h5><b>Price:</b> $pro_price</h5>
						<h5><b>Menu:</b> $menu_name</h5> 
						<h5><b>Categroy:</b> $category_name</h5>
					</td>
					<td><a style= 'margin-top:35px;' class='btn btn-default' href='detailItem.php?product_id= $pro_id'>Detail</a></td>
				</tr>
			</table>
			";
		}
}
// getting latest the User
function latestUser() {
	
	global $con; 
	$get_customer = "select * from customer ORDER BY customer_id DESC LIMIT 0,2";
	$run_customer = mysqli_query($con, $get_customer); 
	
	while($row_customer = mysqli_fetch_array($run_customer))
	{
		$customer_id = $row_customer['customer_id'];
		$customer_country = $row_customer['customer_country'];
		$customer_city= $row_customer['customer_city'];
		$customer_name = $row_customer['customer_name'];
		$customer_contact = $row_customer['customer_contact'];
		$customer_image = $row_customer['customer_image'];
		echo
		"
	    <table class='table table-striped table-hover'>
			<tr>
				<th>Image</th>
				<th>Detail of User</th>
				<th></th>
			</tr> 
			<tr>
				<td><img src='../customer/customer_images/$customer_image' style='width:110px; height:110px;'></td>
				<td>
					<h5><b>ID:</b> $customer_id</h5>
					<h5><b>Country:</b> $customer_country</h5>
					<h5><b>City</b> $customer_city</h5> 
					<h5><b>Contact:</b> $customer_contact</h5>
				</td>
				<td><a style= 'margin-top:35px;' class='btn btn-default' href='detailcustomer.php?customer_id= $customer_id'>Detail</a></td>
			</tr>
		</table>
		
		";
	}
}
// getting latest the Reservation
function latestReservation() 
{
	global $con; 
	$get_res = "select * from reservation ORDER BY reservation_id DESC LIMIT 0,2";
	$run_res = mysqli_query($con, $get_res); 
	
	while($row_res =mysqli_fetch_array($run_res))
	{
		$res_id = $row_res['reservation_id'];
		$res_date = $row_res['reservation_date'];
		$res_time = $row_res['reservation_time'];
		echo
		"
		<table class='table table-striped table-hover'>
					<tr>
				<th>Serial</th>
				<th>Detail of Reservation</th>
				<th></th>
			</tr> 
			<tr>
				<td><b>No.: </b> $res_id</td>
				<td>
					<h5><b>Date:</b> $res_date</h5>
					<h5><b>Time:</b> $res_time</h5>
				</td>
				<td><a style= 'margin-top:15px;' class='btn btn-default' href='detailreservation.php?reservation_id= $res_id'>Detail</a></td>
			</tr>
		</table>
		";
	}
}
// getting latest the Contact
function latestContact() 
{
	global $con; 
	$get_con = "select * from contact ORDER BY contact_id DESC LIMIT 0,2";
	$run_con = mysqli_query($con, $get_con); 
	
	while($row_con=mysqli_fetch_array($run_con))
	{
		$con_id = $row_con['contact_id'];
		$con_email = $row_con['contact_Email'];
							
		echo
		"
		 <table class='table table-striped table-hover'>
			<tr>
				<th>Image</th>
				<th>Detail of Contact</th>
				<th></th>
			</tr> 
			<tr>
				<td><h5><b>ID:</b> $con_id</</h5></td>
				<td>
					<h5><b>Email:<br></b> $con_email</</h5>
				</td>
				<td><a style= 'margin-top:35px;' class='btn btn-default' href='detailContact.php?contact_id= $con_id'>Detail</a></td>
			</tr>
		</table>
		";
	}
}

// getting latest the Menu
function latestMenu() 
{
	global $con; 
	$get_menu = "select * from menu ORDER BY men_id DESC LIMIT 0,2";
	$run_menu = mysqli_query($con, $get_menu);
	
	while ($row_menu=mysqli_fetch_array($run_menu))
	{
		$menu_id = $row_menu['men_id']; 
		$menu_name = $row_menu['men_name'];
					
		echo
		"
		<table class='table table-striped table-hover'>
			<tr>
				<th>Serial</th>
				<th>Menu Name</th>
				<th></th>
			</tr> 
			<tr>
				<td><p style='margin-left:15px;'>$menu_id;</p></td>
				<td>$menu_name</td>
				<td><a class='btn btn-default' href='editMenu.php?Menu_id= $menu_id'>Edit</a></td>
			</tr>
		</table>					
		";
	}
}
// getting latest the Category
function latestCategory() 
{
	global $con; 
	$get_cats = "select * from category ORDER BY cat_id DESC LIMIT 0,2";
	$run_cats = mysqli_query($con, $get_cats);

	while ($row_cats = mysqli_fetch_array($run_cats))
	{
		$cat_id = $row_cats['cat_id']; 
		$cat_name = $row_cats['cat_name'];
					
		echo
		"
	    <table class='table table-striped table-hover'>                     
			<tr>
				<th>Serial</th>
				<th>Category Name</th>
				<th></th>
			</tr> 
			<tr>
				<td><p style='margin-left:15px;'> $cat_id</p></td>
				<td> $cat_name</td>
			<td><a class='btn btn-default' href='editCategory.php?Category_id= $cat_id'>Edit</a></td>
			</tr>
	    </table>
		";
	}
}










?>