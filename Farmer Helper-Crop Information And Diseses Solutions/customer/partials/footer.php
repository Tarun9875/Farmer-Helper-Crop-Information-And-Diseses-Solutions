<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .footer a {
            color: #ffcc00;
            text-decoration: none;
            margin: 0 10px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="footer">
        <p>&copy; Best Service For Farmer.......</p>
    </div>

    <script>
        // Example JavaScript to show current year in the footer
        document.addEventListener('DOMContentLoaded', function() {
            const yearSpan = document.createElement('span');
            yearSpan.textContent = new Date().getFullYear();
            document.querySelector('.footer p').appendChild(yearSpan);
        });
    </script>

</body>
</html>