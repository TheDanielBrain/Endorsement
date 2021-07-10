<?php include_once('config.php');?>
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
	<?php
		$condition	=	' AND ParentId IS NULL';
		if(isset($_REQUEST['FirstName']) and $_REQUEST['FirstName']!=""){
			$condition	.=	' AND FirstName LIKE "%'.$_REQUEST['FirstName'].'%" ';
		}
		if(isset($_REQUEST['LastName']) and $_REQUEST['LastName']!=""){
			$condition	.=	' AND LastName LIKE "%'.$_REQUEST['LastName'].'%" ';
		}
		if(isset($_REQUEST['CustomerPhone']) and $_REQUEST['CustomerPhone']!=""){
			$condition	.=	' AND CustomerPhone LIKE "%'.$_REQUEST['CustomerPhone'].'%" ';
		}
		
		//Main queries
		$pages->default_ipp	= 10;
		$sql = $db->getRecFrmQry("SELECT * FROM customers WHERE 1 $condition");
		$pages->items_total = count($sql);
		$pages->mid_range = 9;
		$pages->paginate(); 
		 
		$userData = $db->getRecFrmQry("SELECT * FROM customers WHERE 1 $condition ORDER BY id DESC ".$pages->limit."");
	
	?>

   	<div class="container">
		<h1>Catalogo de clientes</h1>
		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-globe"></i> <strong>Buscar cliente</strong> <a href="add-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Agregar cliente</a></div>
			<div class="card-body">
				<?php
					if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
						echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Registro eliminado con exito!</div>';
					}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
						echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Registro actualizado con exito!</div>';
					}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
						echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> No realiaste cambios!</div>';
					}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
						echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Registro actualizado con exito!</div>';
					}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
						echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Registro no agregado <strong>Please try again!</strong></div>';
					}
				?>

				<div class="col-sm-12">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Buscar cliente</h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Nombre (s)</label>
									<input type="text" name="FirstName" id="FirstName" class="form-control" value="<?php echo isset($_REQUEST['FirstName'])?$_REQUEST['FirstName']:''?>" placeholder="Nombre (s)">
								</div>
							</div>

							<div class="col-sm-2">
								<div class="form-group">
									<label>Apellidos</label>
									<input type="email" name="LastName" id="LastName" class="form-control" value="<?php echo isset($_REQUEST['LastName'])?$_REQUEST['LastName']:''?>" placeholder="Apellidos">
								</div>
							</div>

							<div class="col-sm-2">
								<div class="form-group">
									<label>Telefono de cliente</label>
									<input type="tel" class="tel form-control" pattern=".{14,14}" name="CustomerPhone" id="CustomerPhone" x-autocompletetype="tel" value="<?php echo isset($_REQUEST['CustomerPhone'])?$_REQUEST['CustomerPhone']:''?>" placeholder="Telefono del cliente">
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label>&nbsp;</label>
									<div>
										<button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Buscar</button>
										<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> Limpiar</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	 
		<div class="clearfix"></div>

		<div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
						<th>#</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Telefono</th>
						<th class="text-center">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
					?>
					<tr>
						<td><?php echo $s;?></td>
						<td><?php echo utf8_decode($val['FirstName']);?></td>
						<td><?php echo utf8_decode($val['LastName']);?></td>
						<td><?php echo utf8_decode($val['CustomerPhone']);?></td>
						<td align="center">
							<a href="edit-users.php?editId=<?php echo $val['Id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="endorsement.php?ParentId=<?php echo $val['Id'];?>" class="text-primary"><i class="fas fa-users"></i> Aval</a> | 
							<a href="delete.php?delId=<?php echo $val['Id'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Eliminar</a>
						</td>

					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="5" align="center">Sin registros encontrados!</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		
		<div class="clearfix"></div>
     
		<div class="row marginTop">
			<div class="col-sm-12 paddingLeft pagerfwt">
				<?php if($pages->items_total > 0) { ?>
					<?php echo $pages->display_pages();?>
					<?php echo $pages->display_items_per_page();?>
					<?php echo $pages->display_jump_menu(); ?>
				<?php }?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.caret.js"></script>
	<script src="js/jquery.mobilePhoneNumber.min.js"></script>
	<script>
		$(document).ready(function() {
		jQuery(function($){
			  var input = $('[type=tel]')
			  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  input.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  })
			 });
		});
	</script>
    

</body>

</html>