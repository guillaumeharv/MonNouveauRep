<?php 
    $codePostal = "";
    $codePostalValide = true;
    $msgErreurCP = "";

    $numTel = "";
    $numTelValide = true; 
    $msgErreurTel = "";

    $message = "";

    if(isset($_GET["btnSubmit"]))
    {
        $codePostal = $_GET["cp"];
        $numTel = $_GET["numTel"];
        //valider le code postal 
        //un code postal valide, dans ce cas-ci, sera du format X1X 1X1 avec un espace facultatif entre les deux trios
        $monExpCP = '/^[A-Z]\d[A-Z] ?\d[A-Z]\d$/i'; 
        $test = preg_match($monExpCP, $codePostal);

        //si $test = 0, ça veut dire que que la variable ne correspond pas au pattern défini par l'expression régulière
        if($test === 0)
        {
            $msgErreurCP = "Code postal invalide. Le format devrait être de type X1X 1X1.";
            $codePostalValide = false;
            $codePostal = "";
        }

         //valider le numéro de téléphone, format 514-333-3333 ou 333-3333
        $monExpCP = '/^(\d{3}-)?\d{3}-\d{4}$/i'; 
        $test = preg_match($monExpCP, $numTel);

        //si $test = 0, ça veut dire que que la variable ne correspond pas au pattern défini par l'expression régulière
        if($test === 0)
        {
            $msgErreurTel = "Numéro de téléphone invalide. Formats acceptés : 555-555-5555 ou 555-5555";
            $numTelValide = false;
            $numTel = "";
        }

        //valider le numéro de téléphone

        //si tout est valide, afficher tout est beau merci
        if($codePostalValide && $numTelValide)
        {
            //$message = "Tout est beau, merci!";
            //on redirige vers une autre page et on arrête ce script-ci
            header("Location: PageFelicitations.html");
            die();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        Entrez votre code postal : 
        <input type="text" name="cp" value="<?= $codePostal ?>"/><span><?= $msgErreurCP ?></span><br>
        Entrez votre numéro de téléphone : <input type="text" name="numTel" value="<?= $numTel ?>"><span><?= $msgErreurTel ?></span><br>
        <input type="submit" name="btnSubmit" value="Valider"/>
    </form>
    <p><?= $message ?></p>
</body>
</html>