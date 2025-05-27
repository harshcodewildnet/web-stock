<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mode</title>
    <link rel="stylesheet" href="css/login2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="">
        </div>
        <div class="mode-box">
          <a href="admin/login.php" style="text-decoration: none;">
            <!-- <input type="radio" name="login-mode" id="client" value="client" hidden> -->
            <label for="client" class="mode-option">
                <i class="fa-solid fa-check"></i>
            </label>
            <label for="client" class="mode-head">Admin</label>
          </a>
        </div>
        <div class="mode-box">
          <a href="login.php" style="text-decoration: none; ">
            <!-- <input type="radio" name="login-mode" id="client" value="client" hidden> -->
            <label for="client" class="mode-option">
                <i class="fa-solid fa-check"></i>
            </label>
            <label for="client" class="mode-head">Execution</label>
          </a>
        </div>
    </div>
    
    <script>
        const radios = document.querySelectorAll('input[name="login-mode"]');
      
        radios.forEach(radio => {
          radio.addEventListener('change', () => {
            // Remove 'active' from all mode-option labels
            document.querySelectorAll('.mode-option').forEach(option => {
              option.classList.remove('active');
            });
      
            // Add 'active' to the selected one (inside the same .mode-box)
            const modeBox = radio.closest('.mode-box');
            const label = modeBox.querySelector('.mode-option');
            if (label) {
              label.classList.add('active');
            }
          });
        });
      </script>
      
      
</body>

</html>