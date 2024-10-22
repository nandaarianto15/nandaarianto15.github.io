<?php 
require "../../koneksi.php";
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: ../login.php");
    exit();
}

$status = isset($_GET['status']) ? $_GET['status'] : '';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM contact";
if (!empty($search)) {
    $sql .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    .header {
        display: flex;
        justify-content: space-between;
    }

    .btn {
        display: flex;
    }

    .search-form input {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 5px;
    }
</style>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    <div class="header">
        <div class="btn"> 
            <form method="POST" action="../logout.php" style="margin-left: 10px;">
                <button type="submit">Logout</button>
            </form>
        </div>
        <div class="search">
            <form method="GET" action="" class="search-form">
                <input type="text" name="search" placeholder="Search orders..." 
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['phone_number']) . "</td>
                        <td>" . htmlspecialchars($row['message']) . "</td>
                        <td>" . htmlspecialchars($row['date']) . "</td>
                        <td>
                            <a href='javascript:void(0);' class='edit' onclick='openModal(" . htmlspecialchars($row['id']) . ", \"" . htmlspecialchars($row['name']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['phone_number']) . "\", \"" . htmlspecialchars($row['message']) . "\", \"" . htmlspecialchars($row['date']) . "\")'><i class='fas fa-edit'></i></a>
                            <a href='../delete/delete-contact-function.php?id=" . htmlspecialchars($row['id']) . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this contact?\");'><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="read-order.php">View Order Data <i class="fa-solid fa-chevron-right"></i></a>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Contact</h2>
            <form id="editForm" method="POST" action="../update/update-contact-function.php" onsubmit="return confirmSubmit();">
                <input type="hidden" id="editId" name="id" required>
                <div class="form-group">
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="editPhone">Phone Number:</label>
                    <input type="text" id="editPhone" name="phone_number" required>
                </div>
                <div class="form-group">
                    <label for="editMessage">Message:</label>
                    <textarea id="editMessage" name="message" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editDate">Date:</label>
                    <input type="date" id="editDate" name="date" required>
                </div>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, name, email, phone_number, message, date) {
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone_number;
            document.getElementById('editMessage').value = message;
            document.getElementById('editDate').value = date;

            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        function confirmSubmit() {
            const name = document.getElementById('editName').value;
            const email = document.getElementById('editEmail').value;
            const phone = document.getElementById('editPhone').value;
            const message = document.getElementById('editMessage').value;

            const confirmationMessage = `Are you sure you want to update the contact with the following details?\n\n` +
                `Name: ${name}\n` +
                `Email: ${email}\n` +
                `Phone Number: ${phone}\n` +
                `Message: ${message}`;

            return confirm(confirmationMessage);
        }

        window.onload = function() {
            const status = "<?php echo $status; ?>";
            if (status === 'success') {
                showResponse('Contact has been successfully updated!');
            } else if (status === 'error') {
                showResponse('Failed to update the contact. Please try again.');
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
