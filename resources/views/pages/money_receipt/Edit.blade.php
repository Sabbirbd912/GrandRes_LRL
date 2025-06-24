<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Money Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
            color: #333;
        }
        .receipt-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .receipt-box h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .receipt-box p.center {
            text-align: center;
            margin-top: 0;
            font-size: 14px;
        }
        .info, .info div {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            max-height: 60px;
        }
    </style>
</head>
<body>

<div class="receipt-box">
    <div class="logo">
        <img src="https://via.placeholder.com/150x50?text=Your+Logo" alt="Logo">
    </div>

    <h2>GRAND RESTAURANT</h2>
    <p class="center">123 Main St, City, Country<br>
    Phone: 123-456-7890 | Email: info@abc.com</p>

    <h3 style="text-align:center; margin-top: 30px;">Money Receipt</h3>

    <div class="info">
        <div>
            <strong>Receipt No:</strong> MR-35
        </div>
        <div>
            <strong>Date:</strong> 13-Apr-2025
        </div>
    </div>
    <div class="info">
        <div>
            <strong>Received From:</strong> Tanmoy
        </div>
        <div>
            <strong>Payment Method:</strong> Cash
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Salad</td>
                <td>1</td>
                <td>300</td>
                <td>300</td>
            </tr>
            <tr>
                <td>Salad</td>
                <td>1</td>
                <td>300</td>
                <td>300</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        Total: 600
    </div>
</div>

</body>
</html>
