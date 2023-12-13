<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Student Information Form</h2>

        <?php
        // Initialize default values
        $defaultValues = array(
            "name" => "",
            "place_of_birth" => "",
            "date_of_birth" => "",
            "address" => "",
            "gender" => "",
            "telephone" => "",
            "email" => "",
            "image" => "default.jpg", // Default image file name
            "parent_name" => "",
            "parent_telephone" => "",
            "relationship" => "",
            "student_id" => "",
            "faculty" => "",
            "department" => "",
            "class" => "",
            "registration_date" => ""
        );
function validateName($name)
{
    return preg_match('/^[a-zA-Z\s]+$/', $name);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        echo "<p class='text-danger'>Name is required.</p>";
    } elseif (!validateName($_POST["name"])) {
        echo "<p class='text-danger'>Name should contain only letters and spaces.</p>";
    } else {
        $defaultValues['name'] = $_POST["name"];
    }}
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_POST as $key => $value) {
                $defaultValues[$key] = $value;
            }

            $targetDir = "uploads/"; // Create a folder named "uploads" in the same directory as this script
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "<p class='text-danger'>File is not an image.</p>";
                    $uploadOk = 0;
                }
            }

            if (file_exists($targetFile)) {
                echo "<p class='text-danger'>Sorry, file already exists.</p>";
                $uploadOk = 0;
            }

            if ($_FILES["image"]["size"] > 500000) {
                echo "<p class='text-danger'>Sorry, your file is too large.</p>";
                $uploadOk = 0;
            }

            $allowedExtensions = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowedExtensions)) {
                echo "<p class='text-danger'>Sorry, only JPG, JPEG, PNG, and GIF files are allowed.</p>";
                $uploadOk = 0;
            }

          
if ($uploadOk == 0) {
    echo "<p class='text-danger'>Sorry, your file was not uploaded.</p>";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "<p class='text-success'>The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.</p>";
        $defaultValues['image'] = basename($_FILES["image"]["name"]);

        header("Location: display.php?" . http_build_query($defaultValues));
        exit();
    } else {
        echo "<p class='text-danger'>Sorry, there was an error uploading your file.</p>";
    }
}


        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <h3 class="mb-3">Personal Information</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $defaultValues['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="place_of_birth" class="form-label">Place of Birth:</label>
                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="<?php echo $defaultValues['place_of_birth']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $defaultValues['date_of_birth']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" required><?php echo $defaultValues['address']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="male" <?php echo ($defaultValues['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($defaultValues['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Telephone:</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo $defaultValues['telephone']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $defaultValues['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
<!-- Qeybta Waalidka -->
            <h3 class="mb-3">Parent Information</h3>
            <div class="mb-3">
                <label for="parent_name" class="form-label">Parent Name:</label>
                <input type="text" class="form-control" id="parent_name" name="parent_name" value="<?php echo $defaultValues['parent_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="parent_telephone" class="form-label">Parent Telephone:</label>
                <input type="tel" class="form-control" id="parent_telephone" name="parent_telephone" value="<?php echo $defaultValues['parent_telephone']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="relationship" class="form-label">Relationship:</label>
                <input type="text" class="form-control" id="relationship" name="relationship" value="<?php echo $defaultValues['relationship']; ?>" required>
            </div>

            <!-- Qeybta Academica -->
            <h3 class="mb-3">Academic Information</h3>
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID:</label>
                <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $defaultValues['student_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="faculty" class="form-label">Faculty:</label>
                <input type="text" class="form-control" id="faculty" name="faculty" value="<?php echo $defaultValues['faculty']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department:</label>
                <input type="text" class="form-control" id="department" name="department" value="<?php echo $defaultValues['department']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="class" class="form-label">Class:</label>
                <input type="text" class="form-control" id="class" name="class" value="<?php echo $defaultValues['class']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="registration_date" class="form-label">Registration Date:</label>
                <input type="date" class="form-control" id="registration_date" name="registration_date" value="<?php echo $defaultValues['registration_date']; ?>" required>
            </div>

            <br>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>