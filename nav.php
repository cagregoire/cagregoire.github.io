<?php
if (basename($_SERVER['PHP_SELF']) == 'index.php') {

    ?>
    <nav>
        <div class="logo">
            <h3>
                <a href="index.php">
                    <img src="pictures/cgregoirelogo.jpg" alt="CGREGOIRE" style="width:235px; height:72px; vertical-align: middle;">
                </a>
            </h3>
        </div>

        <button class="hamburger" onclick="toggleMenu()">
            <i class="fa fa-bars"></i>
        </button>
        
        <div class="links" id="links">
            <div class="dropdown">
                <button class="dropbtn">Discover Me <i class="arrow"></i></button>
                <div class="dropdown-content">
                    <a href="pages/my_vacation.php">Dream Vacation</a>
                    <a href="pages/my_artistic_self.php">Artistic Self</a>
                </div>
            </div>
            <h3><a href="pages/marketplace.php">Marketplace</a></h3>
            <h3><a href="pages/calculators.php">Calculators</a></h3>
            <h3><a href="pages/my_form.php">Casper Quiz</a></h3>
            <h3><a href="pages/login.php">To-Do List</a></h3>
        </div>
    </nav>
    <?php
} else {
    ?>
    <nav>
        <div class="logo">
            <h3>
                <a href="../index.php">
                    <img src="../pictures/cgregoirelogo.jpg" alt="CGREGOIRE" style="width:235px; height:72px; vertical-align: middle;">
                </a>
            </h3>
        </div>

        <button class="hamburger" onclick="toggleMenu()">
            <i class="fa fa-bars"></i>
        </button>

        <div class="links" id="links">
            <div class="dropdown">
                <button class="dropbtn">Discover Me <i class="arrow"></i></button>
                <div class="dropdown-content">
                    <a href="my_vacation.php">Dream Vacation</a>
                    <a href="my_artistic_self.php">Artistic Self</a>
                </div>
            </div>
            <h3><a href="marketplace.php">Marketplace</a></h3>
            <h3><a href="calculators.php">Calculators</a></h3>
            <h3><a href="my_form.php">Casper Quiz</a></h3>
            <h3><a href="login.php">To-Do List</a></h3>
        </div>
    </nav>
    <?php
}
?>

<script>
function toggleMenu() {
  var x = document.getElementById("links");
  if (x.style.display === "flex") {
    x.style.display = "none";
  } else {
    x.style.display = "flex";
    x.style.flexDirection = "column";
  }
}
</script>

