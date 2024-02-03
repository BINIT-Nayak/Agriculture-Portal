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
            <span class="badge badge-danger badge-pill mb-3">Recommendation</span>
          </div>
        </div>
		
          <div class="row row-content">
            <div class="col-md-12 mb-3">

				<div class="card text-white bg-gradient-success mb-3">
				<form role="form" action="#" method="post" >  
				  <div class="card-header">
				  <span class=" text-info display-4" > Fertilizer Recommendation  </span>	
						<span class="pull-right">
							<button type="submit" value="Recommend" name="Fert_Recommend" class="btn btn-warning btn-submit">SUBMIT</button>
						</span>		
				  
				  </div>

				  <div class="card-body text-dark">
					 
				<table class="table table-striped table-hover table-bordered bg-gradient-white text-center display" id="myTable">

    <thead>
					<tr class="font-weight-bold text-default">
					<th><center> Nitrogen</center></th>
					<th><center>Phosporous</center></th>
					<th><center>Potassium</center></th>
					<th><center>Temparature</center></th>
					<th><center>Humidity</center></th>
					<th><center>Soil Moisture</center></th>
					<th><center>Soil Type</center></th>
					<th><center>Crop</center></th>
        </tr>
    </thead>
 <tbody>
                                 <tr class="text-center">
                                    <td>
                                    	<div class="form-group">
										<input type = 'number' name = 'n1' placeholder="Min Value (>0)" required class="form-control">
											<br> 
											<input type = 'number' name = 'n2' placeholder="Max Value (<150)" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
										<input type = 'number' name = 'p1' placeholder="Min Value (>0)" required class="form-control">
											<br>
											<input type = 'number' name = 'p2' placeholder="Max Value (<150)" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
										<input type = 'number' name = 'k1' placeholder="Min Value (>0)" required class="form-control">
											<br>
											<input type = 'number' name = 'k2' placeholder="Max Value (<210)" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
										<input type = 'number' name = 't1' step =0.01 placeholder="Min Value (>3)" required class="form-control">
											<br>
											<input type = 'number' name = 't2' step =0.01 placeholder="Max Value (<60)" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
										<input type = 'number' name = 'h1' step =0.01 placeholder="Min Value (>10)" required class="form-control">
											<br>
											<input type = 'number' name = 'h2' step =0.01 placeholder="Max Value (<99)" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    	<div class="form-group">
											<input type = 'number' name='sm1'step =0.01 placeholder="Min Value (>10)" required class="form-control">
											<br>
											<input type = 'number' name='sm2'step =0.01 placeholder="Max Value (<99)" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
										<div class="form-group ">
													<select name="soil" class="form-control">
													<option  value="">Select Soil Type</option>
													<option  value="Sandy">Sandy</option>
													<option  value="Loamy">Loamy</option>
													<option  value="Black">Black</option>
													<option  value="Red">Red</option>
													<option  value="Clayey">Clayey</option>											
													</select>
										</div>
									</td>
									
									<td>
										<div class="form-group ">
									<select name="crop" class="form-control">
													<option  value="">Select Crop</option>
													<option  value="Cotton">Cotton</option>
													<option  value="Ginger">Ginger</option>
													<option  value="Gram">Gram</option>
													<option  value="Grapes">Grapes</option>
													<option  value="Groundnut">Groundnut</option>	
													<option  value="Jowar">Jowar</option>	
													<option  value="Maize">Maize</option>	
													<option  value="Masoor">Masoor</option>	
													<option  value="Moong">Moong</option>	
													<option  value="Rice">Rice</option>	
													<option  value="Soybean">Soybean</option>	
													<option  value="Sugarcane">Sugarcane</option>	
													<option  value="Tur">Tur</option>	
													<option  value="Turmeric">Turmeric</option>	
													<option  value="Urad">Urad</option>	
													<option  value="Wheat">Wheat</option>	
																										
													</select>
										</div>

									</td>
                                </tr>
                            </tbody>
							
					
	</table>
	</div>
	</form>

</div>



<div class="card text-white bg-gradient-success mb-3">
				  <div class="card-header">
				  <span class=" text-success display-4" > Result  </span>					
				  </div>

					<h4>
					<?php 
					if(isset($_POST['Fert_Recommend'])){
					$n=(trim($_POST['n1'])+trim($_POST['n2']))/2;
					$p=(trim($_POST['p1'])+trim($_POST['p2']))/2;
					$k=(trim($_POST['k1'])+trim($_POST['k2']))/2;
					$t=(trim($_POST['t1'])+trim($_POST['t2']))/2;
					$h=(trim($_POST['h1'])+trim($_POST['h2']))/2;
					$sm=(trim($_POST['sm1'])+trim($_POST['sm2']))/2;
					$soil=trim($_POST['soil']);
					$crop=trim($_POST['crop']);


					echo "Recommended Fertilizer is : ";

					$Jsonn=json_encode($n);
					$Jsonp=json_encode($p);
					$Jsonk=json_encode($k);
					$Jsont=json_encode($t);
					$Jsonh=json_encode($h);
					$Jsonsm=json_encode($sm);
					$Jsonsoil=json_encode($soil);
					$Jsoncrop=json_encode($crop);

					$command = escapeshellcmd("python ML/fertilizer_recommendation/fertilizer_recommendation.py $Jsonn $Jsonp $Jsonk $Jsont $Jsonh $Jsonsm $Jsonsoil $Jsoncrop ");
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

