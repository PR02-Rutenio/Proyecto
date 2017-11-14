window.onload=function(){

	document.getElementById("tipo").addEventListener("change", mostrar);

	function mostrar(){
		if(document.getElementById('tipo').value=='teoria'){
			document.getElementById('span').innerHTML = '<br>Elegir con o sin proyector:<select name="subtipo"><option>Cualquiera</option><option>Con proyector</option><option>Sin proyector</option></select><br>';
		}
		

		if(document.getElementById('tipo').value=='sala'){
			document.getElementById('span').innerHTML = '<br>Elegir tipo de sala:<select name="subtipo"><option>Cualquiera</option><option>Despacho para entrevistas</option><option>Sala de reuniones</option></select><br>';
		}

		var valor=document.getElementById('tipo').value;

		if((valor=='Proyector')||(valor=='Cualquiera')||(valor=='Móvil')||(valor=='Carro de portatiles')||(valor=='Portátil')){
			var node = document.getElementById('span');
			while (node.hasChildNodes()) {
			    node.removeChild(node.firstChild);
			}//fin while
		}//fin else
	}//fin funcion
	
}