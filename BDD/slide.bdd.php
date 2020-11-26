<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../../CLASS/SlideClass.php');

/**
 * Description of slide
 *
 * @author MARTINEZFOUCHE-07265
 */
class slideBDD {

    private $_bdd;

    public function __construct($bdd) {
        $this->setDb($bdd);
    }

    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }

    public function updateSlide(slide $slide) {
        $req = $this->_bdd->prepare('UPDATE slides
                                        SET TitreS = :TitreS,
                                                 PhotoS = :PhotoS,
                                                 TextS1 = :TextS1,
                                                 TextS2 = :TextS2,
                                                 TextS3 = :TextS3
                                    WHERE NumSlide = :NumSlide
                                    ');

        $req->bindValue(':TitreS', $slide->getTitreS(), PDO::PARAM_STR);
        $req->bindValue(':PhotoS', $slide->getPhotoS(), PDO::PARAM_STR);
        $req->bindValue(':TextS1', $slide->getTextS1(), PDO::PARAM_STR);
        $req->bindValue(':TextS2', $slide->getTextS2(), PDO::PARAM_STR);
        $req->bindValue(':TextS3', $slide->getTextS3(), PDO::PARAM_STR);
        $req->bindValue(':NumSlide', $slide->getNumSlide(), PDO::PARAM_INT);

        $req->execute();

        $req->closeCursor();
    }

    public function un_slide($T) {  //fonction pour afficher les information d'un carte besoin
        $vide = '';
        $T = (int) $T;

        $req = $this->_bdd->query("select * from slides where NumSlide = '$T' ");
        //$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
        //$datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $slide = new slide([]);
                $slide->setNumSlide($datas['NumSlide']);
                $slide->setPhotoS($datas['PhotoS']);
                $slide->setTitreS($datas['TitreS']);
                $slide->setTextS1($datas['TextS1']);
                $slide->setTextS2($datas['TextS2']);
                $slide->setTextS3($datas['TextS3']);

               
            }
        } else {
            return $vide;
        }

        return $slide;

        $req->closeCursor();
    }

}
