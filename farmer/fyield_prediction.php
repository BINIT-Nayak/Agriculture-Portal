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

<div class="container ">
    
    	 <div class="row">
          <div class="col-md-8 mx-auto text-center">
            <span class="badge badge-danger badge-pill mb-3">Prediction</span>
          </div>
        </div>
		
          <div class="row row-content">
            <div class="col-md-12 mb-3">

				<div class="card text-white bg-gradient-success mb-3">
				<form role="form" action="#" method="post" >  
				  <div class="card-header">
				  <span class=" text-info display-4" > Yield Prediction  </span>	
				  
				  </div>

				  <div class="card-body text-dark">
					 
				<table class="table table-striped table-hover table-bordered bg-gradient-white text-center display" id="myTable">

    <thead>
					<tr class="font-weight-bold text-default">
					<th><center> State</center></th>
					<th><center>District</center></th>
					<th><center>Season</center></th>
					<th><center>Crop</center></th>
					<th><center>Area</center></th>
					<th><center>Prediction</center></th>
					
					
        </tr>
    </thead>
 <tbody>
                                 <tr class="text-center">

                                   <td>
                                    	<div class="form-group">
										<!-- <select  name="state" class="form-control" required>
											<option value="Karnataka">Karnataka</option>
										</select> -->
										<select onchange="print_city('state', this.selectedIndex);" id="sts" name ="stt" class="form-control" required></select>
											<script language="javascript">print_state("sts");</script>								
										</div>
                                    </td>

									<td>
										<div class="form-group ">
										<!-- <select id="district" name="district" class="form-control" required>
										  <option value="">Select a district</option>
										  <option value="BAGALKOT">Bagalkot</option>
										  <option value="BANGALORE_RURAL">Bangalore Rural</option>
										  <option value="BELGAUM">Belgaum</option>
										  <option value="BELLARY">Bellary</option>
										  <option value="BENGALURU_URBAN">Bengaluru Urban</option>
										  <option value="BIDAR">Bidar</option>
										  <option value="BIJAPUR">Bijapur</option>
										  <option value="CHAMARAJANAGAR">Chamarajanagar</option>
										  <option value="CHIKBALLAPUR">Chikballapur</option>
										  <option value="CHIKMAGALUR">Chikmagalur</option>
										  <option value="CHITRADURGA">Chitradurga</option>
										  <option value="DAKSHIN_KANNAD">Dakshin Kannad</option>
										  <option value="DAVANGERE">Davangere</option>
										  <option value="DHARWAD">Dharwad</option>
										  <option value="GADAG">Gadag</option>
										  <option value="GULBARGA">Gulbarga</option>
										  <option value="HAVERI">Haveri</option>
										  <option value="HASSAN">Hassan</option>
										  <option value="KODAGU">Kodagu</option>
										  <option value="KOLAR">Kolar</option>
										  <option value="KOPPAL">Koppal</option>
										  <option value="MANDYA">Mandya</option>
										  <option value="MYSORE">Mysore</option>
										  <option value="RAMANAGARA">Ramanagara</option>
										  <option value="RAICHUR">Raichur</option>
										  <option value="SHIMOGA">Shimoga</option>
										  <option value="TUMKUR">Tumkur</option>
										  <option value="UDUPI">Udupi</option>
										  <option value="UTTAR_KANNAD">Uttar Kannad</option>
										  <option value="YADGIR">Yadgir</option>
										</select> -->
										<select id ="state" name="district" class="form-control" required>
											<option value="">Select District</option>
											</select>
											<script language="javascript">print_state("sts");</script>
										</div>
                                    </td>
									
									<td>
										<div class="form-group ">
									
													<select name="Season" class="form-control" id="season" required>
													<option value="">Select Season ...</option>
													<option name="Kharif" value="Kharif">Kharif</option>
													<option name="Rabi" value="Rabi">Rabi</option>
													<option name="Summer" value="Summer">Summer</option>
													<option name="WholeYear" value="WholeYear">Whole Year</option>
											
													</select>
										</div> 

									</td>
									
									<td>
                                    	<div class="form-group" >
										<select id="crop" class="form-control" name="crops" required>
									  	<option value="">Select crop</option>
										<option name="Arecanut" value="Arecanut">Arecanut</option>
										<option name="Other Kharif pulses" value="Other Kharif pulses">Other Kharif pulses</option>
										<option name="Banana" value="Banana">Banana</option>
										<option name="Rice" value="Rice">Rice</option>
<option name="Cashewnut" value="Cashewnut">Cashewnut</option>
<option name="Coconut" value="Coconut">Coconut</option>
<option name="Dry ginger" value="Dry ginger">Dry ginger</option>
<option name="Sugarcane" value="Sugarcane">Sugarcane</option>
<option name="Sweet potato" value="Sweet potato">Sweet potato</option>
<option name="Tapioca" value="Tapioca">Tapioca</option>
<option name="Black pepper" value="Black pepper">Black pepper</option>
<option name="Dry chillies" value="Dry chillies">Dry chillies</option>
<option name="other oilseeds" value="other oilseeds">Other Oilseeds</option>
<option name="Turmeric" value="Turmeric">Turmeric</option>
<option name="Maize" value="Maize">Maize</option>
<option name="Moong(Green Gram)" value="Moong(Green Gram)">Moong(Green Gram)</option>
<option name="Urad" value="Urad">Urad</option>
<option name="Arhar/Tur" value="Arhar/Tur">Arhar/Tur</option>
<option name="Groundnut" value="Groundnut">Groundnut</option>
<option name="Sunflower" value="Sunflower">Sunflower</option>
<option name="Bajra" value="Bajra">Bajra</option>
<option name="Castor seed" value="Castor seed">Castor seed</option>
<option name="Cotton(lint)" value="Cotton(lint)">Cotton(lint)</option>
<option name="Horse-gram" value="Horse-gram">Horse-gram</option>
<option name="Jowar" value="Jowar">Jowar</option>
<option name="Korra" value="Korra">Korra</option>
<option name="Ragi" value="Ragi">Ragi</option>
<option name="Tobacco" value="Tobacco">Tobacco</option>
<option name="Gram" value="Gram">Gram</option>
<option name="Wheat" value="Wheat">Wheat</option>
<option name="Masoor" value="Masoor">Masoor</option>
<option name="Sesamum" value="Sesamum">Sesamum</option>
<option name="Linseed" value="Linseed">Linseed</option>
<option name="Safflower" value="Safflower">Safflower</option>
<option name="Onion" value="Onion">Onion</option>
<option name="other misc. pulses" value="other misc. pulses">Other Misc. Pulses</option>
<option name="Samai" value="Samai">Samai</option>
<option name="Small millets" value="Small millets">Small Millets</option>
<option name="Coriander" value="Coriander">Coriander</option>
<option name="Potato" value="Potato">Potato</option>
<option name="Other Rabi pulses" value="Other Rabi pulses">Other Rabi Pulses</option>
<option name="Soyabean" value="Soyabean">Soyabean</option>
<option name="Beans & Mutter(Vegetable)" value="Beans & Mutter(Vegetable)">Beans & Mutter(Vegetable)</option>
<option name="Bhindi" value="Bhindi">Bhindi</option>
<option name="Brinjal" value="Brinjal">Brinjal</option>
<option name="Citrus Fruit" value="Citrus Fruit">Citrus Fruit</option>
<option name="Cucumber" value="Cucumber">Cucumber</option>
<option name="Grapes" value="Grapes">Grapes</option>
<option name="Mango" value="Mango">Mango</option>
<option name="Orange" value="Orange">Orange</option>
<option name="other fibres" value="other fibres">Other Fibres</option>
<option name="Other Fresh Fruits" value="Other Fresh Fruits">Other Fresh Fruits</option>
<option name="Other Vegetables" value="Other Vegetables">Other Vegetables</option>
<option name="Papaya" value="Papaya">Papaya</option>
<option name="Pome Fruit" value="Pome Fruit">Pome Fruit</option>
<option name="Tomato" value="Tomato">Tomato</option>
<option name="Rapeseed &Mustard" value="Rapeseed &Mustard">Rapeseed & Mustard</option>
<option name="Mesta" value="Mesta">Mesta</option>
<option name="Cowpea(Lobia)" value="Cowpea(Lobia)">Cowpea(Lobia)</option>
<option name="Lemon" value="Lemon">Lemon</option>
<option name="Pome Granet" value="Pome Granet">Pome Granet</option>
<option name="Sapota" value="Sapota">Sapota</option>
<option name="Cabbage" value="Cabbage">Cabbage</option>
<option name="Peas (vegetable)" value="Peas (vegetable)">Peas (vegetable)</option>
<option name="Niger seed" value="Niger seed">Niger seed</option>
<option name="Bottle Gourd" value="Bottle Gourd">Bottle Gourd</option>
<option name="Sannhamp" value="Sannhamp">Sannhamp</option>
<option name="Varagu" value="Varagu">Varagu</option>
<option name="Garlic" value="Garlic">Garlic</option>
<option name="Ginger" value="Ginger">Ginger</option>
<option name="Oilseeds total" value="Oilseeds total">Oilseeds Total</option>
<option name="Pulses total" value="Pulses total">Pulses Total</option>
<option name="Jute" value="Jute">Jute</option>
<option name="Peas & beans (Pulses)" value="Peas & beans (Pulses)">Peas & Beans (Pulses)</option>
<option name="Blackgram" value="Blackgram">Blackgram</option>
<option name="Paddy" value="Paddy">Paddy</option>
<option name="Pineapple" value="Pineapple">Pineapple</option>
<option name="Barley" value="Barley">Barley</option>
<option name="Khesari" value="Khesari">Khesari</option>
<option name="Guar seed" value="Guar seed">Guar Seed</option>
<option name="Moth" value="Moth">Moth</option>
<option name="Other Cereals & Millets" value="Other Cereals & Millets">Other Cereals & Millets</option>
<option name="Cond-spcs other" value="Cond-spcs other">Cond-Specs Other</option>
<option name="Turnip" value="Turnip">Turnip</option>
<option name="Carrot" value="Carrot">Carrot</option>
<option name="Redish" value="Redish">Redish</option>
<option name="Arcanut (Processed)" value="Arcanut (Processed)">Arcanut (Processed)</option>
<option name="Atcanut (Raw)" value="Atcanut (Raw)">Atcanut (Raw)</option>
<option name="Cashewnut Processed" value="Cashewnut Processed">Cashewnut Processed</option>
<option name="Cashewnut Raw" value="Cashewnut Raw">Cashewnut Raw</option>
<option name="Cardamom" value="Cardamom">Cardamom</option>
<option name="Rubber" value="Rubber">Rubber</option>
<option name="Bitter Gourd" value="Bitter Gourd">Bitter Gourd</option>
<option name="Drum Stick" value="Drum Stick">Drum Stick</option>
<option name="Jack Fruit" value="Jack Fruit">Jack Fruit</option>
<option name="Snak Guard" value="Snak Guard">Snak Guard</option>
<option name="Pump Kin" value="Pump Kin">Pump Kin</option>
<option name="Tea" value="Tea">Tea</option>
<option name="Coffee" value="Coffee">Coffee</option>
<option name="Cauliflower" value="Cauliflower">Cauliflower</option>
<option name="Other Citrus Fruit" value="Other Citrus Fruit">Other Citrus Fruit</option>
<option name="Water Melon" value="Water Melon">Water Melon</option>
<option name="Total foodgrain" value="Total foodgrain">Total Foodgrain</option>
<option name="Kapas" value="Kapas">Kapas</option>
<option name="Colocosia" value="Colocosia">Colocosia</option>
<option name="Lentil" value="Lentil">Lentil</option>
<option name="Bean" value="Bean">Bean</option>
<option name="Jobster" value="Jobster">Jobster</option>
<option name="Perilla" value="Perilla">Perilla</option>
<option name="Rajmash Kholar" value="Rajmash Kholar">Rajmash Kholar</option>
<option name="Ricebean (nagadal)" value="Ricebean (nagadal)">Ricebean (Nagadal)</option>
<option name="Ash Gourd" value="Ash Gourd">Ash Gourd</option>
<option name="Beet Root" value="Beet Root">Beet Root</option>
<option name="Lab-Lab" value="Lab-Lab">Lab-Lab</option>
<option name="Ribed Guard" value="Ribed Guard">Ribed Guard</option>
<option name="Yam" value="Yam">Yam</option>
<option name="Apple" value="Apple">Apple</option>
<option name="Peach" value="Peach">Peach</option>
<option name="Pear" value="Pear">Pear</option>
<option name="Plums" value="Plums">Plums</option>
<option name="Litchi" value="Litchi">Litchi</option>
<option name="Ber" value="Ber">Ber</option>
<option name="Other Dry Fruit" value="Other Dry Fruit">Other Dry Fruit</option>
<option name="Jute & mesta" value="Jute & mesta">Jute & Mesta</option>


									</select>
											
										</div>
                                    </td>
									<script> 
document.getElementById("season").addEventListener("change", function() {  
 
const districtDropdown = document.getElementById('district');
const seasonDropdown = document.getElementById('season');
const cropDropdown = document.getElementById('crop');

 console.log(districtDropdown);
   console.log(seasonDropdown);
  console.log(cropDropdown);
  
  const selectedDistrict = districtDropdown.value;
  const selectedSeason = seasonDropdown.value;

  // Clear the current crop options
  cropDropdown.innerHTML = '<option value="">Select crop</option>';
  
  // If both district and season are selected, add the corresponding crop options to the dropdown
if (selectedDistrict && selectedSeason) {
  const options = cropOptions[selectedDistrict][selectedSeason];
  for (const option of options) {
    const optionElement = document.createElement('option');
    optionElement.value = option; // Set the value to the option text
    optionElement.text = option;
    cropDropdown.appendChild(optionElement);
  }
}
  
}); 
</script>  
									<td>
                                    	<div class="form-group">
											<input type = "number" step=0.01 name="area" placeholder="Area in Hectares" required class="form-control">
											
										</div>
                                    </td>
									
									<td>
                                    <center>
										<div class="form-group ">
											<button type="submit" value="Yield" name="Yield_Predict" class="btn btn-success btn-submit">Predict</button>
										</div>
                                    
                                    </center>
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
					
					
					if(isset($_POST['Yield_Predict'])){

					$state=trim($_POST['state']);
					$district=trim($_POST['district']);
					$season=trim($_POST['Season']);
					$crops=trim($_POST['crops']);
					$area=trim($_POST['area']);


					echo "Predicted crop yield (in Quintal) is: ";

					$Jstate=json_encode($state);
					$Jdistrict=json_encode($district);
					$Jseason=json_encode($season);
					$Jcrops=json_encode($crops);
					$Jarea=json_encode($area);

					$command = escapeshellcmd("python ML/yield_prediction/yield_prediction.py $Jstate $Jdistrict $Jseason $Jcrops $Jarea ");
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

