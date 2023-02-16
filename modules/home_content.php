<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>This is the home page.</p>

    <form action="controllers/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>

