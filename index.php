<?php
// Connection with database
$conn = mysqli_connect('localhost', 'Debabrata', 'test12345', 'ninja_pizzas');

if (!$conn) {
  echo 'Connection error' . mysqli_connect_error();
}

// Write query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizzas';

// Make query and get result
$result = mysqli_query($conn, $sql);

// Fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

$ingredients = $pizzas[0]['ingredients'];

// Free result from memory
mysqli_free_result($result);

// Close the commection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<!-- Include Header -->
<?php include('./templates/header.php'); ?>

<h4 class="center grey-tet">Pizzas</h4>

<div class="container">
  <div class="row">
    <?php foreach ($pizzas as $pizza) : ?>

      <div class="col s6 m3">
        <div class="card z-depth-0">
          <div class="card-content center">
            <h6> <?php echo htmlspecialchars($pizza['title']); ?> </h6>
            <div>
              <ul>
                <?php foreach (explode(',', $pizza['ingredients']) as $ing) : ?>
                  <li> <?php echo htmlspecialchars($ing) ?> </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="card-action right-align">
            <a href="javascript:void(0);" class="brand-text">more info</a>
          </div>
        </div>
      </div>

    <?php endforeach; ?>
  </div>
</div>

<!-- Include Footer -->
<?php include('./templates/footer.php'); ?>


</html>