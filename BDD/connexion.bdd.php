<?php
        // Connexion à la base de donnée


    final class BDD{
    
    protected $DB = null;
    
        public function connect(){
           
          //Ne peut avoir qu'une seul instance (Singleton)
            
            
            /*
             *$nomlogin = "bd_qualif_qsf";                    // Ici, nous connectons avec le serveur local, si vous voulez le tester sur d'autre serveur, vous pouvez changer ces 3 variables
                $nompasswd = "......";
                $nombase = "bd_qualif_qsf";
                $serveur = "bm124975-001.privatesql";
                $port_bdd = "35171"; 
             */
                try
               {  
                    if(is_null($this->DB)){
                       $this->DB = new PDO("mysql:host=bm124975-001.privatesql;port=35171;dbname=bd_qualif_qsf;charset=utf8","bd_qualif_qsf","....");
                        //$this->DB = new PDO("mysql:host=localhost;dbname=qsf;charset=utf8","root","");
                    }
                    return $this->DB;
                } catch (Exception $ex) {
                    die('Erreur : '.$ex->getMessage());
                }
                
                return null;
                
        }
        
        public function query(){
            
            return $this->DB->query();
        }
        
    }    
?>


        
        
        
        

        
        
