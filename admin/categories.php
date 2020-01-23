<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shauntas_boutique/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

$sql = "SELECT * FROM categories WHERE parent = 0";
$result = $db->query($sql);
$errors = array();
$category = '';
$post_parent = 0;

// Edit Category
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int) $_GET['edit'];
    $edit_id = sanitize($edit_id);
    $edit_sql = "SELECT * FROM categories WHERE id = '$edit_id'";
    $edit_resutl = $db->query($edit_sql);
    $edit_category = mysqli_fetch_assoc($edit_resutl);
}

// Delete Category
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "SELECT * FROM categories WHERE id = '$delete_id'";
    $result = $db->query($sql);
    $category = mysqli_fetch_assoc($result);
    if ($category['parent'] == 0) {
        $sql = "DELETE FROM categories WHERE parent = '$delete_id'";
        $db->query($sql);
    }
    $dsql = "DELETE FROM categories WHERE id = '$delete_id'";
    $db->query($dsql);
    header('Location: categories.php');
}

//    Process Form
if (isset($_POST) && !empty($_POST)) {
    $post_parent = sanitize($_POST['parent']);
    $category = sanitize($_POST['category']);
    $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
    $fresult = $db->query($sqlform);
    $count = mysqli_num_rows($fresult);
    // If category is Blank
    if ($category == '') {
        $errors[] .= 'The category cannot be left blank!';
    }

    // If exists in the database
    if ($count > 0) {
        $errors[] .= $category . ' already exists. Please choose a new category!';
    }

    // Display error on update database
    if (!empty($errors)) {
        // Display Errors
        $display = display_errors($errors);
        ?>
        <script>
            jQuery('document').ready(function () {
                jQuery('#errors').html('<?= $display; ?>');
            });
        </script>
        <?php
    } else {
        $updatesql = "INSERT INTO categories (category, parent) VALUES ('$category', '$post_parent')";
        $db->query($updatesql);
        header('Location: categories.php');
    }
}
$category_value = '';
$parent_value = 0;
if (isset($_GET['edit'])) {
    $category_value = $edit_category['category'];
    $parent_id = $edit_category['parent'];
} else {
    if (isset($_POST)) {
        $category_value = $category;
        $parent_value = $post_parent;
    }
}
?>
<h2 class="text-center">Categories</h2> <hr>
<div class="">
    <!-- Form -->
    <div class="col-md-6">
        <form class="form" action="categories.php<?= ((isset($_GET['edit'])) ? '?edit=' . $edit_id : ''); ?>" method="post">
            <legend><?= ((isset($_GET['edit'])) ? 'Edit' : 'Add A') ?> Category</legend>
            <div id="errors">

            </div>
            <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control" name="parent" id="parent">
                    <option value="0">Parent</option>
                    <?php while ($parent = mysqli_fetch_assoc($result)): ?>
                        <option value="<?= $parent['id']; ?>"><?= $parent['category']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="<?= $category_value; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="<?= ((isset($_GET['edit'])) ? 'Edit' : 'Add') ?> Category" class="btn btn-success">
            </div>
        </form>
    </div>
    <!-- Category Table -->
    <div class="col-md-6">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th class="text-center">Category</th>
                    <th class="text-center">Parent</th>
                    <th class="text-center">Edit or Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2 = "SELECT * FROM categories WHERE parent = 0";
                $result = $db->query($sql2);
                while ($parent = mysqli_fetch_assoc($result)):
                    $parent_id = (int) $parent['id'];
                    $sql3 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                    $cresutl = $db->query($sql3);
                    ?>
                    <tr class="bg-primary">
                        <td><?= $parent['category']; ?></td>
                        <td>Parent</td>
                        <td>
                            <a href="categories.php?edit=<?= $parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="categories.php?delete=<?= $parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                        </td>
                    </tr>
                    <?php while ($child = mysqli_fetch_assoc($cresutl)) : ?>
                        <tr class="bg-info">
                            <td><?= $child['category']; ?></td>
                            <td><?= $parent['category']; ?></td>
                            <td>
                                <a href="categories.php?edit=<?= $child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="categories.php?delete=<?= $child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php endWhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
