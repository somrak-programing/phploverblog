<?php include 'includes/header.php'; ?>

<?php
$id = $_GET['id'];

// Create DB Object
$db = new Database();

// Create Query
$query = "SELECT * FROM posts WHERE id = " . $id;
// Run Query
$post = $db->select($query)->fetch_assoc();

// Create Query
$query = "SELECT * FROM categories";
// Run Query
$categories = $db->select($query);
?>

<?php

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
        $query = "UPDATE posts
        SET title = '$title',
        body = '$body',
        category = '$category',
        author = '$author',
        tags = '$tags'
        WHERE id =".$id;

        $update_row = $db->update($query);

        if ($update_row) {
            header("Location: index.php?msg=" . urlencode('Record Updated'));
            exit();
        } else {
            $error = 'Error: Could not add post.';
        }
    }
}

if (isset($_POST['delete'])) {
    $query = "DELETE FROM posts WHERE id = " . $id;
    $delete_row = $db->delete($query);

    if ($delete_row) {
        header("Location: index.php?msg=" . urlencode('Post Deleted'));
        exit();
    } else {
        $error = 'Error: Could not delete post.';
    }
}

?>

<form method="post" action="edit_post.php?id=<?php echo $id; ?>">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Post Title</label>
        <input name="title" type="text" value="<?php echo $post['title']; ?>" class="form-control" placeholder="Enter Title" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Post Body</label>
        <textarea name="body" id="" class="form-control" placeholder="Enter Post Body"><?php echo $post['body']; ?></textarea>
    </div>

    <label for="category" class="form-label">Category</label>
    <select name="category" class="form-select" aria-label="Default select example">
        <?php while ($row = $categories->fetch_assoc()) : ?>
            <?php if ($row['id'] == $post['category']) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>

            <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name_categories']; ?></option>
        <?php endwhile; ?>
    </select>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Author</label>
        <input name="author" value="<?php echo $post['author']; ?>" type="text" class="form-control" placeholder="Enter Author Name">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tags</label>
        <input name="tags" value="<?php echo $post['tags']; ?>" type="text" class="form-control" placeholder="Enter Tags" aria-describedby="emailHelp">
    </div>

    <div>
        <input name="submit" type="submit" class="btn btn-primary" value="Submit"></input>
        <a href="index.php" class="btn btn-warning">Cancel</a>
        <input name="delete" type="submit" class="btn btn-danger" value="Delete"></input>

    </div>
    <br>
</form>






<?php include 'includes/footer.php'; ?>