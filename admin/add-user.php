<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mode</title>
    <link rel="stylesheet" href="css/login1.css">
    <style>
        /* Logout Popup CSS */
        .alert-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .alert-box {
            background: white;
            width: 500px;
            height: 200px;
            padding: 20px 30px;
            border-radius: 8px;
            /* text-align: center; */
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            /* align-items: center; */
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .alert-box p {
            font-size: 1.1rem;
        }

        .alert-actions button {
            margin: 10px;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #message-alert {
            /* display: flex; */
            display: none;
        }

        #message-alert .alert-actions button#ok-btn {
            color: #fff;
            background-color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="">
        </div>
        <div class="login-box">
            <div class="form-container">
                <h3 class="head">Create Another User</h3>
                <form action="">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" placeholder="Enter Password">
                    </div>
                    <button type="button" id="create-btn" class="login-btn create-btn">Create</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Message Alert -->
    <div id="message-alert" class="alert-overlay">
        <div class="alert-box">
            <p>User Added Successfully!</p>
            <div class="alert-actions">
                <button id="ok-btn">Ok</button>
            </div>
        </div>
    </div>

    <footer></footer>

    <!-- Scripts -->

    <!-- Save Script -->
    <script>
        const saveButton = document.getElementById('create-btn');
        const msgAlert = document.getElementById('message-alert');
        const okBtn = document.getElementById('ok-btn');

        // show message box
        saveButton.onclick = () => {
            msgAlert.style.display = 'flex';
        }

        // close on ok button
        okBtn.onclick = () => {
            msgAlert.style.display = 'none';
            window.location.href = 'manage-user.php';
        }

    </script>

</body>

</html>