<?php defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Migration_Create_Propiedades extends CI_Migration
{
    public function up()
    {
        //TABLA 
        $this->dbforge->add_field(
            array(
                "id"        =>        array(
                    "type"                =>        "INT",
                    "constraint"        =>        11,
                    "unsigned"            =>        TRUE,
                    "auto_increment"    =>        TRUE,
 
                ),
					"titulo"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"subtitulo"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"codigo"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"categoria_id"    		=>        array(
                    "type"                =>        "INTEGER",
                    "constraint"        	=>        11,
                ),
	
					"localidad"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"barrio"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"direccion"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"mapa"    		=>        array(
                    "type"                =>        "TEXT",
                ),
	
					"tipo_transaccion"    		=>        array(
                    "type"                =>        "INTEGER",
                    "constraint"        	=>        11,
                ),
	
					"moneda"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"precio"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"sup_cubierta"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"sup_semi_cubierta"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"sup_t_total"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"palier_privado"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"hall_de_entrada"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"living"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"comedor"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"toilette"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"cant_banos"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"cocina"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"comedor_diario"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"lavadero"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"hab_servicio"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"balcon"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"segundo_balcon"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"quincho"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"cochera"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"garage"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"baulera"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"parrilla"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"cant_dormitorios"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"descrip_dormitorios"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"expensas"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"abl"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"tipo_piso"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"calefaccion"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"aire_acondicionado"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"agua_caliente"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"entrada_servicio"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"doble_circulacion"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"piscina"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"orientacion"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"condicion"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"apto_profesional"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"sum"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"antiguedad"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"estado"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"ascensor"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"otros_servicios"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"observaciones"    		=>        array(
                    "type"                =>        "TEXT",
                ),
	
            )
        );
 
        $this->dbforge->add_key('id', TRUE); //ID como primary_key
        $this->dbforge->create_table('propiedades');//crea la tabla
    }
 
    public function down()
    {
        //ELIMINAR TABLA
        $this->dbforge->drop_table('propiedades');
 
    }
}
?>