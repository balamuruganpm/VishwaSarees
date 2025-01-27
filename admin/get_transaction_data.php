<?php
require 'connection.php'; // Assuming this file contains the database connection details

// Check if the dates are set and validate them
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = mysqli_real_escape_string($conn, $_GET['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_GET['end_date']);

    // Validate date format (YYYY-MM-DD)
    if (!preg_match("/\d{4}-\d{2}-\d{2}/", $start_date) || !preg_match("/\d{4}-\d{2}-\d{2}/", $end_date)) {
        echo "Invalid date format. Please use YYYY-MM-DD format.";
        exit;
    }

    // Fetch data from the 'orders' table based on the selected date range
    $query = "SELECT * FROM `orders` WHERE `created_at` BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $row_data = array(
                "GSTIN/UIN" => $row['gst_no'],
                "Party Name" => $row['name'],
                "Transaction Type" => "Sale", // default value
                "Invoice No." => "On-" . $row['id'],
                "Invoice Date" => '=TEXT("' . date('d/m/Y', strtotime($row['created_at'])) . '", "dd/mm/yyyy")',
                "Invoice Value" => $row['Amount'],
                "Rate" => "5", // default value
                "Cess Rate" => "0", // default value
                "Taxable value" => $row['Amount'] / 1.05, // Calculate taxable value
                "Reverse Charge" => "N", // default value
                "Integrated Tax Amount" => ($row['state'] == "other") ? number_format($row['Amount'] - $row['Amount'] / 1.05, 0) : "0",
                "Central Tax Amount" => ($row['state'] != "other") ? number_format(($row['Amount'] - $row['Amount'] / 1.05) / 2, 1) : "0",
                "State/UT Tax Amount" => ($row['state'] != "other") ? number_format(($row['Amount'] - $row['Amount'] / 1.05) / 2, 1) : "0",
                "Cess Amount" => "0", // default value
                "Place of Supply(Name of state)" => $row['states']
            );
            $data[] = $row_data;
        }

        // Generate HTML Table
        $html = '<table border="1">';
        $html .= '<tr>';
        foreach (array_keys($data[0]) as $header) {
            $html .= "<th>{$header}</th>";
        }
        $html .= '</tr>';

        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= "<td>{$cell}</td>";
            }
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Load HTML table into DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        // Convert HTML table to Excel format
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=transaction_statement.xls");
        echo $html;
    } else {
        echo "No records found for the selected date range.";
    }
} else {
    echo "Invalid request.";
}
?>