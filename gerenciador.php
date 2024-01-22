<?php
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adiciona uma nova tarefa à lista
    if (!empty($_POST["task"])) {
        $_SESSION["tasks"][] = $_POST["task"];
    }

    if (isset($_POST["remove"]) && isset($_POST["taskIndex"])) {
        $index = $_POST["taskIndex"];
        if (isset($_SESSION["tasks"][$index])) {
            unset($_SESSION["tasks"][$index]);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <h1>Gerenciador de Tarefas</h1>
    <fieldset>    
    <form method="post">
        <label for="task">Nova Tarefa:</label>
        <input type="text" name="task" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Lista de Tarefas:</h2>

    <ul>
        <?php
        // Exibe as tarefas existentes
        if (!empty($_SESSION["tasks"])) {
            foreach ($_SESSION["tasks"] as $index => $task) {
                echo "<li>$task <form method='post' style='display:inline;'><input type='hidden' name='remove'><input type='hidden' name='taskIndex' value='$index'><button type='submit'>Remover</button></form></li>";
            }
        } else {
            echo "<li>Nenhuma tarefa adicionada ainda.</li>";
        }
        ?>
    </ul>

    </fieldset>
</body>

</html>
