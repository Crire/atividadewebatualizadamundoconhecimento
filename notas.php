<?php
$titulo = $_POST['titulo-nota'];
$categoria = $_POST['categoria-nota'];
$conteudo = $_POST['conteudo'];
$add = $_POST['add'];
// Create connection
$conn = new mysqli('localhost', 'root', "Eric019283746551413121.", 'atividadeweb');
if ($conn->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
$query = "SELECT * FROM Posts";
$getInfo = $conn->query($query);
// Check connection


if (isset($add)) {
    $Tabela = "INSERT into Posts values(
        PosAutor = ?,
        PosArea = ?,
        PosTexto = ?
    );";
    $stmt = $conn->prepare($Tabela);
    $stmt->bind_param("sss", $titulo, $categoria, $conteudo);
    $stmt->execute();
    echo "<script>alert('Houve um erro na tentativa de Post'); window.location.href='home.html';</script>";

}


while ($row = $resultado->fetch_assoc()) {
    echo "<div class='div-notas'>" .
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
        "</div>" .
    "</div>";
}

?>