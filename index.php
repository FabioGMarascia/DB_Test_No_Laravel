<?php
include 'db.php';

// Eliminazione di un utente
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
}

// Ottenere tutti gli utenti
$query = $pdo->query("SELECT * FROM users");
$users = $query->fetchAll(PDO::FETCH_ASSOC);

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

    <h1 class="text-center display-6 fw-bold text-dark mt-4">Users List</h1>
    <div class="row mx-0 justify-content-center">
        <div class="col-8 px-0">
            <div class="row mx-0 my-4 justify-content-around">
                <table class="table table-striped table-bordered border border-3 table-dark">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="text-center"><?php echo $user['id']; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm fw-bold mx-2 my_w2">Edit</a>
                                    <a href="index.php?action=delete&id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm fw-bold mx-2 my_w2">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

<style>
    .my_w {
        width: 6rem;
    }

    .my_w2 {
        width: 4rem;
    }
</style>