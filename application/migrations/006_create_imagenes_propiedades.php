<?php defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Migration_Create_Imagenes_Propiedades extends CI_Migration
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
 
                ),"propiedad_id"    		=>        array(
                    "type"                =>        "INT",
                    "constraint"        	=>        11,
                ),
                "filename"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
            )
        );
 
        $this->dbforge->add_key('id', TRUE); //ID como primary_key
        $this->dbforge->create_table('imagenes_propiedades');//crea la tabla
    }
 
    public function down()
    {
        //ELIMINAR TABLA
        $this->dbforge->drop_table('imagenes_propiedades');
 
    }
}
?>