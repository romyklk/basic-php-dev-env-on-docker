<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

    body {
        background-color: #F7A01C;
        color: #fff;
    }
</style>

<body>
    <?php

    echo "Hello World!";
    echo "Hello World!";

    $host = 'db'; // Utilisez le nom du service MySQL dans Docker Compose
    $port = 3306; // Port exposé dans Docker Compose
    $dbname = 'portfolio'; // Le nom de la base de données que vous avez créé
    $username = 'romy'; // Utilisateur créé dans le conteneur Docker
    $password = 'romy123'; // Mot de passe créé dans le conteneur Docker

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        // Le reste de votre code PDO
        echo "<br> Connecté à la base de données $dbname sur $host avec succès.<br>";

        var_dump($pdo);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }

    $query = "SELECT * FROM `contacts`";

    $db = $pdo->prepare($query);
    $db->execute();

    $result = $db->fetchAll();

    foreach ($result as $contact) {
        echo "<p>";
        echo $contact['first_name'] . ' ' . $contact['last_name'] . ' ' . $contact['email'] . ' ' . $contact['phone_number'] . ' ' . $contact['created_at'] . '<hr>';
        echo "</p>";
    }

    $insert = "INSERT INTO `contacts`(`first_name`, `last_name`, `email`, `phone_number`) VALUES ('Lucas','Doe','lucas@mail.com','0123456789')";
    $db = $pdo->prepare($insert);
    $db->execute();


    ?>

    <figure>
        <img src="public/images/red.jpg" alt="" style="width: 400px;height: 300px;">
    </figure>
</body>

</html>