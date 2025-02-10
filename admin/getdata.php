<?php
require 'connection.php'; // Assuming this file contains the database connection details

// Set the number of transactions per page
$limit = 10;

// Get the current page number (if not set, default to 1)
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch data from the 'transactions' table with pagination
$query = "SELECT * FROM transactions LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Check if the query was successful and data is available
if ($result && mysqli_num_rows($result) > 0) {
    // Store the data in an array for easy access
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $transactions = [];
}

// Fetch total number of records for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM transactions";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRecords = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRecords / $limit);

// Function to export data to Excel
function exportToExcel($transactions)
{
    // Define the file name
    $fileName = "transactions_" . date('Y-m-d_H-i-s') . ".xls";

    // Prepare the header and data rows for the table
    $html = '<table border="1" style="border-collapse: collapse; width: 100%;">';
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .pagination .page-item .page-link {
            color: #007bff;
        }

        .btn-export {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .btn-export:hover {
            background-color: #218838;
            text-decoration: none;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Transaction Data</h2>

        <!-- Display data in a table -->
        <?php if (!empty($transactions)): ?>
            <div class="d-flex justify-content-between mb-3">
                <a href="?export=excel" class="btn btn-export">Export to Excel</a>
            </div>
            <table class="table table-striped table-bordered">
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

            <!-- Pagination controls -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($page - 1); ?>" tabindex="-1">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php else: ?>
            <p>No transactions found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>