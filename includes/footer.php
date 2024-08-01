<!-- Category -->
<div class="p-4">
    <h4 class="fst-italic">Category</h4>
    <?php if ($categories) : ?>
        <ol class="list-unstyled">
            <?php while ($row = $categories->fetch_assoc()) : ?>
                <li><a href="posts.php?category=<?php echo $row['id']; ?>"><?php echo $row['name_categories']; ?></a></li>
            <?php endwhile; ?>
        </ol>
    <?php else : ?>
        <p>There are no categories yet</p>
    <?php endif; ?>
</div>

<div>
    <h4>About</h4>
    <p><?php echo $site_description; ?></p>
</div>

<footer class="py-5 text-center text-body-secondary bg-body-tertiary">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p class="mb-0">
        <a href="#">Back to top</a>
    </p>
</footer>
<script src="js/bootstrap.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>