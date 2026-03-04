<?php require('db.php');
//Signor Appane
//adminAppane


function redirect($url)
{
    header('Location: ' . $url);
    die();
}

$nome = trim($_POST['nome']);
$psw = ($_POST['password']);
$hashed_password = password_hash($psw, PASSWORD_DEFAULT);
$email = trim($_POST['email']);
$telefono = null;
$telefono = trim($_POST['telefono']);

//controllo se esiste già
$sql = "SELECT email FROM tutente WHERE nome = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    echo "<script>alert('nome già esistente')</script>";
} else {
    $sqlInsert = "INSERT INTO `tutente`(`nome`, `password`, `email`, `numeroTelefonico`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sqlInsert);
    $stmt->bind_param("ssss", $nome, $hashed_password, $email, $telefono);
    $stmt->execute();

    $sqlId = "SELECT idutente FROM tutente WHERE email = ?";
    $stmt = $conn->prepare($sqlId);
    $stmt->bind_param("s", $email,);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) 
    echo "<script>alert('nome già esistente')</script>";
    else {
        $SESSION['user_id'] = $result->fetch_assoc()['id'];
        $SESSION['nome'] = $nome;
    }

}
redirect("index.php");
