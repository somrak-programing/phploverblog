<?php include 'includes/header.php'; ?>

<?php

// Create DB Object
$db = new Database();

// Create Query
$query = "SELECT * FROM categories";
// Run Query
$categories = $db->select($query);
?>

<form method="post" action="add_post.php">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Post Title</label>
        <input name="title" type="text" class="form-control" placeholder="Enter Title" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Post Body</label>
        <textarea name="body" id="" class="form-control" placeholder="Enter Post Body"></textarea>
    </div>

    <select name="category" class="form-select" aria-label="Default select example">
        <?php while ($row = $categories->fetch_assoc()) : ?>
            <?php if ($row['id'] == $post['category']) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>

            <option <?php echo $selected; ?>><?php echo $row['name_categories']; ?></option>
        <?php endwhile; ?>
    </select>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Author</label>
        <input name="author" type="text" class="form-control" placeholder="Enter Author Name" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tags</label>
        <input name="tags" type="text" class="form-control" placeholder="Enter Tags" aria-describedby="emailHelp">
    </div>

    <div>
    <input name="submit" type="submit" class="btn btn-primary" value="Submit"></input>
        <a href="index.php" class="btn btn-warning">Cancel</a>
    </div>
    <br>
</form>






<?php include 'includes/footer.php'; ?>