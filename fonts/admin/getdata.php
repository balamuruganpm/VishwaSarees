<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Statement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .date-picker {
            display: flex;
            gap: 15px;
            justify-content: center;
            align-items: center;
        }
        .date-picker input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            transition: border 0.3s ease-in-out;
        }
        .date-picker input:focus {
            border-color: #007bff;
        }
        .btn-get-data {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        .btn-get-data:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-5">Get Transaction Statement</h2>
        <div class="date-picker">
            <input type="date" id="start_date" placeholder="Start Date">
            <input type="date" id="end_date" placeholder="End Date">
            <button class="btn-get-data" onclick="getData()">GET Data</button>
            <a href="./dashboard.php" class="btn btn-dark">Back to Dashboard</a>
        </div>
        <div id="result" class="mt-5"></div>
    </div>

    <script>
        function getData() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                window.location.href = `get_transaction_data.php?start_date=${startDate}&end_date=${endDate}`;
            } else {
                alert("Please select both start and end dates.");
            }
        }
    </script>
</body>
</html>
