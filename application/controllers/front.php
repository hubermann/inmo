<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(array('propiedad', 'categoria','barrio','sucursal','tipos_transaccion','imagenes_propiedad'));
		$this->load->helper('form');
	}


	public function index(){	
		$data['destacadas'] = $this->propiedad->get_destacadas($limit=9);
		$this->load->view('index', $data);
	}


	public function busqueda_por_codigo(){
		if(!$this->input->post('codigo_propiedad')){
			$data['propiedad'] = "";
			$data['mensaje'] = "No se recibio codigo de propiedad.";
			$this->load->view('mensaje');
		}else{
			$codigo = $this->input->post('codigo_propiedad');
			$propiedad = $this->propiedad->get_por_codigo($codigo);
			
			if($propiedad){
				if($propiedad->id!=""){
					redirect('propiedad/'.$propiedad->id);
				}
				$data['mensaje'] = "No se encontro propiedad copn ese codigo.";
				$this->load->view('mensaje');
			}

			$data['mensaje'] = "No se encontro propiedad con ese codigo.";
			$this->load->view('mensaje', $data);
		}
	#redirect('/');	 

	}


	public function propiedades(){
		//Pagination
	$per_page = 12;
	$page = $this->uri->segment(2);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->propiedad->count_rows() / $per_page);

		//Pagination
		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'propiedades/'.$i.'" > '. $i .'</a></li>'; 
		} 

	}
	
		$data['propiedades'] = $this->propiedad->get_records_front($per_page,$start);
		$this->load->view('propiedades', $data);
	}

	public function busqueda(){
		//Pagination
	$per_page = 12;
	$page = $this->uri->segment(2);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->propiedad->count_rows_busqueda() / $per_page);

		//Pagination
		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'busqueda/'.$i.'" > '. $i .'</a></li>'; 
		} 

	}
	
		$data['propiedades'] = $this->propiedad->get_records_busqueda($per_page,$start);
		$this->load->view('propiedades', $data);
	}



	public function propiedad(){
		$id_propiedad =$this->uri->segment(2);	
		if( empty($id_propiedad) ){ redirect('/'); }
		$data['propiedad'] = $this->propiedad->get_record($id_propiedad);
		if( empty($data['propiedad']) ){ redirect('/'); }
		$this->load->view('detalle_propiedad', $data);
	}

	public function contacto(){
		$this->load->view('contacto');
	}

	public function envio_contacto(){
		$nombre = $this->input->post('nombre'); 
		$apellido = $this->input->post('apellido');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$consulta = $this->input->post('consulta');


		                                                
		$header = 'From: ' . $nombre . " \r\n";     
		$header .= 'Reply-To: ' . $email . " \r\n";
		$header .= "BCC:damiangallo@gmail.com \r\n";       
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/html; charset=iso-8859-1 \r\n";
		//$header .= "Content-type: text/html \r\n";


		$mensaje = '

		<html>
		<head>
		<title>Contacto desde el sitio "Cersarky"</title>
		<link href="http://www.dominio.com.ar/layout/envia_form_html.css" rel="stylesheet" type="text/css" />
		<link href="http://www.dominio.com.ar/layout/fonts/fuentes.css" rel="stylesheet" type="text/css" />

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		</head>

		<body>

		       <div id="container">

		           <!--
		           <div id="logo">
		            <img src="http://www.dominio.com/imagenes/logo.gif">
		           </div><!--logo-->  
		        
		                                  
		           <div id="cuerpo_mail">               
		       
		                <h3>Datos de Contacto:</h3>                

		                <ul>
		                <li><b>Nombre:</b> ' .$nombre. '</li>
		                <li><b>Apellido:</b> ' .$apellido. '</li>
		                <li><b>E-mail:</b> ' .$email. '</li>
		                <li><b>Telefono:</b> ' .$phone. '</li>
		                </ul>
		                
		                <br />                
		                
		                <h3>Consulta:</h3> 
		                <p> ' .$consulta. '</p>
		                
		                
		            </div><!--cuerpo_mail--> 
		        
		        </div><!--container-->  
		         
		    
		</body>
		</html>


		';
		               
		$destinatario = 'zonanorte@martincesarsky.com.ar';
		//$destinatario = 'damiangallo@gmail.com';
		$asunto = 'Contacto desde el sitio Martín Cesarsky';

		mail($destinatario, $asunto, utf8_decode($mensaje), utf8_decode($header));

		echo 'Hemos recibido su consulta, en breve nos comunicaremos con usted.';
	}


	public function form_a_completar(){
		$this->load->view('form_a_completar');
	}

	public function arma_envia(){
		/* ---------------------------------
		GENERO LAS VARIABLES A USAR
		------------------ ---------------*/
		$mail_destinatario = $this->input->post('mail_destinatario');
		$nombre_remitente = $this->input->post('nombre_remitente');
		$mail_remitente = $this->input->post('mail_remitente');
		$comentario = $this->input->post('comentario');
		$titulo_propiedad = $this->input->post('titulo_propiedad'); //Esto viene del valida_envia.js
		$lugar_propiedad = $this->input->post('lugar_propiedad'); //Esto viene del valida_envia.js
		$precio_propiedad = $this->input->post('precio_propiedad'); //Esto viene del valida_envia.js
		$sup_total_propiedad = $this->input->post('sup_total_propiedad'); //Esto viene del valida_envia.js
		$codigo_propiedad = $this->input->post('codigo_propiedad'); //Esto viene del valida_envia.js
		$codigo_interno = $this->input->post('codigo_interno');
		$vinculo_propiedad = base_url('propiedad/'.$codigo_propiedad);

		header('Content-Type: text/html; charset=UTF-8');




		/* ---------------------------------------------------------------------------
		ARMO EL ENCABEZADO, EL REMITENTE Y A QUIEN SE DEBE CONTESTAR EL MAIL RECIBIDO
		------------------ ---------------------------------------------------------*/                                          
		$header = 'From: '.$nombre_remitente." \r\n";     
		$header .= 'Reply-To: '.$mail_remitente." \r\n";   
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/html; charset=iso-8859-1 \r\n";
		//$header .= "Content-type: text/html \r\n";




		/* ---------------------------------------------------------------
		ARMO EL CUERPO DEL MAIL USANDO LAS VARIABLES DE ARRIBA
		------------------ --------------------------------------------*/
		$mensaje = '

		<html>
		<head>
		<title>'.$titulo_propiedad.'</title>
		<!-- <link href="css/envia_form_html.css" rel="stylesheet" type="text/css" />-->
		<!-- <link href="'.base_url('public_folder/front/layout/fonts/fuentes.css').'" rel="stylesheet" type="text/css" /> -->

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


		</head>

		<body>


		<!-- BODY -->
		<table cellpadding="0" cellspacing="0" width="650" style="border:1px solid #D2D2D2;">
		  <tr>
		  
		    <td bgcolor="#efefef">


		      <!-- HEADER -->
		      <table cellpadding="0" cellspacing="0" cellpadding="0" cellspacing="0" width="650" height="90" bgcolor="#FFFFFF">
		        <tr>
		          <td width="350" align="left" style="padding-left:25px;">
		            <a href="' .$vinculo_propiedad. '">
		              <img src="'.base_url('public_folder/front/layout/img_compartidas_estetica/logo_mail.jpg').'" height="35" width="200">
		            </a>         
		          </td>
		          <!--<td width="300" align="right"><p style="margin-right:40px; color:#cecece; font-size:13px">26</p></td>-->
		        </tr>
		      </table><!-- /HEADER -->

		      
		      
		      <table cellpadding="0" cellspacing="0">
		        <tr>


		          <td style="padding:0px">


		            <!-- REMITENTE-->  
		            <table cellpadding="0" cellspacing="0" width="650" class="grupo_info">
		              <tr>
		                <td style="padding:25px; border-bottom: 1px solid #D2D2D2;">

		                  <p style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#45473D; line-height: 22px;  ">
		                    <strong>' .$nombre_remitente. '</strong> (' .$mail_remitente. ') te recomend&oacute; esta propiedad.<br />
		                    <strong>Comentario:</strong>
		                    ' .$comentario. '
		                  </p>

		                </td>
		              </tr>
		            </table>
		            <!-- FIN REMITENTE-->



		            <!-- DESARROLLO-->  
		            <table cellpadding="0" cellspacing="0" width="650" class="grupo_info">
		              <tr>
		                <td style="padding:25px">

		                  <h1 style="color:#aa0027; font-family: Arial, Helvetica, sans-serif; font-size: 23px; text-decoration: none; margin-bottom: 10px;">' .$titulo_propiedad. '</h1>
		                  
		                  <p style="font-family:Arial, sans-serif; font-size: 12px; margin-top: 10px; line-height:20px; color:#45473D;">
		                   -  ' .$lugar_propiedad. ' <br />
		                   -  <span style="font-weight: bold;"> ' .$precio_propiedad. ' </span><br />
		                   -  ' .$sup_total_propiedad. ' <br />
		                   -  ' .$codigo_interno. '
		                  </p>


		                  <p><a href="' .$vinculo_propiedad. '" style="font-family:Arial, sans-serif; font-size: 12px; font-weight:bold; text-decoration:none; margin-top: 15px; color:#294c6a">VER DETALLES DE LA PROPIEDAD</a></p>

		                </td>
		              </tr>
		            </table>
		            <!-- FIN DESARROLLO -->
		          
		          </td>

		        </tr>
		      </table>



		      <!-- FOOTER -->
		      <table cellpadding="0" cellspacing="0" width="650" bgcolor="#DDDDDD">
		        <tr>
		          <td style="padding:10px 0 10px 25px" width="650" align="left">   
		            <p><a href="http://www.martincesarsky.com.ar/" style="font-family: Arial, sans-serif; font-size: 11px; color:#666; text-decoration: none;">MARTIN CESARSKY PROPIEDADES</a></p>
		          </td>
		        </tr>
		      </table>
		      <!-- FOOTER -->


		    </td>
		  </tr>
		</table><!-- /BODY -->

		         
		    
		</body>
		</html>

		';

		               
		$destinatario = $mail_destinatario; // 'damiangallo@gmail.com';
		$asunto = $titulo_propiedad; //'Te recomiendo esta nota';

		mail($destinatario, $asunto, utf8_decode($mensaje), utf8_decode($header));

		echo 'Hemos recibido su comentario, en breve nos comunicaremos con usted.';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */