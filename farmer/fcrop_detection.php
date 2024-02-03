<?php
include ('fsession.php');
ini_set('memory_limit', '-1');

if(!isset($_SESSION['farmer_login_user'])){
header("location: ../index.php");} // Redirecting To Home Page
$query4 = "SELECT * from farmerlogin where email='$user_check'";
              $ses_sq4 = mysqli_query($conn, $query4);
              $row4 = mysqli_fetch_assoc($ses_sq4);
              $para1 = $row4['farmer_id'];
              $para2 = $row4['farmer_name'];
			  
?>

<!DOCTYPE html>
<html>
<?php include ('fheader.php');  ?>

  <body class="bg-white" id="top">
  
<?php include ('fnav.php');  ?>

 
  <section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
<!-- ======================================================================================================================================== -->

<div class="container-fluid ">
    
    	 <div class="row">
          <div class="col-md-8 mx-auto text-center">
            <span class="badge badge-danger badge-pill mb-3">Detection</span>
          </div>
        </div>
		
          <div class="row row-content">
            <div class="col-md-12 mb-3">

				<div class="card text-white bg-gradient-success mb-3">
				<form role="form" action="#" method="post" enctype="multipart/form-data">  
				  <div class="card-header">
				  <span class=" text-info display-4" > Plant Disease Detection  </span>	
						<span class="pull-right">
							<button type="submit" value="Detect" name="Disease_Detect" class="btn btn-warning btn-submit">SUBMIT</button>
						</span>		
				  
				  </div>

				  <div class="card-body text-dark">
				     <form role="form" action="#" method="post" enctype="multipart/form-data">     
					 
				<!-- <table class="table table-striped table-hover table-bordered bg-gradient-white text-center display" id="myTable">

    <thead>
					<tr class="font-weight-bold text-default">
					<th><center> Nitrogen</center></th>
					<th><center>Phosporous</center></th>
					<th><center>Potasioum</center></th>
					<th><center>Temparature</center></th>
					<th><center>Humidity</center></th>
					<th><center>PH</center></th>
					<th><center>Rainfall</center></th>
					
        </tr>
    </thead>
 <tbody>
                                 <tr class="text-center">
                                    <td>
                                    	<div class="form-group">
											<input type = 'number' name = 'n' placeholder="Nitrogen Eg:90" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
											<input type = 'number' name = 'p' placeholder="Phosphorus Eg:42" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
											<input type = 'number' name = 'k' placeholder="Pottasium Eg:43" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
											<input type = 'number' name = 't' step =0.01 placeholder="Temperature Eg:21" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
											<input type = 'number' name = 'h' step =0.01 placeholder="Humidity Eg:82" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
											<input type = 'number' name = 'ph' step =0.01 placeholder="PH Eg:6.5" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
											 <input type = 'number' name = 'r' step =0.01 placeholder="Rainfall Eg:203" required class="form-control">
											
										</div>
                                    </td>
                                </tr>
                            </tbody>
							
					
	</table> -->
	<p class="text-center">
                Upload a image of plant to know what type of disease a plant has
            </p>
        </p>
        <p>
            <h4 class="text-center">
                Upload Image file
            </h4>
        </p>
        <div class="d-flex justify-content-center">
            <!-- <form method=post enctype=multipart/form-data> -->
                <input type=file name=img_file id=img_file class="form-control">

			
                <!-- <input type=submit value=Upload> -->
            <!-- </form> -->
        </div>
		<script>
            var imageUpload = document.getElementById("img_file");

			imageUpload.addEventListener("change", function() {
				var image = document.createElement("img");
				image.src = URL.createObjectURL(this.files[0]);
				document.getElementById("image-container").appendChild(image);
			});
			</script>

            <div id="image-container"></div>
	</form>
</div>
</div>



<div class="card text-white bg-gradient-success mb-3">
				  <div class="card-header">
				  <span class=" text-success display-4" > Result  </span>					
				  </div>

					<h4>
				<p class="text-center">
					The detected disease
				</p>
					<?php 
					if(isset($_POST["Disease_Detect"])){
					$img_file=$_POST['img_file'];
					$img_filename=$_FILES["img_file"]["name"];
					echo $img_filename;
					echo $img_file;

					echo "The detected disease is - ";

					$data = array(); // Initialize an empty array to store the image data.
					if ($img_file) {
						
						// $img = fread($file, 1024); // Read the binary content of the file.
						// fclose($file); // Close the file.
					
						// Encode the binary image data in base64 and store it in the 'img' key of the array.
						$data['img'] = base64_encode($img_file);
					
						// Convert the array into a JSON string and print it.
						$Jsonn=json_encode($data);
					} else {
						echo "Failed to open the file.";
					}


					
					$command = escapeshellcmd("python ML/detection.py $Jsonn ");
                    $output = passthru($command);
					echo $output;					
					}
                    ?>
					
					</h4>
            </div>
 
	
	
            </div>
          </div>  
       </div>
		 
</section>

    <?php require("footer.php");?>

</body>
</html>

