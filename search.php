<?php
include_once('./includes/headerNav.php');
include "includes/config.php";
?>

<div class="overlay" data-overlay></div>

<header>
  <?php require_once './includes/topheadactions.php'; ?>
  <?php require_once './includes/mobilenav.php'; ?>
</header>

<main>

<div class="product-container">
<div class="container">

<?php require_once './includes/categorysidebar.php'; ?>

<div class="product-box">
<div class="product-main">

<h2 class="title">
Search:
<?php
$search_input = "";

if (isset($_POST['search'])) {
    $search_input = $_POST['search'];
} elseif (isset($_GET['catag'])) {
    $search_input = $_GET['catag'];
}

echo htmlspecialchars(trim($search_input));
?>
</h2>

<div class="product-grid">

<?php
// Kiểm tra input hợp lệ
if (!empty($search_input)) {

    // === CLEAN INPUT ===
    $search_input = trim($search_input);
    $search_input = preg_replace('/\s+/', ' ', $search_input);
    $search_input = mysqli_real_escape_string($conn, $search_input);

    // === PAGINATION ===
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 8;
    $offset = ($page - 1) * $limit;

    // === SPLIT KEYWORDS ===
    $keywords = array_filter(explode(" ", $search_input));
    $keywords = array_values($keywords);

    // === BUILD QUERY ===
    $conditions = [];

    foreach ($keywords as $word) {
        $conditions[] = "(product_title LIKE '%$word%' OR product_catag LIKE '%$word%')";
    }

    $where_clause = implode(" AND ", $conditions);

    $search_query = "SELECT * FROM products 
                     WHERE $where_clause 
                     ORDER BY product_id DESC 
                     LIMIT $offset, $limit";

    $count_query = "SELECT COUNT(*) as total FROM products WHERE $where_clause";

    $search_result = mysqli_query($conn, $search_query);
    $count_result = mysqli_query($conn, $count_query);
    $total_products = mysqli_fetch_assoc($count_result)['total'];
    $total_pages = ceil($total_products / $limit);

    if (mysqli_num_rows($search_result) > 0) {

        while ($row = mysqli_fetch_assoc($search_result)) {
?>

<div class="showcase">
  <div class="showcase-banner">
    <img src="./admin/upload/<?php echo $row['product_img']; ?>" class="product-img default" />
    <img src="./admin/upload/<?php echo $row['product_img']; ?>" class="product-img hover" />

    <div class="showcase-actions">
      <button class="btn-action"><ion-icon name="heart-outline"></ion-icon></button>
      <button class="btn-action"><ion-icon name="eye-outline"></ion-icon></button>
      <button class="btn-action"><ion-icon name="repeat-outline"></ion-icon></button>
      <button class="btn-action"><ion-icon name="bag-add-outline"></ion-icon></button>
    </div>
  </div>

  <div class="showcase-content">
    <a href="./viewdetail.php?id=<?php echo $row['product_id']; ?>&category=<?php echo $row['category_id']; ?>" class="showcase-category">
      <?php echo $row['product_title']; ?>
    </a>

    <a href="./viewdetail.php?id=<?php echo $row['product_id']; ?>&category=<?php echo $row['category_id']; ?>">
      <h3 class="showcase-title"><?php echo $row['product_desc']; ?></h3>
    </a>

    <div class="price-box">
      <p class="price">$<?php echo $row['discounted_price']; ?></p>
      <del>$<?php echo $row['product_price']; ?></del>
    </div>
  </div>
</div>

<?php
        }

    } else {
        echo "<h4 style='color:red'>No record found</h4>";
    }
?>
</div>

<!-- PAGINATION -->
<div class="pag-cont-search">
<div class="pagination">

<?php
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? "active" : "";
    echo "<a href='search.php?page=$i&search=" . urlencode($search_input) . "' class='$active'>$i</a>";
}
?>

</div>
</div>

<?php
} else {
    echo "<h4 style='color:red'>Please enter a search keyword</h4>";
}
?>

</div>
</div>
</div>
</div>

</main>

<?php require_once './includes/footer.php'; ?>