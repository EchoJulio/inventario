$(document).ready(function(e){
	$('#buscar').click(function(e){
		e.preventDefault();
		var buscar = $('#producto').val();
		if (buscar.length > 1) {
			var url = 'http://localhost/inventario/productos/consulta_ajax';
			$.post(url,{'buscar':buscar}, function(data,status){
				respuesta = jQuery.parseJSON(data);
				//console.log(data);
  		  		if (status === 'success') {
	  				$("[name='titulo']").val(respuesta.titulo);
	  				$("[name='id']").val(respuesta.id);
  		  		}else{
  		  			alert('Al parece hubo un error con el servidor.');
  		  		}
			});
		}else{
			alert('Debes ingresar el nombre del producto.');
		}
	})
})
	
