<?php
session_start();
// Create connection
$conn = new mysqli('localhost', 'root', "Eric019283746551413121.", 'atividadeweb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM Posts";
$resultado = $conn->query($query);

while ($row = mysqli_fetch_assoc($resultado)) {
    echo
        "<div class='div-cabecalho'>" .
            "<div class='teste'>" .
                "<img src='./assests/img/icons8-bmo-48.png'>" .
                "<p id='nome'>" . $row["PosAutor"] ."</p>" .
            "</div>" .
            "<button id='categoria'>". $row["PosArea"] . "</button>" .
            "<a href='#' id='like'><i class='fa-regular fa-heart'></i></a>" .
        "</div>" .
        "<div class='div-texto'>" .
            "<p>" . $row["PosTexto"] . "</p>" .
        "</div>";
    
}


if (isset($_POST['add'])) {
    $titulo = $_POST['titulo-nota'];
    $categoria = $_POST['categoria-nota'];
    $conteudo = $_POST['conteudo'];
    //$add = ;
    if($categoria != "" && $conteudo != ""){
        $query = "insert into Posts(PosAutor, PosArea, PosTexto) values(?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss",$_SESSION["email"], $categoria, $conteudo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Anotação adicionada com sucesso!'); window.location.href='home.html';</script>";
        } else {
            echo "<script>alert('Não foi possível adicionar a anotação'); window.location.href='home.html';</script>";
        }
    } else {
        echo "<script>alert('Todos os campos devem ser preenchidos'); window.location.href='home.html';</script>";
    }
}

$conn->close();
?>
