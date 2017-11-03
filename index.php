<!DOCTYPE HTML>
<html>
<head>
  <title>Exemple</title>
</head>
<body>

  <?php
    $nom= "Bertrand";
    $prenom= "Adélaïde";
    

    echo "Bonjour,".$prenom ." ".$nom;
    
    echo "<br />";
    $age= "20";

    echo "J'ai $age ans";
    
    echo "<br />";

    if ($age>18 && $prenom == "Adélaïde") {
        echo "Majeur";
    }elseif ($age >= 15) {
        echo "Ado";
    }else {
        echo "Gamin !";
    }

  ?>

</body>
</html>