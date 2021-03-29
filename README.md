# QSF
Site QSF en production sur le site https://qsf.cpam31.fr 

compte ftp: 
	ftp.cluster005.hosting.ovh.net
	(ftp://cpambyqt-ftp_qsf@ftp.cluster005.hosting.ovh.net:21/)
	user: cpambyqt-ftp_qsf


Compte Phpmyadmin:
	https://phpmyadmin-gra2.hosting.ovh.net
	serveur: bm124975-001.privatesql
	port: 35171
	user: qsf_mysql


_________________________________________________________________________________________________________________________________________________________________________________________

Site QSF en qualification sur le site https://qualif-qsf.cpam31.fr

compte ftp: 
	ftp.cluster005.hosting.ovh.net
	User ftp : cpambyqt-qualifqsf

#pas utilisé pour le moment
#Compte smtp: 
#	https://www.ovh.com/fr/mail/
#	serveur:ssl0.ovh.net
#	port:587
#	Compte:qsf@cpam31.fr


#Serveur Actuel
Compte smtp: 
	serveur:smtp.cpam-toulouse.cnamts.fr
	port:25
	


Compte Phpmyadmin:
	https://phpmyadmin-gra2.hosting.ovh.net
	serveur: bm124975-001.privatesql
	port: 35171
	Base de données : bd_qualif_qsf
	User bdd : bd_qualif_qsf



        // 1. Connexion à la base de donnée

        $nomlogin = "bd_qualif_qsf";                    // Ici, nous connectons avec le serveur local, si vous voulez le tester sur d'autre serveur, vous pouvez changer ces 3 variables
        $nompasswd = "*******";
        $nombase = "bd_qualif_qsf";
        $serveur = "bm124975-001.privatesql";
        $port_bdd = "35171";

        $session = mysqli_connect( $serveur, $nomlogin, $nompasswd, $nombase, $port_bdd); 

        if ($session == NULL) // Test de connexion n'est pas réussié
          {
                  echo ("<p>Echec de connection</p>");
          } 
        else 
         {
                // Sélection de la base de donnée
                 if (mysqli_select_db($session, $nombase) == TRUE) { 
                            //echo ("Connection Réussite</br>");
            }
                else 
             {
                            echo ("Cette base n'existe pas</br>");
                    }  
         }

Pour importer la base de données "QSF":
    - Importer la base de données depuis le fichier 'sql' qui se trouve (BDD/bd_script.sql).
    - Il contient la structuration de la BDD et les données de "categories" et de "slides".

Le caroussel peut etre modifié de deux façon:
    - Etre en mode 'admin' et modifier dans la partie 'Bandeau'.
    - Update directement depuis la base de données.

Pour créer un compte administrateur:
    - Créer un compte basique.
    - Mettre le role du compte à 'admin' directement depuis la base de données.
    - Mofier le role d'un utilisateur en 'admin' fait de l'utilisateur un nouvel administrateur.


