<header>

	<div id="content_logo">
		<a id="logo" href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('public_folder/front/layout/img_compartidas_estetica/logo_martin_cesarsky.png') ?>" height="65" width="320" alt=""> </a>
	</div><!-- content_logo -->


	<div id="content_buscador_tel">
		<div id="buscador_header">
			<p>BUSCAR <span>POR CODIGO</span></p>

			<form id="buscardor_header" name="buscardor_header" method="post" action="<?php echo base_url('busqueda-codigo'); ?>">
			    
			    <!-- <label for="name" class="nombre_campos">Nombre o raz&oacute;n social:</label> -->
			    <input name="codigo_propiedad" id="name" type="text" class="campo_buscador_header required">
			    <!-- <label class="error" for="name" id="name_error">Debe completar este campo.</label>		   	     -->			    
			    <input type="submit"  name="submit" class="bt_buscar_header" value="submit"></input>             
			    
			</form>
		</div><!-- buscador_header -->

		<div id="tels_header">
			<p><span>Nuñez</span> 4704-6925 <span>San Isidro</span> 4737-4545 <span>Pilar</span> 152 311 4809</p>
		</div><!-- tels_header -->

	</div><!-- content_buscador_tel -->

	<nav id="bot_ppal">    
		<ul>			    
		    <li class="contacto"><a href="<?php echo base_url('contacto'); ?>">CONTACTO</a></li>
		    <li class="empresa"><a href="<?php echo base_url('propiedades'); ?>">PROPIEDADES</a></li>
		    <li class="index"><a href="<?php echo base_url('/'); ?>">HOME</a></li>
		</ul>			    
	</nav><!-- bot_ppal -->

</header>
