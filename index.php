<?php
include 'User.php';
include 'FormHandler.php';

$item = new User($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['name'] ?? '';
    $itemEmail = $_POST['email'] ?? '';
    if (!empty($itemName) && !empty($itemEmail)) {
        $input = new FormHandler($itemName);
        $inputEmail = new FormHandler($itemEmail);
        $item -> addItem($input->getInputValue(), $inputEmail->getInputValue());
    }
}

$items = $item->getAllItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRUD App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Add Items</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" value="Add">
    </form>

    <h2>Item List</h2>
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?php echo htmlspecialchars($item['name']); ?></li>
            <li><?php echo htmlspecialchars($item['email']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>