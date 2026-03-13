<?php 

    require('../../includes/db.php');
    require('../../includes/utils.php');

    $name=$_REQUEST["nameIngredient"];

    /*echo $name."<br>";
    echo $price."<br>";
    print_r($ingredients);*/
    

    $stmtProd = $conn->prepare("SELECT nome FROM tingrediente WHERE nome LIKE ?");
    $stmtProd->bind_param("s", $name);
    $stmtProd->execute();

    $resultProd = $stmtProd->get_result();
    if ($resultProd->num_rows > 0) {
        /*echo $resultProd->num_rows."<br>";
        echo $resultProd->fetch_assoc()["nome"];*/
        echo "<script>alert('Prodotto con questo nome già esiste')</script>"; 
    }else{
        $stmt= $conn->prepare("INSERT INTO `tingrediente`(`nome`) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }
    
    redirect("managementIngredients.php");

    

?>
