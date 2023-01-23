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
    <form method="POST">
        Entrez l'ISBN d'un livre pour obtenir son prix sur Amazon : 
        <textarea name="leTexte"><?php if(isset($_POST["leTexte"])) echo $_POST["leTexte"]; ?></textarea><br>
        <input type="submit" name="btnSubmit" value="Extraire"/>
    </form>
    <?php
    //est-ce que j'arrive du formulaire 
    if(isset($_POST["btnSubmit"]))
    {
        $url = "http://amazon.ca/dp/" . $_POST["leTexte"];

        $texte = file_get_contents($url);
        if($texte === false)
            echo "L'ISBN entré est invalide sur Amazon.";
        else 
        {
            $monExpCP = '/<span id="tp_price_block_total_price_ww" class="a-price" data-a-size="m" data-a-color="price"><span class="a-offscreen">\$(\d+\.\d\d)</'; 
            $lesResultats = array();

            $nombreResultats = preg_match_all($monExpCP, $texte, $lesResultats);
            echo "Le prix du livre est " . $lesResultats[1][0];
        }
    }
    
    ?>
</body>
</html>