<?php include 'includes/header.php'; ?>
<?php

// Create DB Object
$db = new Database();

if (isset($_POST['submit'])) {
    // Assign Vars
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

    // Simple Validation
    if ($title == '' || $body == '' || $category == '' || $author == '') {
        // Set Error 
        $error = 'Please fill out all required fields';
    } else {
        $query = "INSERT INTO posts (title, body, category, author, tags)
                  VALUES ('$title', '$body', '$category', '$author', '$tags')";

        $insert_row = $db->insert($query);

        if ($insert_row) {
            header("Location: index.php?msg=" . urlencode('Record Added'));
            exit();
        } else {
            $error = 'Error: Could not add post.';
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

<form method="post" action="add_post.php">
    <div class="mb-3">
        <label for="title" class="form-label">Post Title</label>
        <input name="title" type="text" class="form-control" placeholder="Enter Title">
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">Post Body</label>
        <textarea name="body" class="form-control" placeholder="Enter Post Body"></textarea>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select name="category" class="form-select">
            <?php while ($row = $categories->fetch_assoc()) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name_categories']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input name="author" type="text" class="form-control" placeholder="Enter Author Name">
    </div>

    <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <input name="tags" type="text" class="form-control" placeholder="Enter Tags">
    </div>

    <div>
        <input name="submit" type="submit" class="btn btn-primary" value="Submit">
        <a href="index.php" class="btn btn-warning">Cancel</a>
    </div>
    <br>
</form>

<?php include 'includes/footer.php'; ?>
