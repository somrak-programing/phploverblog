<?php include 'includes/header.php'; ?>

<?php
$id = $_GET['id'];

// Create DB Object
$db = new Database();

// Create Query
$query = "SELECT * FROM categories WHERE id = " . $id;
// Run Query
$category = $db->select($query)->fetch_assoc();

// Create Query
$query = "SELECT * FROM categories";
// Run Query
$categories = $db->select($query);
?>


<form method="post" action="edit_category.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Category Name</label>
    <input name="name" type="text" value="<?php echo $category['name_categories']; ?>" class="form-control" placeholder="Enter Category">
  </div>

  <input name="submit" type="submit" class="btn btn-primary" value="Submit"></input>
  <a href="index.php" class="btn btn-warning">Cancel</a>
  <input name="delete" type="submit" class="btn btn-danger" value="Delete"></input>
</form>

<?php include 'includes/footer.php'; ?>