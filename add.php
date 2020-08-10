<?php
// Get request
// if (isset($_GET['submit'])) {
//   echo $_GET['email'];
//   echo $_GET['title'];
//   echo $_GET['ingredients'];
// }

// Post request
// if (isset($_POST['submit'])) {
//   echo $_POST['email'];
//   echo $_POST['title'];
//   echo $_POST['ingredients'];
// }

// Saving from XSS attack
// if (isset($_POST['submit'])) {
//   echo htmlspecialchars($_POST['email']);
//   echo htmlspecialchars($_POST['title']);
//   echo htmlspecialchars($_POST['ingredients']);
// }

$errors = ['email' => '', 'title' => '', 'ingredients' => ''];
$email = $title = $ingredients = '';

print_r(array_filter($errors));
// Validation 
if (isset($_POST['submit'])) {
  // Check email
  if (empty($_POST['email'])) {
    $errors['email'] = "An email is required <br/>";
  } else {
    // echo htmlspecialchars($_POST['email']) . '<br/>';
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email must be valid <br/>";
    }
  }

  // Check title
  if (empty($_POST['title'])) {
    $errors['title'] =  "A title is required <br/>";
  } else {
    // echo htmlspecialchars($_POST['title']) . '<br/>';
    $title = $_POST['title'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
      $errors['title'] =  'Title must be letters and spaces only <br/>';
    }
  }

  // Check Ingredients
  if (empty($_POST['ingredients'])) {
    $errors['ingredients'] =  "Atleast one ingedient is required <br/>";
  } else {
    // echo htmlspecialchars($_POST['ingredients']) . '<br/>';
    $ingredients = $_POST['ingredients'];
    if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
      $errors['ingredients'] =  'Ingredients must be a comma separated list <br/>';
    }
  }

  // Redirecting to index page if no errors
  if (!array_filter($errors)) {
    // echo "There are error <br />";
    header('Location: index.php');
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<!-- Include Header -->
<?php include('./templates/header.php'); ?>


<section class="container grey-text">
  <h4 class="center">Add pizza</h4>
  <form class="white" action="add.php" method="POST">
    <div class="input-field">
      <input type="text" class="" placeholder="Type email..." value="<?php echo htmlspecialchars($email)  ?>" name="email">
      <label>Your Email:</label>
      <span class="helper-text red-text"><?php echo $errors['email']; ?></span>
    </div>
    <div class="input-field">
      <input type="text" class="" placeholder="Type pizza title..." value="<?php echo htmlspecialchars($title) ?>" name="title">
      <label>Pizza title:</label>
      <span class="helper-text red-text"><?php echo $errors['title']; ?></span>
    </div>
    <div class="input-field">
      <input type="text" class="" placeholder="Type ingredients..." value="<?php echo htmlspecialchars($ingredients)  ?>" name="ingredients">
      <label>Ingredients (comma separated):</label>
      <span class="helper-text red-text"><?php echo $errors['ingredients']; ?></span>
    </div>
    <div class="center">
      <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
    </div>
  </form>

</section>


<!-- Include Footer -->
<?php include('./templates/footer.php'); ?>


</html>