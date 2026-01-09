<!-- ============================================ -->
<!-- FILE: index.php (Loan Calculator Main Page) -->
<!-- ============================================ -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lending System - Loan Calculator</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #000000;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .container {
      background: #1a1a1a;
      border-radius: 12px;
      border: 1px solid #333;
      max-width: 600px;
      width: 100%;
      padding: 40px;
    }

    h1 {
      color: #ffffff;
      text-align: center;
      font-size: 2rem;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .subtitle {
      text-align: center;
      color: #888;
      font-size: 1rem;
      margin-bottom: 30px;
      font-weight: 300;
    }

    .credit-info {
      background: #222;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      border: 1px solid #333;
    }

    .credit-badge {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
    }

    .credit-label {
      color: #888;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .credit-amount {
      color: #ffffff;
      font-size: 2rem;
      font-weight: 600;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      color: #ffffff;
      font-weight: 500;
      margin-bottom: 8px;
      font-size: 0.9rem;
    }

    input[type="number"],
    select {
      width: 100%;
      padding: 12px;
      border: 1px solid #333;
      border-radius: 6px;
      font-size: 1rem;
      background: #000;
      color: #ffffff;
      transition: border-color 0.2s;
    }

    input[type="number"]:focus,
    select:focus {
      outline: none;
      border-color: #666;
    }

    .hint {
      color: #666;
      font-size: 0.8rem;
      margin-top: 5px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 14px;
      background: #ffffff;
      color: #000000;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    button[type="submit"]:hover {
      background: #e0e0e0;
    }

    button[type="submit"]:active {
      background: #d0d0d0;
    }

    .info-section {
      margin-top: 30px;
      padding: 20px;
      background: #222;
      border-radius: 8px;
      border: 1px solid #333;
    }

    .info-section h3 {
      color: #ffffff;
      margin-bottom: 15px;
      font-size: 1.1rem;
      font-weight: 600;
    }

    .info-section ul {
      list-style: none;
      padding-left: 0;
    }

    .info-section li {
      color: #aaa;
      padding: 8px 0;
      padding-left: 25px;
      position: relative;
      line-height: 1.5;
      font-size: 0.9rem;
    }

    .info-section li:before {
      content: "•";
      position: absolute;
      left: 0;
      color: #ffffff;
      font-size: 1.2rem;
    }

    /* Select dropdown arrow */
    select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      padding-right: 35px;
    }

    select option {
      background: #1a1a1a;
      color: #ffffff;
    }

    ::placeholder {
      color: #555;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 30px 20px;
      }

      h1 {
        font-size: 1.75rem;
      }

      .credit-amount {
        font-size: 1.75rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>💰 LENDING SYSTEM</h1>
    <p class="subtitle">Calculate your loan payments easily</p>
    
    <div class="credit-info">
      <div class="credit-badge">
        <span class="credit-label">Maximum Credit Limit</span>
        <span class="credit-amount">₱50,000</span>
      </div>
    </div>

    <form method="POST" action="code/loan_calcu.php" id="loanForm">
      <div class="form-group">
        <label for="loan_amount">Loan Amount (₱)</label>
        <input 
          type="number" 
          id="loan_amount" 
          name="loan_amount" 
          min="500" 
          max="50000" 
          step="100"
          placeholder="Enter amount (₱500 - ₱50,000)"
          required>
        <div class="hint">Minimum: ₱500 | Maximum: ₱50,000</div>
      </div>

      <div class="form-group">
        <label for="loan_term">Loan Term</label>
        <select id="loan_term" name="loan_term" required>
          <option value="">Select loan term</option>
          <option value="1">1 Month</option>
          <option value="3">3 Months</option>
          <option value="6">6 Months</option>
          <option value="9">9 Months</option>
          <option value="12">12 Months</option>
          <option value="24">24 Months</option>
        </select>
      </div>

      <button type="submit" name="submit">Calculate Loan Payment</button>
    </form>

    <div class="info-section">
      <h3>📋 How It Works</h3>
      <ul>
        <li>Choose your desired loan amount between ₱500 and ₱50,000</li>
        <li>Select your preferred payment term</li>
        <li>Our system calculates using a standard 12% annual interest rate</li>
        <li>View your monthly payment, total interest, and total amount to pay</li>
      </ul>
    </div>
  </div>
</body>
</html>