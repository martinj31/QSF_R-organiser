<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../../CLASS/ParametresClass.php');
/**
 * Description of parametres
 *
 * @author MARTINEZFOUCHE-07265
 */
class parametresBDD {
    
   private $_bdd;

   
   public function __construct($bdd) {
        $this->setDb($bdd);
    }
   
    
    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }

    
    public function selectParamtre() {
        $vide = '';
        
        $req = $this->_bdd->query("select * from parametres");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            
                  return $datas['Interval'];
            
        } else {
            return $vide;
        }

        $req->closeCursor();
    }
    
    
    public function updateUser( $Interval) {
        $req = $this->_bdd->prepare('UPDATE parametres
                                        SET  Interval = :Interval
                                    ');

        // var_dump($utilisateur);
       
        $req->bindValue(':Interval', $Interval, PDO::PARAM_INT);
        



        $req->execute();

        $req->closeCursor();
    }
   
}
