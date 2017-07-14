<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>Traitement</title>

    </head>


    <body>

        <?php

            try
            {
                $bdd = new PDO('mysql:host=randomtext.livehost.fr;dbname=randomtext_auph;charset=utf8', 'randomtext_auph', '7aAsebI[a_D=');
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }

        ?>

        <p>

            <?php

                // On va compter le nombre de sujets, verbes et compléments déjà rentrés

                $reponse = $bdd->query('SELECT * FROM Commun') or die(print_r($bdd->errorInfo()));

                $nbSujet = 0;
                $nbVerbe = 0;
                $nbComplement = 0;

                while ($donnees = $reponse->fetch())
                {
                    if ($donnees['sujet'] != '')
                    {
                        $nbSujet++;
                        if (isset($_POST['sujet']) AND ($donnees['sujet'] == $_POST['sujet'])) // On fait en sorte qu'il n'y ait pas de doublons
                        {
                            ?> <SCRIPT LANGUAGE="JavaScript">
                            document.location.href="index.php"
                            </SCRIPT> <?php
                        }
                    }
                    if ($donnees['verbe'] != '')
                    {
                        $nbVerbe++;
                        if (isset($_POST['verbe']) AND ($donnees['verbe'] == $_POST['verbe'])) // On fait en sorte qu'il n'y ait pas de doublons
                        {
                            ?> <SCRIPT LANGUAGE="JavaScript">
                            document.location.href="index.php"
                            </SCRIPT> <?php
                        }
                    }
                    if ($donnees['complement'] != '')
                    {
                        $nbComplement++;
                        if (isset($_POST['complement']) AND ($donnees['complement'] == $_POST['complement'])) // On fait en sorte qu'il n'y ait pas de doublons
                        {
                            ?> <SCRIPT LANGUAGE="JavaScript">
                            document.location.href="index.php"
                            </SCRIPT> <?php
                        }
                    }
                }

                $reponse->closeCursor();

                if (isset($_POST['sujet']))
                {

                    if (($nbSujet >= $nbVerbe) AND ($nbSujet >= $nbComplement)) // Si jamais il y a plus de sujets, on crée une nouvelle ligne
                    {
                        $req = $bdd->prepare('INSERT INTO Commun (id, sujet, verbe, complement) VALUES (NULL, ?, ?, ?)');
                        $req->execute(array($_POST['sujet'], '', ''));

                        $req->closeCursor();
                    }
                    else
                    {
                        $nbSujet++; // On va donc update la premiere ligne ou il n'y a pas de sujet

                        $req = $bdd->prepare('UPDATE Commun SET sujet = ? WHERE id = ?');
                        $req->execute(array($_POST['sujet'], $nbSujet));

                        $req->closeCursor();
                    }

                }
                elseif (isset($_POST['verbe']))
                {
                    if (($nbVerbe >= $nbSujet) AND ($nbVerbe >= $nbComplement)) // Si jamais il y a plus de sujets, on crée une nouvelle ligne
                    {
                        $req = $bdd->prepare('INSERT INTO Commun (id, sujet, verbe, complement) VALUES (NULL, ?, ?, ?)');
                        $req->execute(array('', strtolower($_POST['verbe']), '')); // On met en minuscules

                        $req->closeCursor();
                    }
                    else // Sinon on update une ancienne ligne
                    {
                        $nbVerbe++; // On va donc update la premiere ligne ou il n'y a pas de sujet

                        $req = $bdd->prepare('UPDATE Commun SET verbe = ? WHERE id = ?');
                        $req->execute(array(strtolower($_POST['verbe']), $nbVerbe)); // On met en minuscules

                        $req->closeCursor();
                    }
                }
                elseif (isset($_POST['complement']))
                {
                    if (($nbComplement >= $nbVerbe) AND ($nbComplement >= $nbSujet)) // Si jamais il y a plus de sujets, on crée une nouvelle ligne
                    {
                        $req = $bdd->prepare('INSERT INTO Commun (id, sujet, verbe, complement) VALUES (NULL, ?, ?, ?)');
                        $req->execute(array('', '', $_POST['complement']));

                        $req->closeCursor();
                    }
                    else // Sinon on update une ancienne ligne
                    {
                        $nbComplement++; // On va donc update la premiere ligne ou il n'y a pas de sujet

                        $req = $bdd->prepare('UPDATE Commun SET complement = ? WHERE id = ?');
                        $req->execute(array($_POST['complement'], $nbComplement));

                        $req->closeCursor();
                    }
                }

            ?>
        </p>

        <SCRIPT LANGUAGE="JavaScript">
        document.location.href="index.php"
        </SCRIPT>

    </body>

</html>