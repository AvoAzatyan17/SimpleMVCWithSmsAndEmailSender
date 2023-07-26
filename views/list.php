<?php
session_start();
function generateCSRFToken()
{
    return bin2hex(random_bytes(32));
}
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCSRFToken();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Message Sender Form with Right-Side List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            flex: 1;
            padding: 20px;
        }
        .list-container {
            flex: 1;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 8px 8px 0;
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea,button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h1>Send Message</h1>
        <form action="index.php?action=addAction" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="text" rows="4" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
    <div class="list-container">
        <ul>
            <?php foreach ($messages as $messag): ?>
                <li>
                    <?php echo $messag['id']; ?> -
                    <?php echo $messag['text']?> <br>
                    <?php echo $messag['phone'];?> <br>
                    <?php echo $messag['email']?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</body>
</html>

