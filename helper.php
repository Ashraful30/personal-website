<?php 

	include 'db_connect.php';

	if (isset($_POST['user_name'])) {
		$name=$_POST['user_name'];
		$email=$_POST['user_email'];

		$sql="INSERT INTO user(name,email) values('$name','$email')";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			echo "User info inserted successfully";
		}
		else{
			echo "Error in insertion";	
		}
	}

	if (isset($_POST['view'])) {
		
		$value="";
		$value='<table class="table table-bordered text-center">
					<tr>
						<td>ID</td>
						<td>Name</td>
						<td>Email</td>
						<td>Edit</td>
						<td>Delete</td>
					</tr>';

		$sql="SELECT * FROM user";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value.='<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['name'].'</td>
							<td>'.$row['email'].'</td>
							<td><button type="button" class="btn btn-primary" id="edit" data-id='.$row['id'].'><i class="fas fa-edit"></i> Edit</button></td>
							<td><button type="button" class="btn btn-danger" id="delete" data-id='.$row['id'].'><i class="far fa-trash-alt"></i> Delete</button></td>
						</tr>';
			}
			$value.='</table>';
			echo json_encode(['status'=>'success','html'=>$value]);
		}
		else{
			echo "Error in data fetch";	
		}
	}

	if (isset($_POST['editID'])) {
		
		$id=$_POST['editID'];

		$sql="SELECT * FROM user WHERE id='$id'";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			while ($row=mysqli_fetch_assoc($res)) {
				
				$user_data[0]=$row['id'];
				$user_data[1]=$row['name'];
				$user_data[2]=$row['email'];
				//echo $row['name'];
			}
			
			echo json_encode($user_data);

		}
		else{
			echo "Error in data fetch";	
		}
	}

	if (isset($_POST['update_id'])) {

		$id=$_POST['update_id'];
		$name=$_POST['update_name'];
		$email=$_POST['update_email'];

		$sql="UPDATE user SET name='$name' , email='$email' WHERE id='$id'";

		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			echo '<p class="alert alert-success text-center alert-dismissible fade show" role="alert" style="width: 100%;">
				   User info updated successfully.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span></button>
				</p>';
		}
		else{
			echo '<p class="alert alert-danger text-center alert-dismissible fade show" role="alert" style="width: 100%;">
				   Failed to update.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span></button>
				</p>';	
		}
	}


	if (isset($_POST['delete_id'])) {

		$id=$_POST['delete_id'];
		

		$sql="DELETE FROM user WHERE id='$id'";

		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			echo '<p class="alert alert-success text-center alert-dismissible fade show" role="alert" style="width: 100%;">
				   User info Deleted successfully.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span></button>
				</p>';
		}
		else{
			echo '<p class="alert alert-danger text-center alert-dismissible fade show" role="alert" style="width: 100%;">
				   Failed to delete.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span></button>
				</p>';	
		}
	}

?>
