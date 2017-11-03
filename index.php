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
    $age= 20;

    echo "J'ai $age ans";
    
    echo "<br />";

    if ($age>18 && $prenom == "Adélaïde") {
        echo "Majeur";
    }elseif ($age >= 15) {
        echo "Ado";
    }else {
        echo "Gamin !";
    }

    $age2=20;
    echo "<br />";
    echo $age <=> $age2;
    echo "<br />";
    echo 1 <=> 2;
    echo "<br />";
    echo 2 <=> 1;
  
  // Déclaration de variable
  
  $a=null;
  $b;
  $c=5;
  $d;
  
  echo $a ?? $b ?? $c ?? $d;

  echo "<br>";

    // Arithmétique

    $a = 5;
    $b = $a + 5;
    echo "B vaut $b et A vaut $a";
    
    echo"<br>";
    $b= $a+=5;
    echo "B vaut $b et A vaut $a";
    echo"<br>";

    $a++;
    echo "A vaut $a <br>";
    ++$a;
    echo "A vaut $a <br>";

    //différence :
    echo "avant A vaut " .++$a;
    echo " aprés A vaut " . $a;
    echo "<br>";
    echo "avant A vaut " .$a++;
    echo " aprés A vaut " . $a;
    echo "<pre>" ;
    print_r($a);
    echo "</pre>";
    echo "<pre>";
    var_dump ($a);
    echo "</pre>";
    
    die("GAME OVER");
?>

</body>
</html>