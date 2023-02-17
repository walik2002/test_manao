<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="styles/home.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <h1>Hello, <?php echo $username; ?>!</h1>
    <p>This is the home page.</p>

    <form action="controllers/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>

    <footer>
        <p>Copyright &copy; <?php echo date('Y'); ?> TestTaskManao</p>
    </footer>
</body>
</html>