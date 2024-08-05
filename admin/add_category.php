<?php include 'includes/header.php'; ?>

<?php

// Create DB Object
$db = new Database();

if (isset($_POST['submit'])) {
    // Assign Vars
    $name_categories = mysqli_real_escape_string($db->link, $_POST['name']);

    // Simple Validation
    if ($name_categories == '') {
        // Set Error 
        $error = 'Please fill out all required fields';
    } else {
        $query = "INSERT INTO categories (name_categories) VALUES ('$name_categories')";

        $insert_row = $db->insert($query);

        if ($insert_row) {
            header("Location: index.php?msg=" . urlencode('Category Added'));
            exit();
        } else {
            $error = 'Error: Could not add category.';
        }
    }
}

// Create Query
$query = "SELECT * FROM categories";
// Run Query
$categories = $db->select($query);
?>

<?php if (isset($error)) : ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post" action="add_category.php">
  <div class="mb-3">
    <label for="name" class="form-label">Category Name</label>
    <input name="name" type="text" class="form-control" placeholder="Enter Category">
  </div>

  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
  <a href="index.php" class="btn btn-warning">Cancel</a>
</form>

<?php include 'includes/footer.php'; ?>
