<?php include 'includes/header.php'; ?>

<?php
// Retrieve the category ID from the URL
$id = $_GET['id'];

// Create DB Object
$db = new Database();

// Fetch the category to edit
$query = "SELECT * FROM categories WHERE id = " . $id;
$category = $db->select($query)->fetch_assoc();

// Fetch all categories
$query = "SELECT * FROM categories";
$categories = $db->select($query);
?>

<?php
if (isset($_POST['submit'])) {
    // Assign Vars
    $name_categories = mysqli_real_escape_string($db->link, $_POST['name']);

    // Simple Validation
    if ($name_categories == '') {
        // Set Error 
        $error = 'Please fill out all required fields';
    } else {
        $query = "UPDATE categories SET name_categories = '$name_categories' WHERE id = " . $id;

        $update_row = $db->update($query);

        if ($update_row) {
            header("Location: index.php?msg=" . urlencode('Record Updated'));
            exit();
        } else {
            $error = 'Error: Could not update category.';
        }
    }
}

if (isset($_POST['delete'])) {
    $query = "DELETE FROM categories WHERE id = " . $id;
    $delete_row = $db->delete($query);

    if ($delete_row) {
        header("Location: index.php?msg=" . urlencode('Record Deleted'));
        exit();
    } else {
        $error = 'Error: Could not delete category.';
    }
}
?>

<?php if (isset($error)) : ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post" action="edit_category.php?id=<?php echo $id; ?>">
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input name="name" type="text" value="<?php echo $category['name_categories']; ?>" class="form-control" placeholder="Enter Category">
    </div>

    <input name="submit" type="submit" class="btn btn-primary" value="Submit">
    <a href="index.php" class="btn btn-warning">Cancel</a>
    <input name="delete" type="submit" class="btn btn-danger" value="Delete">
</form>

<?php include 'includes/footer.php'; ?>
