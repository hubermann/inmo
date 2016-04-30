<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script><!-- jquery online -->
<!-- <script language='javascript' type="text/javascript" src="js/jquery-1.7.1.min.js"></script> --><!-- jquery local -->

<!--[if lt IE 9]> // hacer compatible a Internet Explorer, desde las versiones 5 a la 8, con los navegadores modernos, 
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->


<script src='<?php echo base_url('public_folder/front/js/jquery.easing.1.3.js'); ?>'></script><!-- variedad de movimientos para efectos -->
<script src='<?php echo base_url('public_folder/front/js/jquery.animate-colors-min.js'); ?>'></script><!-- Animaciones de colores -->
<script src="<?php echo base_url('public_folder/front/js/jquery.bgpos.js'); ?>"></script><!-- Background positions -->
<script src="<?php echo base_url('public_folder/front/js/libs/modernizr-2.0.6.min.js'); ?>"></script><!--Este archivo logra que todo el HTML5 sea compatible en todos los navegadores-->
<!--<script src="js/modernizr.custom.45128.js"></script>--><!--Version customizada de nmodernzer-->


<!--Customizar selects form -->
	<script type="text/javascript" src="<?php echo base_url('public_folder/front/js/jquery.customSelect.js'); ?>"></script>
	<script type="text/javascript">
		$(function(){
			$('select.styled').customSelect();
		});
	</script>
<!--Customizar selects form -->


<!--animar anclas-->
<script src="<?php echo base_url('public_folder/front/js/anchor.jquery.js'); ?>" type="text/javascript"></script>

	
<!--Checkbox en select -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('public_folder/front/checkboxSelect/jquery.multiselect.js'); ?>"></script>
	<script type="text/javascript">
	$(function(){
		$("select#barrio").multiselect();
		$("select#barrio_filtro").multiselect({
			classes: 'ui-multiselect_filtro',
			selectedText: '# Selec.',
		});
	});
</script>
<!--Checkbox en select -->



<script src='<?php echo base_url('public_folder/front/js/efectos.js'); ?>'></script><!-- Acciones personales -->


<!--Enviar form sin recargar pagina-->
<script src="<?php echo base_url('public_folder/front/js/envio_form/runonload.js'); ?>"></script> 
<script src="<?php echo base_url('public_folder/front/js/envio_form/valida_envia.js'); ?>"></script>     
<!--Fin Enviar form sin recargar pagina-->