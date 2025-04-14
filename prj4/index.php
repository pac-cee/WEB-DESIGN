<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/models/PensionCalculator.php';
require_once __DIR__ . '/controllers/PensionController.php';

$controller = new PensionController();
$result = $controller->handleRequest();

// Initialize variables with default or submitted values
$employName = $_POST['employ_name'] ?? '';
$employeeAddress = $_POST['employee_address'] ?? '';
$monthlySalary = floatval($_POST['monthly_salary'] ?? 0);
$employeePeriod = intval($_POST['employee_period'] ?? 0);
$benefitPercentage = floatval($_POST['benefit_percentage'] ?? 0);
$totalAmount = $result['data']['totalAmount'] ?? 0;
$amountPerMonth = $result['data']['amountPerMonth'] ?? 0;
$message = $result['message'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pension Management System</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="head">
        <header class="header">
            <div>
                <img src="icdl-logo.svg" class="logo img" alt="ICDL Logo">
            </div>
            <div class="left">
                <div id="mobile-language-select" class="drop">
                    <select class="dropdwon">
                        <option>English</option>
                    </select>
                </div>
                <div class="nav-img">
                    <img src="search-circle-white.svg" class="nav-img1 img" alt="Search">
                    <img src="connect-circle-white.svg" class="nav-img2 img" alt="Connect">
                </div>
            </div>
        </header>
       
    </div>
    <div class="nav">
            <nav>
                <a href="">ABOUT US</a>
                <a href="">PROGRAMMES</a>
                <a href="">INDIVIDUALS</a>
                <a href="">SCHOOLS</a>
                <a href="">UNIVERSTIES</a>
                <a href="">TRAINING PROVIDERS</a>
                <a href="">EMPLOYERS</a>
                <a href="">PARTNERSHIPS</a>
                <a href="">TEST CENTERS</a>
            </nav>
        </div>
    <main>
        <div>
            <img src="icdl.jpg" id="main-img" alt="ICDL Main" >
        </div>
        <div class="middle">
            <div class="form">
                <h3>EMPLOYER PENSION MANAGEMENT SYSTEM</h3>
                
                <?php if(!empty($message)): ?>
                    <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="">
                    <pre>           
      EMPLOY NAME: <input type="text" name="employ_name" value="<?php echo htmlspecialchars($employName); ?>" required>
 EMPLOYEE-ADDRESS: <input type="text" name="employee_address" value="<?php echo htmlspecialchars($employeeAddress); ?>" required>
   MONTHLY SALARY: <input type="number" name="monthly_salary" value="<?php echo $monthlySalary; ?>" required min="0">
  EMPLOYEE-PERIOD: <input type="number" name="employee_period" value="<?php echo $employeePeriod; ?>" required min="1">
     benefit in %: <input type="number" step="0.01" name="benefit_percentage" value="<?php echo $benefitPercentage; ?>" required min="0" max="100">
                    </pre>
                    <div class="CALCULATE">
                        <button type="submit" name="calculate">CLICK TO CALCULATE</button>
                        <label for="TOTAL">TOTAL AMOUNT:</label>
                        <textarea name="TOTAL" id="TOTAL" readonly><?php echo number_format($totalAmount, 2); ?></textarea>
                        <label for="PER-MONTH">AMOUNT PER-MONTH:</label>
                        <textarea name="PER-MONTH" id="PER-MONTH" readonly><?php echo number_format($amountPerMonth, 2); ?></textarea>
                    </div>
                    <div id="BUTTON">
                        <button type="submit" name="submit">Submit</button>
                        <button type="submit" name="retrieve">Retrieve</button>
                        <button type="submit" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <img src="group.jpg" id="main-img" alt="Group Image">
        </div>
    </main>
    <footer>
        <h2 style="text-align: center; padding: 3px;">ICDL PROGRAMMERS</h2>
        <div class="footer-div">
            <div class="div1">
                <h2>ICDL</h2>
                <h4>DIGITAL CITIZENS</h4>
                <p>Digital skills to access and build computer confidence</p>
            </div>
            <div class="div2">
                <h2>ICDL</h2>
                <h4>DIGITAL CITIZENS</h4>
                <p>Digital skills to access and build computer confidence</p>
            </div>
            <div class="div3">
                <h2>ICDL</h2>
                <h4>DIGITAL CITIZENS</h4>
                <p>Digital skills to access and build computer confidence</p>
            </div>
            <div class="div4">
                <h2>ICDL</h2>
                <h4>DIGITAL CITIZENS</h4>
                <p>Digital skills to access and build computer confidence</p>
            </div>
            <div class="div5">
                <h2>ICDL</h2>
                <h4>DIGITAL CITIZENS</h4>
                <p>Digital skills to access and build computer confidence</p>
            </div>
        </div>
    </footer>
</body>
</html>