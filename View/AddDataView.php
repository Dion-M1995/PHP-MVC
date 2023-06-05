<!DOCTYPE html>
<html>

<head>
    <title>Test Task</title>
</head>

<body>
    <form action="index.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <textarea name="data" placeholder="Enter your data here" required></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>