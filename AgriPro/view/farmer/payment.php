<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Farmer Dashboard</title>
    <script src="../../asset/js/farmer/make_payment.js" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #4CAF50;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 50px;
            text-align: center;
        }
        form {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        fieldset {
            border: none;
        }
        legend {
            font-weight: bold;
            font-size: 1.2rem;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        #paymentResponse {
            color: red;
            font-size: 14px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        a:hover {
            color: #45a049;
        }
    </style>
  </head>
  <body>

    <?php
        include_once("dashboard.php"); 
        include_once('../../model/userModel.php');
    ?>
    <h3 style="text-align: center">Payment</h3>
    <hr />
      <table align="right" class="table-st" cellspacing="0" width="70%">
        <tr>
          <td>
            <div class="container">
                <div>
                    <h1>Make Payment to Advisor</h1>
        
                    <form id="paymentForm">
                        <fieldset>
                            <legend>Payment Details</legend>
        
                            <label for="advisor_id">Select Advisor:</label>
                            <select name="advisor_id" id="advisor_id">
                                <!-- Options will be loaded dynamically via AJAX -->
                            </select>
        
                            <label for="amount">Enter Amount:</label>
                            <input type="number" name="amount" id="amount" step="0.01" required>
        
                            <div id="paymentResponse"></div>
        
                            <label for="payment_method">Select Payment Method:</label>
                            <select name="payment_method" id="payment_method" required>
                                <option value="card">Card</option>
                                <option value="bkash">bKash</option>
                                <option value="nagad">Nagad</option>
                            </select>
        
                            <button type="submit">Pay</button>
                        </fieldset>
                    </form>
        
                    <a href="Home.php">Back to Home</a>
                </div>
            </div>
          </td>
        </tr>
      </table>
  </body>
</html> 