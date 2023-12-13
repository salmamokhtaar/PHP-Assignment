<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Information</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Submitted Information</h2>

        <?php
        $submittedData = $_GET;

        echo "<table class='table'>";
        foreach ($submittedData as $key => $value) {
            echo "<tr><td><strong>$key:</strong></td>";
            if ($key === 'image') {
                echo "<td><img src='uploads/$value' alt='Submitted Image' style='max-width: 768px; max-height: 1024px;'></td>";
            } else {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>