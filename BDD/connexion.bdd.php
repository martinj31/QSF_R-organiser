<?php
        // Connexion à la base de donnée
    final class BDD{
    
    protected $DB = null;
    
        public function connect(){
           
          //Ne peut avoir qu'une seul instance (Singleton)
                try
               {  
                    if(is_null($this->DB)){
                        $this->DB = new PDO("mysql:host=localhost;dbname=qsf;charset=utf8","root","");
                    }
                    return $this->DB;
                } catch (Exception $ex) {
                    die('Erreur : '.$ex->getMessage());
                }
                
        }
        
        public function query(){
            
            return $this->DB->query();
        }
        
    }    
?>


        
        
        
        

        
        