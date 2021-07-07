<?php include_once('config.php');

if(isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {

	extract($_REQUEST);
	if ($FirstName=="") {
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($LastName==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	} elseif ($CustomerPhone=="") {
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	} else {

		$data = array(
			'FirstName'=>utf8_decode($FirstName),
			'LastName'=>utf8_decode($LastName),
			'CustomerPhone'=>utf8_decode($CustomerPhone),
			'Address'=>utf8_decode($Address),
			'BetweenStreet1'=>utf8_decode($BetweenStreet1),
			'BetweenStreet2'=>utf8_decode($BetweenStreet2),
			'OwnHouse'=>$OwnHouse,
			'Occupation'=>utf8_decode($Occupation),
			'Enterprise'=>utf8_decode($Enterprise),
			'Area'=>utf8_decode($Area),
			'WorkPhone'=>utf8_decode($WorkPhone),
			'WorkAddress'=>utf8_decode($WorkAddress),
			'CivilStatus'=>$CivilStatus,
			'Spouse'=>utf8_decode($Spouse),
			'SpousePhone'=>utf8_decode($SpousePhone)
		);

		$insert	= $db->insert('customers', $data);

		if($insert) {
			header('location:browse-users.php?msg=ras');
			exit;
		} else {
			header('location:browse-users.php?msg=rna');
			exit;
		}
	}
}

?>

<!doctype html>
<html lang="en-US">
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

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User name is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User email is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User phone is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';

		}

		?>

		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Agregar cliente</strong> <a href="browse-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Regresar</a></div>
			<div class="card-body">
				<div class="col-md-12">
					<h5 class="card-title">Los campos con <span class="text-danger">*</span> son obligatorios.</h5>
					<form method="post">
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Nombre (s) <span class="text-danger">*</span></label>
								<input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="Ingresar nombre (s)" required>
							</div>

							<div class="form-group col-md-3">
								<label>Apellidos <span class="text-danger">*</span></label>
								<input type="text" name="LastName" id="LastName" class="form-control" placeholder="Ingresar apellidos" required>
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del cliente </label>
								<input type="tel" class="tel form-control" name="CustomerPhone" id="CustomerPhone" x-autocompletetype="tel" placeholder="Ingresar telefono">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="Address" id="Address" placeholder="Ingresar direccion" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Entre la calle </label>
								<input type="text" name="BetweenStreet1" id="BetweenStreet1" class="form-control" placeholder="Ingresar calle">
							</div>

							<div class="form-group col-md-3">
								<label>Y la calle </label>
								<input type="text" name="BetweenStreet2" id="BetweenStreet2" class="form-control" placeholder="Ingresar calle">
							</div>

							<div class="form-group col-md-3">
								<label>Tipo de vivienda <span class="text-danger">*</span></label>
								<select class="form-control" name="OwnHouse" id="OwnHouse" required>
									<option value="">Seleccionar tipo de vivienda</option>
									<option value="1" >Propia</option>
									<option value="0">Rentada</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Ocupacion <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="Occupation" id="Occupation" placeholder="Ingresar ocpuacion" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Empresa <span class="text-danger">*</span></label>
								<input type="text" name="Enterprise" id="Enterprise" class="form-control" placeholder="Ingresar empresa" required>
							</div>

							<div class="form-group col-md-3">
								<label>Area </label>
								<input type="text" name="Area" id="Area" class="form-control" placeholder="Ingresar area">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono del trabajo </label>
								<input type="tel" class="tel form-control"  name="WorkPhone" id="WorkPhone" x-autocompletetype="tel" placeholder="Ingresar telefono de trabajo">
							</div>

							<div class="form-group col-md-3">
								<label>Direccion del trabajo <span class="text-danger">*</span></label>
								<input type="text" class="tel form-control" name="WorkAddress" id="WorkAddress" placeholder="Ingresar direccion del trabajo" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Estado civil <span class="text-danger">*</span></label>
								<select class="form-control" name="CivilStatus" id="CivilStatus" required>
									<option value="">Seleccionar estado civil</option>
									<option value="1" >Soltero</option>
									<option value="2">Casado</option>
									<option value="3">Viudo</option>
									<option value="4">Divorciado</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label>Conyuge </label>
								<input type="text" name="Spouse" id="Spouse" class="form-control" placeholder="Ingresar conyuge">
							</div>

							<div class="form-group col-md-3">
								<label>Telefono de conyuge </label>
								<input type="tel" class="tel form-control" name="SpousePhone" id="SpousePhone" x-autocompletetype="tel" placeholder="Ingresar telefono de conyuge">
							</div>
						</div>
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