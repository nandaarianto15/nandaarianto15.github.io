<?php 
include "../../koneksi.php";

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['id'];

$status = isset($_GET['status']) ? $_GET['status'] : '';

if (isset($_SESSION['name']) && $_SESSION['name'] === 'admin') {
    $sql = "SELECT * FROM orders";
} else {
    $sql = "SELECT * FROM orders WHERE user_id = $user_id";
}

$result = mysqli_query($conn,  $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Page</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    .btn {
        display: flex;
    }
</style>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    <div class="btn">
        <form method="POST" action="../logout.php" style="margin-right: 2%;">
            <button type="submit">Logout</button>
        </form>
        <?php 
        if (isset($_SESSION['name']) && $_SESSION['name'] !== 'admin') {
            ?>
            <a href="../../order.php"><button>Back</button></a>
            <?php
        }
        ?>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Service</th>
                <th>Weight</th>
                <th>Order Date</th>
                <th>Note</th>
                <th>Status</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php
            $isAdmin = ($_SESSION['name'] === 'admin') ? 'true' : 'false';

            while ($row = mysqli_fetch_assoc($result)) {
                $note = !empty($row['note']) ? htmlspecialchars($row['note']) : "No notes given";
                $photo = !empty($row['foto']) ? "../../assets/img_laundry/" . htmlspecialchars($row['foto']) : "No photo";

                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['fullname']) . "</td>
                        <td>" . htmlspecialchars($row['phone_number']) . "</td>
                        <td>" . htmlspecialchars($row['address']) . "</td>
                        <td>" . htmlspecialchars($row['service']) . "</td>
                        <td>" . htmlspecialchars($row['weight']) . " kg</td>
                        <td>" . htmlspecialchars($row['order_date']) . "</td>
                        <td>" . $note . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td>";

                if ($photo !== "No photo") {
                    echo "<img src='$photo' alt='Order Photo' style='width: 120px; height: 100px; object-fit: cover;' onclick=\"openImageModal('$photo', '" . addslashes(htmlspecialchars($row['fullname'])) . "')\">";
                } else {
                    echo $photo;
                }

                echo "</td>
                        <td>
                            <a href='javascript:void(0);' class='edit' 
                            onclick=\"openModal(
                                " . htmlspecialchars($row['id']) . ",
                                '" . addslashes(htmlspecialchars($row['fullname'])) . "',
                                '" . addslashes(htmlspecialchars($row['phone_number'])) . "',
                                '" . addslashes(htmlspecialchars($row['address'])) . "',
                                '" . addslashes(htmlspecialchars($row['service'])) . "',
                                '" . addslashes(htmlspecialchars($row['weight'])) . "',
                                '" . addslashes(htmlspecialchars($row['order_date'])) . "',
                                '" . addslashes($note) . "',
                                '" . addslashes(htmlspecialchars($row['status'])) . "',
                                $isAdmin
                            )\"><i class='fas fa-edit'></i></a>
                            <a href='../delete/delete-order-function.php?id=" . htmlspecialchars($row['id']) . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this order?\");'><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>";
            }
        ?>
        </tbody>

    </table>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Order</h2>
            <form id="editForm" method="POST" action="../update/update-order-function.php" onsubmit="return confirmSubmit()" enctype="multipart/form-data">
                <input type="hidden" name="id" id="editId">
                <div class="form-group">
                    <label for="editName">Full Name:</label>
                    <input type="text" name="fullname" id="editName" required>
                </div>
                <div class="form-group">
                    <label for="editPhone">Phone Number:</label>
                    <input type="tel" name="phone_number" id="editPhone" required>
                </div>
                <div class="form-group">
                    <label for="editAddress">Address:</label>
                    <input type="text" name="address" id="editAddress" required>
                </div>
                <div class="form-group">
                    <label for="editService">Service:</label>
                    <select name="service" id="editService">
                        <option value="Basic Package">Basic Package</option>
                        <option value="Standard Package">Standard Package</option>
                        <option value="Premium Package">Premium Package</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editWeight">Weight:</label>
                    <input type="number" name="weight" id="editWeight" required>
                </div>
                <div class="form-group">
                    <label for="editOrderDate">Order Date:</label>
                    <input type="date" name="order_date" id="editOrderDate" required>
                </div>
                <div class="form-group">
                    <label for="editNote">Note:</label>
                    <textarea name="note" id="editNote"></textarea>
                </div>
                <div class="form-group">
                    <label for="editStatus">Status:</label>
                    <select name="status" id="editStatus">
                        <option value="Requested">Requested</option>
                        <option value="Picked Up">Picked Up</option>
                        <option value="In Process">In Process</option>
                        <option value="Ready for Delivery">Ready for Delivery</option>
                        <option value="Out for Delivery">Out for Delivery</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="photo" id="">
                </div>
                <button type="submit">Update Order</button>
            </form>
        </div>
    </div>


    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeImageModal()" style="margin-bottom: 1%;">X</span>
            <img id="modalImage" src="" alt="Order Photo" style="width: 100%; height: auto;"/>
        </div>
    </div>

    <?php 
    if (isset($_SESSION['name']) && $_SESSION['name'] === 'admin') {
        ?>
        <a href="read-contact.php">View Incoming Contact Data <i class="fa-solid fa-chevron-right"></i></a>
        <?php
    }
    ?>

    <div id="responseModal" class="modal">
        <div class="modal-content" id="responseMessage">
    </div>

    <script>
        function openModal(id, fullname, phone, address, service, weight, orderDate, note, status, isAdmin) {
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = fullname;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editAddress').value = address;
            document.getElementById('editService').value = service;
            document.getElementById('editWeight').value = weight;
            document.getElementById('editOrderDate').value = orderDate;
            document.getElementById('editNote').value = note;
            document.getElementById('editStatus').value = status;

            const statusField = document.getElementById('editStatus').parentElement;
            if (isAdmin === true) {
                statusField.style.display = 'block';
            } else {
                statusField.style.display = 'none';
            }

            document.getElementById('editModal').style.display = 'block';
        }


        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function openImageModal(imageSrc, description) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'block';
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }


        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            const imageModal = document.getElementById('imageModal');
            if (event.target === modal) {
                closeModal();
            }
            if (event.target === imageModal) {
                closeImageModal();
            }
        }

        function confirmSubmit() {
            const fullname = document.getElementById('editName').value;
            const phone = document.getElementById('editPhone').value;
            const address = document.getElementById('editAddress').value;
            const service = document.getElementById('editService').value;
            const weight = document.getElementById('editWeight').value;
            const orderDate = document.getElementById('editOrderDate').value;
            const note = document.getElementById('editNote').value || "No notes provided"; 
            const status = document.getElementById('editStatus').value; 

            const message = `Are you sure you want to update the order with the following details?\n\n` +
                `Full Name: ${fullname}\n` +
                `Phone Number: ${phone}\n` +
                `Address: ${address}\n` +
                `Service: ${service}\n` +
                `Weight: ${weight} kg\n` +
                `Order Date: ${orderDate}\n` +
                `Note: ${note}\n` +
                `Status: ${status}`;

            return confirm(message);
        }
        

    </script>

    <script>
        window.onload = function() {
            const status = "<?php echo $status; ?>";
            if (status === 'success') {
                showResponse('Order has been successfully updated!');
            } else if (status === 'error') {
                showResponse('Failed to update the order. Please try again.');
            }
        };

        function showResponse(message) {
            const responseModal = document.getElementById('responseModal');
            const responseMessage = document.getElementById('responseMessage');
            responseMessage.innerHTML = `<h3 style="margin:0">${message}</h3>`;
            responseModal.style.display = 'block';

            setTimeout(() => {
                responseModal.style.display = 'none';
            }, 3000);
        }
    </script>

</body>
</html>
