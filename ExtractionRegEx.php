<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Le formulaire d'extraction<h1>
    <form method="GET">
        Entrez un texte duquel vous voudriez extraire des codes postaux : 
        <textarea name="leTexte"><?php if(isset($_GET["leTexte"])) echo $_GET["leTexte"]; ?></textarea><br>
        <input type="submit" name="btnSubmit" value="Extraire"/>
    </form>
    <?php
    //est-ce que j'arrive du formulaire 
    if(isset($_GET["btnSubmit"]))
    {
        $texte = $_GET["leTexte"];

        $monExpCP = '/([A-Z]\d[A-Z]) ?(\d[A-Z]\d)/i'; 
        $lesResultats = array();

        $nombreResultats = preg_match_all($monExpCP, $texte, $lesResultats);

        echo "Il y a $nombreResultats code postaux dans le texte";

        //les matchs complets (pas les sous-groupes) se retrouvent dans $lesResultats[0]
        echo "<ul>";
        foreach($lesResultats[0] as $matchComplet)
        {
            echo "<li>$matchComplet</li>";
        }
        echo "</ul>";
    }
    
    ?>
</body>
</html>