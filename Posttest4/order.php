<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Form - CleanWave</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #A0DFF7;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #001F3F;
            font-weight: 900;
            font-size: 36px;
            margin-bottom: 2rem;
        }

        .logo {
            display: block;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
        }

        input {
            width: auto;
        }

        button {
            padding: 12px;
            background-color: #006edd;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #005bb5;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .modal-footer button {
            width: 48%;
        }

        table {
            width: 100%;
            text-align: left;
            border: 0;
        }

        @media (max-width: 768px) {
            .container {
                margin: 5% 5%;
            }
            
            h1 {
                font-size: 28px;
                width: 20rem;
            }

            .logo {
                width: 10em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php"><img src="assets/img/1.png" width="30%" alt="" class="logo"></a>
        <h1>Laundry Order Form</h1>
        <form id="laundryForm" method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label for="address">Address</label>
            <textarea id="address" name="address" placeholder="Enter pickup/delivery address" rows="3" required></textarea>

            <label for="service">Service Type</label>
            <select id="service" name="service" required>
                <option value="" hidden></option>
                <option value="basic-package">Basic Package</option>
                <option value="standard-package">Standard Package</option>
                <option value="premium-package">Premium Package</option>
            </select>

            <label for="weight">Estimated Weight (Kg)</label>
            <input type="number" id="weight" name="weight" placeholder="Enter laundry weight (minimum 3kg)" required min="3" step="0.1">

            <label for="pickup">Pickup Date</label>
            <input type="date" id="pickup" name="pickup" required>

            <label for="note">Additional Notes (Optional)</label>
            <textarea id="note" name="note" placeholder="Any additional notes" rows="3"></textarea>

            <button type="button" onclick="showModal()">Submit Order</button>
        </form>
    </div>

    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <h1>Confirm Your Data</h1>
            <p id="modal-body"></p>
            <div class="modal-footer">
                <button type="button" onclick="closeModal()">Cancel</button>
                <button type="button" onclick="submitForm()">Submit</button>
            </div>
        </div>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $phone = htmlspecialchars($_POST['phone']);
            $address = htmlspecialchars($_POST['address']);
            
            $service_raw = htmlspecialchars($_POST['service']);
            $service = '';
            
            if ($service_raw == 'basic-package') {
                $service = 'Basic Package';
            } elseif ($service_raw == 'standard-package') {
                $service = 'Standard Package';
            } elseif ($service_raw == 'premium-package') {
                $service = 'Premium Package';
            } else {
                $service = 'Unknown Service';
            }

            $weight = htmlspecialchars($_POST['weight']);
            $pickup = htmlspecialchars($_POST['pickup']);
            $note = htmlspecialchars($_POST['note']);

            echo "
            <div class='container'>
                <h1>Submitted Data</h1>
                <table cellpadding='10' cellspacing='0'>
                    <tr>
                        <th>Name</th>
                        <td>$name</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>$phone</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>$address</td>
                    </tr>
                    <tr>
                        <th>Service</th>
                        <td>$service</td>
                    </tr>
                    <tr>
                        <th>Weight</th>
                        <td>$weight Kg</td>
                    </tr>
                    <tr>
                        <th>Pickup Date</th>
                        <td>$pickup</td>
                    </tr>
                    <tr>
                        <th>Note</th>
                        <td>" . ($note ? $note : "None") . "</td>
                    </tr>
                </table>
            </div>
            ";
        }
    ?>

    <script src="assets/js/script.js"></script>
</body>
</html>
