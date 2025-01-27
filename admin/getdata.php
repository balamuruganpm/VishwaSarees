<?php
require 'connection.php'; // Assuming this file contains the database connection details

// Fetch data from the 'transactions' table
$query = "SELECT * FROM transactions";
$result = mysqli_query($conn, $query);

// Check if the query was successful and data is available
if ($result && mysqli_num_rows($result) > 0) {
    // Store the data in an array for easy access
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $transactions = [];
}

// Function to export data to Excel
function exportToExcel($transactions)
{
    // Define the file name
    $fileName = "transactions_" . date('Y-m-d_H-i-s') . ".xls";

    // Prepare the header and data rows for the table
    $html = '<table border="1">';
    $html .= '<tr><th>ID</th><th>Customer Name</th><th>Contact</th><th>Address</th><th>Payment Method</th><th>Total Amount</th><th>Product IDs</th><th>Order Date</th></tr>';

    foreach ($transactions as $transaction) {
        $html .= "<tr>
                    <td>{$transaction['id']}</td>
                    <td>{$transaction['customer_name']}</td>
                    <td>{$transaction['contact']}</td>
                    <td>{$transaction['address']}</td>
                    <td>{$transaction['payment_method']}</td>
                    <td>{$transaction['total_amount']}</td>
                    <td>{$transaction['product_ids']}</td>
                    <td>" . date('d/m/Y H:i:s', strtotime($transaction['order_date'])) . "</td>
                  </tr>";
    }

    $html .= '</table>';

    // Set headers for Excel file download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename={$fileName}");
    echo $html;
    exit();
}

// If the user requests to export the data
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    exportToExcel($transactions);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Montserrat', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-5">Transaction Data</h2>

        <!-- Display data in a table -->
        <?php if (!empty($transactions)): ?>
            <div class="text-end mb-3">
                <a href="?export=excel" class="btn btn-success">Export to Excel</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Payment Method</th>
                        <th>Total Amount</th>
                        <th>Product IDs</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?php echo $transaction['id']; ?></td>
                            <td><?php echo $transaction['customer_name']; ?></td>
                            <td><?php echo $transaction['contact']; ?></td>
                            <td><?php echo $transaction['address']; ?></td>
                            <td><?php echo $transaction['payment_method']; ?></td>
                            <td><?php echo $transaction['total_amount']; ?></td>
                            <td><?php echo $transaction['product_ids']; ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($transaction['order_date'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No transactions found.</p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>