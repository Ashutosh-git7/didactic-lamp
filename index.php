<?php
session_start();

// Set your admin credentials here
$admin_id = "admin";
$admin_pass = "123456";

// Handle admin login
if (isset($_POST['admin_login'])) {
  if ($_POST['admin_id'] === $admin_id && $_POST['admin_pass'] === $admin_pass) {
    $_SESSION['admin'] = true;
  } else {
    $error = "Invalid credentials";
  }
}

// Handle admin logout
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Ashirwad Mini App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://telegram.org/js/telegram-web-app.js"></script>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
    .box {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { color: #2e7d32; }
    input, button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .info { background: #e0f7fa; padding: 10px; border-radius: 6px; }
    table { width: 100%; margin-top: 20px; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background: #f0f0f0; }
    .error { color: red; }
  </style>
</head>
<body>

<div class="box">
<?php if (!isset($_SESSION['admin'])): ?>
  <h2>🌟 Ashirwad Investment</h2>

  <div class="info">
    ✅ Invest: <b>$10 - $1000</b><br>
    💸 Monthly Return: <b>5% after 30 days</b><br>
    👥 Referral Bonus: <b>10%</b><br>
    💼 Min Withdrawal: <b>$1</b>
  </div>

  <p><b>Deposit to this USDT (BEP20) Address:</b></p>
  <code>0x49F7A836A32C1aCF04d4d20Fa87A14C7a19aB74B</code>

  <p>💳 Enter Deposit Amount ($):</p>
  <input type="number" min="10" max="1000" placeholder="e.g. 100" />

  <p>🔐 Your USDT Wallet (for Withdrawal):</p>
  <input type="text" placeholder="Your BEP20 Wallet Address" />

  <button onclick="submitDeposit()">✅ Submit</button>

  <hr>

  <h3>🔐 Admin Login</h3>
  <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
  <form method="POST">
    <input type="text" name="admin_id" placeholder="Admin ID" required />
    <input type="password" name="admin_pass" placeholder="Password" required />
    <button type="submit" name="admin_login">Login</button>
  </form>
<?php else: ?>
  <h2>🔒 Admin Dashboard</h2>
  <p>Welcome, Admin!</p>

  <table>
    <tr><th>Telegram ID</th><th>Name</th><th>Amount</th><th>Wallet</th></tr>
    <tr><td>12345678</td><td>Demo User</td><td>$100</td><td>0xABCDEF1234</td></tr>
    <!-- Add dynamic rows here when database is added -->
  </table>

  <br>
  <a href="?logout=1"><button>🚪 Logout</button></a>
<?php endif; ?>
</div>

<script>
Telegram.WebApp.ready();

function submitDeposit() {
  alert("Deposit submitted! Admin will verify.");
  Telegram.WebApp.close();
}
</script>
</body>
</html>
