<?php 
include_once('config.php');

if(isset($_REQUEST['ParentId']) and $_REQUEST['ParentId']!=""){
	$CustomerId = $_REQUEST['ParentId'];

	$row = $db->getAllRecords('customers', '*', ' AND ParentId="'.$CustomerId.'"');
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!="") {
	extract($_REQUEST);
	
	// VALIDATIOn
	if($aFirstName=="" && $bFirstName){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
		exit;
	} elseif ($aLastName=="" && $bLastName) {
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&editId='.$_REQUEST['editId']);
		exit;
	}

	$aEndorsement = array(
		'Id'=>$aCustomerId,
		'FirstName'=>$aFirstName,
		'LastName'=>$aLastName,
		'CustomerPhone'=>$aCustomerPhone,
		'Address'=>$aAddress,
		'BetweenStreet1'=>$aBetweenStreet1,
		'BetweenStreet2'=>$aBetweenStreet2,
		'OwnHouse'=>$aOwnHouse,
		'Occupation'=>$aOccupation,
		'Enterprise'=>$aEnterprise,
		'Area'=>$aArea,
		'WorkPhone'=>$aWorkPhone,
		'WorkAddress'=>$aWorkAddress,
		'CivilStatus'=>$aCivilStatus,
		'Spouse'=>$aSpouse,
		'SpousePhone'=>$aSpousePhone,
		'ParentId'=>$aParentId
	);

	$bEndorsement = array(
		'Id'=>$bCustomerId,
		'FirstName'=>$bFirstName,
		'LastName'=>$bLastName,
		'CustomerPhone'=>$bCustomerPhone,
		'Address'=>$bAddress,
		'BetweenStreet1'=>$bBetweenStreet1,
		'BetweenStreet2'=>$bBetweenStreet2,
		'OwnHouse'=>$bOwnHouse,
		'Occupation'=>$bOccupation,
		'Enterprise'=>$bEnterprise,
		'Area'=>$bArea,
		'WorkPhone'=>$bWorkPhone,
		'WorkAddress'=>$bWorkAddress,
		'CivilStatus'=>$bCivilStatus,
		'Spouse'=>$bSpouse,
		'SpousePhone'=>$bSpousePhone,
		'ParentId'=>$bParentId
	);

	$data = array($aEndorsement, $bEndorsement);

	$save = false;
	foreach($data as $Index=>$Value){
		// print_r("Id " . $Value['Id'] . " <br />");
		if(empty($Value['Id'])) {
			echo "Sin id";
			$save = $db->insert('customers', $Value);
		} else {
			echo "con id";
			$save =	$db->update('customers', $Value, array('Id'=>$Value['Id']));
		}
	}

	if($save) {
		header('location:browse-users.php?msg=ras');
		exit;
	} else {
		header('location:browse-users.php?msg=rna');
		exit;
	}
}
?>

<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Aval</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
</head>

<body>
	<div class="container">
		<?php
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> El nombre es obligatorio</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Los apellidos son obligatorios</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Aval agregado con exito</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Aval no agregado <strong>Por favor, intentelo nuevamente</strong></div>';

		}
		?>

		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Referencias</strong> <a href="browse-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Regresar</a></div>
			<div class="card-body">
				<div class="col-md-12">
					<h5 class="card-title">Referencia 1</h5>
					<h5 class="card-title">Los campos con <span class="text-danger">*</span> son obligatorios.</h5>
					<form method="post">
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Nombre (s) <span class="text-danger">*</span></label>
								<input type="text" name="aFirstName" id="FirstName" class="form-control" placeholder="Ingresar nombre (s)" value="<?php echo isset($row[0]['FirstName'])?$row[0]['FirstName']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Apellidos <span class="text-danger">*</span></label>
								<input type="text" name="aLastName" id="LastName" class="form-control" placeholder="Ingresar apellidos" value="<?php echo isset($row[0]['LastName'])?$row[0]['LastName']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del cliente </label>
								<input type="tel" class="tel form-control" name="aCustomerPhone" id="CustomerPhone" x-autocompletetype="tel" placeholder="Ingresar telefono" value="<?php echo isset($row[0]['CustomerPhone'])?$row[0]['CustomerPhone']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="aAddress" id="Address" placeholder="Ingresar direccion" value="<?php echo isset($row[0]['Address'])?$row[0]['Address']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Entre la calle </label>
								<input type="text" name="aBetweenStreet1" id="BetweenStreet1" class="form-control" placeholder="Ingresar calle" value="<?php echo isset($row[0]['BetweenStreet1'])?$row[0]['BetweenStreet1']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Y la calle </label>
								<input type="text" name="aBetweenStreet2" id="BetweenStreet2" class="form-control" placeholder="Ingresar calle" value="<?php echo isset($row[0]['BetweenStreet2'])?$row[0]['BetweenStreet2']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Tipo de vivienda <span class="text-danger">*</span></label>
								<select class="form-control" name="aOwnHouse" id="OwnHouse" required>
									<option value="">Seleccionar tipo de vivienda</option>
									<option value="1" <?php if(isset($row[0]['OwnHouse']) == '1') { echo ' selected="selected"'; } ?>> Propia</option>
									<option value="0"<?php if(isset($row[0]['OwnHouse']) == '0'){ echo ' selected="selected"'; } ?>>Rentada</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Ocupacion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="aOccupation" id="Occupation" placeholder="Ingresar ocpuacion" value="<?php echo isset($row[0]['Occupation'])?$row[0]['Occupation']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Empresa <span class="text-danger">*</span></label>
								<input type="text" name="aEnterprise" id="Enterprise" class="form-control" placeholder="Ingresar empresa" value="<?php echo isset($row[0]['Enterprise'])?$row[0]['Enterprise']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Area </label>
								<input type="text" name="aArea" id="Area" class="form-control" placeholder="Ingresar area" value="<?php echo isset($row[0]['Area'])?$row[0]['Area']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del trabajo </label>
								<input type="tel" class="tel form-control"  name="aWorkPhone" id="WorkPhone" x-autocompletetype="tel" placeholder="Ingresar telefono de trabajo" value="<?php echo isset($row[0]['WorkPhone'])?$row[0]['WorkPhone']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion del trabajo <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="aWorkAddress" id="WorkAddress" placeholder="Ingresar direccion del trabajo" value="<?php echo isset($row[0]['WorkAddress'])?$row[0]['WorkAddress']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Estado civil <span class="text-danger">*</span></label>
								<select class="form-control" name="aCivilStatus" id="CivilStatus" required>
									<option value="">Seleccionar estado civil</option>
									<option value="1" <?php if(isset($row[0]['CivilStatus']) == '1') { echo ' selected="selected"'; } ?>> Soltero</option>
									<option value="2"<?php if(isset($row[0]['CivilStatus']) == '2'){ echo ' selected="selected"'; } ?>>Casado</option>
									<option value="3"<?php if(isset($row[0]['CivilStatus']) == '3'){ echo ' selected="selected"'; } ?>>Viudo</option>
									<option value="4"<?php if(isset($row[0]['CivilStatus']) == '4'){ echo ' selected="selected"'; } ?>>Divorciado</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Conyuge </label>
								<input type="text" name="aSpouse" id="Spouse" class="form-control" placeholder="Ingresar conyuge" value="<?php echo isset($row[0]['Spouse'])?$row[0]['Spouse']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono de conyuge </label>
								<input type="tel" class="tel form-control" name="aSpousePhone" id="SpousePhone" x-autocompletetype="tel" placeholder="Ingresar telefono de conyuge" value="<?php echo isset($row[0]['SpousePhone'])?$row[0]['SpousePhone']:''; ?>">
							</div>
						</div>
						<input type="hidden" name="aCustomerId" id="aCustomerId" value="<?php echo isset($row[0]['Id'])?$row[0]['Id']:''?>">
						<input type="hidden" name="aParentId" id="aParentId" value="<?php echo isset($_REQUEST['ParentId'])?$_REQUEST['ParentId']:''?>">

						<h5 class="card-title">Referencia 2</h5>
                    
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Nombre (s) <span class="text-danger">*</span></label>
								<input type="text" name="bFirstName" id="FirstName" class="form-control" placeholder="Ingresar nombre (s)" value="<?php echo isset($row[1]['FirstName'])?$row[1]['FirstName']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Apellidos <span class="text-danger">*</span></label>
								<input type="text" name="bLastName" id="LastName" class="form-control" placeholder="Ingresar apellidos" value="<?php echo isset($row[1]['LastName'])?$row[1]['LastName']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del cliente </label>
								<input type="tel" class="tel form-control" name="bCustomerPhone" id="bCustomerPhone" x-autocompletetype="tel" placeholder="Ingresar telefono" value="<?php echo isset($row[1]['CustomerPhone'])?$row[1]['CustomerPhone']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="bAddress" id="Address" placeholder="Ingresar direccion" value="<?php echo isset($row[1]['Address'])?$row[1]['Address']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Entre la calle </label>
								<input type="text" name="bBetweenStreet1" id="BetweenStreet1" class="form-control" placeholder="Ingresar calle" value="<?php echo isset($row[1]['BetweenStreet1'])?$row[1]['BetweenStreet1']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Y la calle </label>
								<input type="text" name="bBetweenStreet2" id="BetweenStreet2" class="form-control" placeholder="Ingresar calle" value="<?php echo isset($row[1]['BetweenStreet2'])?$row[1]['BetweenStreet2']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Tipo de vivienda <span class="text-danger">*</span></label>
								<select class="form-control" name="bOwnHouse" id="OwnHouse" required>
									<option value="">Seleccionar tipo de vivienda</option>
									<option value="1" <?php if(isset($row[1]['OwnHouse']) == '1') { echo ' selected="selected"'; } ?>> Propia</option>
									<option value="0"<?php if(isset($row[1]['OwnHouse']) == '0') { echo ' selected="selected"'; } ?>>Rentada</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Ocupacion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="bOccupation" id="Occupation" placeholder="Ingresar ocpuacion" value="<?php echo isset($row[1]['Occupation'])?$row[1]['Occupation']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Empresa <span class="text-danger">*</span></label>
								<input type="text" name="bEnterprise" id="Enterprise" class="form-control" placeholder="Ingresar empresa" value="<?php echo isset($row[1]['Enterprise'])?$row[1]['Enterprise']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Area </label>
								<input type="text" name="bArea" id="Area" class="form-control" placeholder="Ingresar area" value="<?php echo isset($row[1]['Area'])?$row[1]['Area']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del trabajo </label>
								<input type="tel" class="tel form-control"  name="bWorkPhone" id="bWorkPhone" x-autocompletetype="tel" placeholder="Ingresar telefono de trabajo" value="<?php echo isset($row[1]['WorkPhone'])?$row[1]['WorkPhone']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion del trabajo <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="bWorkAddress" id="WorkAddress" placeholder="Ingresar direccion del trabajo" value="<?php echo isset($row[1]['WorkAddress'])?$row[1]['WorkAddress']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Estado civil <span class="text-danger">*</span></label>
								<select class="form-control" name="bCivilStatus" id="CivilStatus" required>
									<option value="">Seleccionar estado civil</option>
									<option value="1" <?php if(isset($row[1]['CivilStatus']) == "1") { echo ' selected="selected"'; } ?>> Soltero</option>
									<option value="2"<?php if(isset($row[1]['CivilStatus']) == "2") { echo ' selected="selected"'; } ?>>Casado</option>
									<option value="3"<?php if(isset($row[1]['CivilStatus']) == "3") { echo ' selected="selected"'; } ?>>Viudo</option>
									<option value="4"<?php if(isset($row[1]['CivilStatus']) == "4") { echo ' selected="selected"'; } ?>>Divorciado</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Conyuge </label>
								<input type="text" name="bSpouse" id="Spouse" class="form-control" placeholder="Ingresar conyuge" value="<?php echo isset($row[1]['Spouse'])?$row[1]['Spouse']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono de conyuge </label>
								<input type="tel" class="tel form-control" name="bSpousePhone" id="bSpousePhone" x-autocompletetype="tel" placeholder="Ingresar telefono de conyuge" value="<?php echo isset($row[1]['SpousePhone'])?$row[1]['SpousePhone']:''; ?>">
							</div>
						</div>
						<input type="hidden" name="bCustomerId" id="bCustomerId" value="<?php echo isset($row[1]['Id'])?$row[1]['Id']:''?>">
						<input type="hidden" name="bParentId" id="bParentId" value="<?php echo isset($_REQUEST['ParentId'])?$_REQUEST['ParentId']:''?>">
						<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.caret.js"></script>
	<script src="js/jquery.mobilePhoneNumber.min.js"></script>
	<script>
		$(document).ready(function() {
		jQuery(function($) {
			  // FIRST ENDORSEMENT
			  var CustomerPone = $('#CustomerPhone')
			  CustomerPone.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  CustomerPone.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  });

			  var WorkPhone = $('#WorkPhone')
			  WorkPhone.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  WorkPhone.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  });

			  var SpousePhone = $('#SpousePhone')
			  SpousePhone.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  SpousePhone.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  });

			  // SECOND ENDORSEMENT
			  var bCustomerPone = $('#bCustomerPhone')
			  bCustomerPone.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  bCustomerPone.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  });

			  var bWorkPhone = $('#bWorkPhone')
			  bWorkPhone.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  bWorkPhone.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  });

			  var bSpousePhone = $('#bSpousePhone')
			  bSpousePhone.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  bSpousePhone.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  });
			});
		});
	</script>
    

</body>
</html>