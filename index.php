<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(45deg, #3498db, #e74c3c, #2ecc71, #f39c12);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            color: #fff;
            text-align: center;
            margin: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #45a049;
        }

        .rendered-content {
            margin-top: 30px;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .animated {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }
    </style>
    <title>SSRF Lab/Playground</title>
</head>
<body>
    <div class="container">
        <form action="index.php" method="post" class="animated">
            <label for="url">Enter URL:</label>
            <input type="text" id="url" name="url" placeholder="https://example.com" required>
            <button type="submit">Fetch and Render the URL</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $url = $_POST['url'];

            // Validate the URL
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                // Fetch and display the raw contents of the URL
                $contents = file_get_contents($url);

                if ($contents !== false) {
                    echo '<div class="rendered-content">' . $contents . '</div>';
                } else {
                    echo '<div class="rendered-content">Error fetching URL contents</div>';
                }
            } else {
                echo '<div class="rendered-content">Invalid URL</div>';
            }
        }
        ?>
    </div>
</body>
</html>
