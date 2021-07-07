<?php include_once('config.php');

if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row = $db->getAllRecords('customers', '*', ' AND Id="'.$_REQUEST['editId'].'"');
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!="") {
	extract($_REQUEST);

	if($FirstName==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
		exit;
	} elseif ($LastName=="") {

		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&editId='.$_REQUEST['editId']);

		exit;

	}elseif($CustomerPhone==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up&editId='.$_REQUEST['editId']);
		exit;
	}

	$data = array(
		'FirstName'=>$FirstName,
		'LastName'=>$LastName,
		'CustomerPhone'=>$CustomerPhone,
		'Address'=>$Address,
		'BetweenStreet1'=>$BetweenStreet1,
		'BetweenStreet2'=>$BetweenStreet2,
		'OwnHouse'=>$OwnHouse,
		'Occupation'=>$Occupation,
		'Enterprise'=>$Enterprise,
		'Area'=>$Area,
		'WorkPhone'=>$WorkPhone,
		'WorkAddress'=>$WorkAddress,
		'CivilStatus'=>$CivilStatus,
		'Spouse'=>$Spouse,
		'SpousePhone'=>$SpousePhone
	);

	$update	=	$db->update('customers', $data, array('Id'=>$editId));

	if ($update) {
		header('location: browse-users.php?msg=rus');
		exit;
	} else {
		header('location: browse-users.php?msg=rnu');
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

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> El telefono del cliente es obligatorio</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Registro agregado con exito</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Registro no agregado <strong>Por favor, intentelo nuevamente</strong></div>';

		}
		?>

		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Editar cliente</strong> <a href="browse-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Regresar</a></div>
			<div class="card-body">
				<div class="col-md-12">
					<h5 class="card-title">Los campos con <span class="text-danger">*</span> son obligatorios.</h5>
					<form method="post">
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Nombre (s) <span class="text-danger">*</span></label>
								<input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="Ingresar nombre (s)" value="<?php echo isset($row[0]['FirstName'])?$row[0]['FirstName']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Apellidos <span class="text-danger">*</span></label>
								<input type="text" name="LastName" id="LastName" class="form-control" placeholder="Ingresar apellidos" value="<?php echo isset($row[0]['LastName'])?$row[0]['LastName']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del cliente </label>
								<input type="tel" class="tel form-control" name="CustomerPhone" id="CustomerPhone" x-autocompletetype="tel" placeholder="Ingresar telefono" value="<?php echo isset($row[0]['CustomerPhone'])?$row[0]['CustomerPhone']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="Address" id="Address" placeholder="Ingresar direccion" value="<?php echo isset($row[0]['Address'])?$row[0]['Address']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Entre la calle </label>
								<input type="text" name="BetweenStreet1" id="BetweenStreet1" class="form-control" placeholder="Ingresar calle" value="<?php echo isset($row[0]['BetweenStreet1'])?$row[0]['BetweenStreet1']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Y la calle </label>
								<input type="text" name="BetweenStreet2" id="BetweenStreet2" class="form-control" placeholder="Ingresar calle" value="<?php echo isset($row[0]['BetweenStreet2'])?$row[0]['BetweenStreet2']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Tipo de vivienda <span class="text-danger">*</span></label>
								<select class="form-control" name="OwnHouse" id="OwnHouse" required>
									<option value="">Seleccionar tipo de vivienda</option>
									<option value="1" <?php if($row[0]['OwnHouse'] == '1') { echo ' selected="selected"'; } ?>> Propia</option>
									<option value="0"<?php if($row[0]['OwnHouse'] == '0'){ echo ' selected="selected"'; } ?>>Rentada</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Ocupacion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="Occupation" id="Occupation" placeholder="Ingresar ocpuacion" value="<?php echo isset($row[0]['Occupation'])?$row[0]['Occupation']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Empresa <span class="text-danger">*</span></label>
								<input type="text" name="Enterprise" id="Enterprise" class="form-control" placeholder="Ingresar empresa" value="<?php echo isset($row[0]['Enterprise'])?$row[0]['Enterprise']:''; ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label>Area </label>
								<input type="text" name="Area" id="Area" class="form-control" placeholder="Ingresar area" value="<?php echo isset($row[0]['Area'])?$row[0]['Area']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del trabajo </label>
								<input type="tel" class="tel form-control"  name="WorkPhone" id="WorkPhone" x-autocompletetype="tel" placeholder="Ingresar telefono de trabajo" value="<?php echo isset($row[0]['WorkPhone'])?$row[0]['WorkPhone']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion del trabajo <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="WorkAddress" id="WorkAddress" placeholder="Ingresar direccion del trabajo" value="<?php echo isset($row[0]['WorkAddress'])?$row[0]['WorkAddress']:''; ?>" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Estado civil <span class="text-danger">*</span></label>
								<select class="form-control" name="CivilStatus" id="CivilStatus" required>
									<option value="">Seleccionar estado civil</option>
									<option value="1" <?php if($row[0]['CivilStatus'] == '1') { echo ' selected="selected"'; } ?>> Soltero</option>
									<option value="2"<?php if($row[0]['CivilStatus'] == '2'){ echo ' selected="selected"'; } ?>>Casado</option>
									<option value="3"<?php if($row[0]['CivilStatus'] == '3'){ echo ' selected="selected"'; } ?>>Viudo</option>
									<option value="4"<?php if($row[0]['CivilStatus'] == '4'){ echo ' selected="selected"'; } ?>>Divorciado</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Conyuge </label>
								<input type="text" name="Spouse" id="Spouse" class="form-control" placeholder="Ingresar conyuge" value="<?php echo isset($row[0]['Spouse'])?$row[0]['Spouse']:''; ?>">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono de conyuge </label>
								<input type="tel" class="tel form-control" name="SpousePhone" id="SpousePhone" x-autocompletetype="tel" placeholder="Ingresar telefono de conyuge" value="<?php echo isset($row[0]['SpousePhone'])?$row[0]['SpousePhone']:''; ?>">
							</div>
						</div>
						<input type="hidden" name="editId" id="editId" value="<?php echo isset($_REQUEST['editId'])?$_REQUEST['editId']:''?>">
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
			});
		});
	</script>
</body>
</html>