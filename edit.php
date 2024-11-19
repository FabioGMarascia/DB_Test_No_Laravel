<?php
include 'db.php';

// Inizializza variabili per i valori di input
$name = '';
$email = '';
$id = '';

// Controlla se l'ID è passato nell'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera i dati dell'utente dal database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controlla se l'utente esiste
    if ($user) {
        $name = $user['name'];
        $email = $user['email'];
    } else {
        echo "Utente non trovato.";
        exit;
    }
}

// Aggiorna i dati dell'utente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    // Se la password è fornita, aggiorna anche la password
    if ($password) {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$name, $email, $password, $id]);
    } else {
        // Se la password non è fornita, non la modificare
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $id]);
    }

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

    <h1 class="text-center mb-4 fw-bold">Edit User</h1>

    <div class="row mx-0 justify-content-center">
        <div class="col-5 px-0 border border-1 border-dark py-3">
            <form action="index.php" method="POST">
                <div class="row mx-0 justify-content-center">

                    <div class="col-5 text-center py-2">
                        <label for="name" class="fw-bold my-2">Name</label>
                        <div>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"
                                class="text-center" required>
                        </div>
                    </div>
                    <div class="col-5 text-center">
                        <label for="email" class="fw-bold my-2">Email</label>
                        <div>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
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
                        <!-- <a href="index.php" class="text-decoration-none text-dark"> -->
                        <button type="submit" class="col-2 btn border border-2 border-dark fw-bold mt-4">
                            UPDATE USER
                        </button>
                        <!-- </a> -->
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

    button:hover a {
        color: white !important;
    }
</style>