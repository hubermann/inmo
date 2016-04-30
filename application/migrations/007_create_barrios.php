<?php defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Migration_Create_Barrios extends CI_Migration
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
					"nombre"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
					"slug"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        255,
                ),
	
            )
        );
 
        $this->dbforge->add_key('id', TRUE); //ID como primary_key
        $this->dbforge->create_table('barrios');//crea la tabla
    }
 
    public function down()
    {
        //ELIMINAR TABLA
        $this->dbforge->drop_table('barrios');
 
    }
}
?>