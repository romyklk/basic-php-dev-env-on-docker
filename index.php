<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

    body {
        color: black;
    }
</style>

<body>
    <?php

    echo "Hello World!";
    echo "Hello World!";
    /* 
    $host = 'db'; // Utilisez le nom du service MySQL dans Docker Compose
    $port = 3306; // Port exposé dans Docker Compose
    $dbname = 'portfolio'; // Le nom de la base de données que vous avez créé
    $username = 'myacces'; // Utilisateur créé dans le conteneur Docker
    $password = 'mysecret'; // Mot de passe créé dans le conteneur Docker */
    echo "<h1>Test de connexion à la base de données</h1>";

    require_once __DIR__ . '/vendor/autoload.php'; // Chargez l'autoloader Composer
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__); // Créez une instance de Dotenv
    $dotenv->load(); // Chargez les variables d'environnement depuis le fichier .env

    // Exemple d'utilisation des variables d'environnement
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $dbname = $_ENV['DB_DATABASE'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];

// Vous pouvez maintenant utiliser ces variables pour la configuration de la base de données, par exemple.


    
    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        // Le reste de votre code PDO
        echo "<br> Connecté à la base de données $dbname sur $host avec succès.<br>";

        var_dump($pdo);
    } catch (PDOException $e) {
       die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
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