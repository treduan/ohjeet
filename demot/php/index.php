<?php
require "header.php";
require "content.php";
 if (isset($_GET['form_submitted'])): ?>
    <?php
        if(isset($_GET['name'], $_GET['age'])){
            $name = htmlspecialchars($_GET['name']);
            $age = htmlspecialchars($_GET['age']);
            echo "How are you,  $name? ", "You are $age years old.";
        } else {
            echo "You cannot leave fields empty.";
        }
    ?>
<?php else: ?>
    <h3>Enter your information</h3>
    <form action="index.php" method="get">
    <label for="name">First name: </label> 
    <input type="text" name="name" id="name" maxlength=30><br>
    <label for="age">Age:</label>
    <input type="number" name="age" id="age"><br>
    <input type="submit" value="Send">
    <input type="hidden" name="form_submitted" value="1" />
    </form>
<?php endif; ?>
<?php
require "footer.php";
?>