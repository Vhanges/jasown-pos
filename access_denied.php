<?php

require_once __DIR__.'/_init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #343a40;
            font-family: 'Arial', sans-serif;
        }
        .error-container {
            text-align: center;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .error-title {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .back-button {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            background: #007bff;
            border: none;
            color: #fff;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }
        .back-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-title">403 Forbidden</h1>
        <p class="error-message">You don't have permission to access this page.</p>
        <a href="controller/user_controller.php?action=redirect" class="btn back-button">Go Back</a>
    </div>
</body>
</html>
