<div class="container">
	<center><h3>Lista de categorias</h3></center>
	
	<button id="btnAdd" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar nuevo </button>
    <br>
    <br>
	<table class="table table-hover" id="misDatos2">
		<thead>
			<tr>
				<td>ID</td>
				<td>nombre</td>
				<td>definicion</td>
				<td>fecha creación</td>
				<td>Update</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	
	<div class="alert alert-success" style="display: none;">
		<!--mensaje de confirmacion--->	
	</div>
</div> <!--fin container-->


    
	

<!--ventana modal para agregar registro-->
<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="myForm" action="" method="post" class="form-horizontal">
        		<input type="hidden" name="txtId" value="0">
        		<div class="form-group">
        			<label for="name" class="label-control col-md-12">Nombre categoria</label>
        			<div class="col-md-12">
        				<input type="text" name="txtnombre" class="form-control">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="address" class="label-control col-md-4">Descripción</label>
        			<div class="col-md-12">
        				<textarea class="form-control" name="txtdescripcion"></textarea>
        			</div>
        		</div>
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!--ventana modal para eliminar--->
<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Usted está seguro de eliminar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnDelete">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- funciones javascript para elimininar, listar y agregar-->
<script>
	$(function(){
		listaCategoria();

		//Add New
		$('#btnAdd').click(function(){
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('New Category');
			$('#myForm').attr('action', '<?php echo base_url() ?>category/agregarCategory');
		});


		$('#btnSave').click(function(){
			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
			//validate form
			var nombre = $('input[name=txtnombre]');
			var descripcion = $('textarea[name=txtdescripcion]');
			

			
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#myModal').modal('hide');
							$('#myForm')[0].reset();
							if(response.type=='add'){
								var type = 'agrego'
							}else if(response.type=='update'){
								var type ="actualizo"
							}
							$('.alert-success').html('El registro se '+type+' satisfactoriamente').fadeIn().delay(4000).fadeOut('slow');
							//listaCategoria();
							$('#misDatos2').DataTable().ajax.reload();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Los datos no fueron agregados');
					}
				});
			
		});


		$('#misDatos2').on('click', '.item-delete', function(){
			var id = $(this).attr('data');
			$('#deleteModal').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url() ?>category/eliminarCategory',
					data:{catid:id},
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#deleteModal').modal('hide');
							$('.alert-success').html('El registro se eliminó correctamente...').fadeIn().delay(4000).fadeOut('slow');
							$('#misDatos2').DataTable().ajax.reload();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Error en eliminar');
					}
				});
			});
		});
		

		//editar datos de categoria
		$('#misDatos2').on('click', '.item-edit', function(){
			var id = $(this).attr('data');
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Editar Categoria');
			$('#myForm').attr('action', '<?php echo base_url() ?>category/actualizarCategory');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>category/editarcategory',
				data: {id: id},
				async: false,
				dataType: 'json',
				success: function(data){
					$('input[name=txtnombre]').val(data.catname);
					$('textarea[name=txtdescripcion]').val(data.catdefinition);
					$('input[name=txtId]').val(data.catid);
					
				},
				error: function(){
					alert('No se pudieron editar los datos.');
				}
			});
		});
		

		//function para listar categoria jsDataTable
		function listaCategoria(){
			$(document).ready(function () {        
			$('#misDatos2').DataTable({       
				"ajax": {
					url : "<?php echo base_url().'category/listaCategoria2'; ?>",
					type : "POST"
				},
			});

			});			
		}
	});
</script>