<?php
include 'db.php';

// Inizializza variabili per i valori di input
$name = '';
$email = '';

// Creazione di un nuovo utente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Puoi aggiungere qui la logica per gestire gli errori (es. verifica se l'email esiste già)

    // Se non ci sono errori, inserisci l'utente nel database
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>USER LIST</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <h1 class="text-center mb-4 fw-bold">Create New User</h1>

    <div class="row mx-0 justify-content-center">
        <div class="col-5 px-0 border border-1 border-dark py-3">
            <form action="{{ route('users.store') }}" method="POST">
                <div class="row mx-0 justify-content-center">

                    <div class="col-5 text-center py-2">
                        <label for="name" class="fw-bold my-2">Name</label>
                        <div>
                            <input type="text" id="name" name="name"
                                class="text-center" required>
                        </div>
                    </div>
                    <div class="col-5 text-center">
                        <label for="email" class="fw-bold my-2">Email</label>
                        <div>
                            <input type="email" id="email" name="email"
                                class="text-center" required>
                        </div>
                    </div>
                    <div class="col-5 text-center">
                        <label for="password" class="fw-bold my-2">Password</label>
                        <div>
                            <input type="password" id="password" name="password" class="text-center">
                        </div>
                    </div>
                    <div class="col-5 text-center">
                        <label for="password_confirmation" class="fw-bold my-2">Confirm Password</label>
                        <div>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="text-center">
                        </div>
                    </div>
                    <div class="text-center my-3">
                        <button type="submit" class="col-2 btn border border-2 border-dark fw-bold mt-4">ADD USER</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

<style>
    .my_w {
        width: 6rem;
    }

    button:hover {
        background-color: #212529 !important;
        color: white !important;
    }
</style>