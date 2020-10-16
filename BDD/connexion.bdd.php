<?php
        // Connexion à la base de donnée

    class BDD{
    
    protected $DB = null;
                
        public function connect(){
           
           /* $aConfig = array(); 
            
            $db_config['HOST']          = 'localhost';
            $db_config['BD']       = 'qsf';        // Exemple - Remplacer par le nom de la base
            $db_config['LOGIN']          = 'root';      // Exemple - Remplacer par le nom d'utilisateur de la DB
            $db_config['PASSWORD']      = ''; 
            */
            
               try
               {  
                    //$bdd = new PDO("mysql:host=localhost;dbname=talentland;charset=utf8","root","");
                    
                    //1ère méthode
                    //$aConfig = parse_ini_file($_SESSION["APPLICATION"].'/config.php');                     
                    $this->DB = new PDO("mysql:host=localhost;dbname=qsf;charset=utf8","root","");
                    
                    /*$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);*/
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


        
        
        
        

        
        