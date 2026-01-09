<?php
$result = "";
$loan_details = null;

if(isset($_POST['submit'])){
    $loan_amount = floatval($_POST['loan_amount']);
    $loan_term = intval($_POST['loan_term']);
    
    // Validate inputs
    if ($loan_amount >= 500 && $loan_amount <= 50000 && $loan_term > 0) {
        // Annual interest rate
        $annual_rate = 0.12; // 12% annual interest rate
        
        // Monthly interest rate
        $monthly_rate = $annual_rate / 12;
        
        // Calculate monthly payment using amortization formula
        // M = P * [r(1 + r)^n] / [(1 + r)^n - 1]
        if ($monthly_rate > 0) {
            $monthly_payment = $loan_amount * ($monthly_rate * pow(1 + $monthly_rate, $loan_term)) / (pow(1 + $monthly_rate, $loan_term) - 1);
        } else {
            $monthly_payment = $loan_amount / $loan_term;
        }
        
        // Calculate totals
        $total_amount = $monthly_payment * $loan_term;
        $total_interest = $total_amount - $loan_amount;
        $monthly_interest = $total_interest / $loan_term;
        
        $loan_details = [
            'loan_amount' => $loan_amount,
            'loan_term' => $loan_term,
            'annual_rate' => $annual_rate * 100,
            'monthly_interest' => $monthly_interest,
            'total_interest' => $total_interest,
            'monthly_payment' => $monthly_payment,
            'total_amount' => $total_amount
        ];
        
        $result = "Monthly Payment: ₱" . number_format($monthly_payment, 2);
    } else {
        $result = "Invalid loan amount or term";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Calculator</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="calculator loan-calculator">
  <div class="container">
    <h1>LOAN CALCULATOR</h1>
    
    <?php if($result): ?>
      <div class="result"><?php echo $result; ?></div>
    <?php else: ?>
      <div class="result empty">Enter loan details below</div>
    <?php endif; ?>

    <form method="post">
      <label>Loan Amount (₱):</label>
      <input 
        type="number" 
        name="loan_amount" 
        placeholder="Enter amount (₱500 - ₱50,000)" 
        min="500" 
        max="50000" 
        step="100"
        value="<?php echo isset($_POST['loan_amount']) ? htmlspecialchars($_POST['loan_amount']) : ''; ?>"
        required>
      
      <label>Loan Term:</label>
      <select name="loan_term" required>
        <option value="">Select loan term</option>
        <option value="1" <?php echo (isset($_POST['loan_term']) && $_POST['loan_term'] == '1') ? 'selected' : ''; ?>>1 Month</option>
        <option value="3" <?php echo (isset($_POST['loan_term']) && $_POST['loan_term'] == '3') ? 'selected' : ''; ?>>3 Months</option>
        <option value="6" <?php echo (isset($_POST['loan_term']) && $_POST['loan_term'] == '6') ? 'selected' : ''; ?>>6 Months</option>
        <option value="9" <?php echo (isset($_POST['loan_term']) && $_POST['loan_term'] == '9') ? 'selected' : ''; ?>>9 Months</option>
        <option value="12" <?php echo (isset($_POST['loan_term']) && $_POST['loan_term'] == '12') ? 'selected' : ''; ?>>12 Months</option>
        <option value="24" <?php echo (isset($_POST['loan_term']) && $_POST['loan_term'] == '24') ? 'selected' : ''; ?>>24 Months</option>
      </select>
      
      <button type="submit" name="submit">Calculate Loan</button>
    </form>

    <?php if($loan_details): ?>
    <div class="info">
      <h3>Loan Breakdown:</h3>
      <div class="info-row">
        <span>Loan Amount:</span>
        <span>₱<?php echo number_format($loan_details['loan_amount'], 2); ?></span>
      </div>
      <div class="info-row">
        <span>Loan Term:</span>
        <span><?php echo $loan_details['loan_term']; ?> <?php echo $loan_details['loan_term'] > 1 ? 'Months' : 'Month'; ?></span>
      </div>
      <div class="info-row">
        <span>Interest Rate:</span>
        <span><?php echo $loan_details['annual_rate']; ?>% per year</span>
      </div>
      <div class="info-row">
        <span>Monthly Interest:</span>
        <span>₱<?php echo number_format($loan_details['monthly_interest'], 2); ?></span>
      </div>
      <div class="info-row">
        <span>Total Interest:</span>
        <span>₱<?php echo number_format($loan_details['total_interest'], 2); ?></span>
      </div>
      <div class="info-row">
        <span><strong>Payment per Month:</strong></span>
        <span><strong>₱<?php echo number_format($loan_details['monthly_payment'], 2); ?></strong></span>
      </div>
      <div class="info-row">
        <span><strong>Total Amount to Pay:</strong></span>
        <span><strong>₱<?php echo number_format($loan_details['total_amount'], 2); ?></strong></span>
      </div>
    </div>
    <?php endif; ?>

    <div class="back-link">
      <a href="../index.php">← Back to Dashboard</a>
    </div>
  </div>
</body>
</html>