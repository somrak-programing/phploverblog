<?php include 'includes/header.php'; ?>

<form method="post" action="add_category.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Category Name</label>
    <input name="name" type="text" class="form-control" placeholder="Enter Category">
  </div>

  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
  <a href="index.php" class="btn btn-warning">Cancel</a>
</form>

<?php include 'includes/footer.php'; ?>