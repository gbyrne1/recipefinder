<?php session_start(); ?>
    <nav class="navbar is-warning" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
         
      
          <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>
      
        <div id="navbarBasicExample" class="navbar-menu">
          <div class="navbar-start">
            <a class="navbar-item" href="http://localhost/index.php">
              Home
            </a>
      
            <a class="navbar-item" href="http://localhost/html/browse.php">
              Browse
            </a>

            <a class="navbar-item" href="http://localhost/html/fridge.php">
              Fridge
            </a>
      
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link">
                More
              </a>
      
              <div class="navbar-dropdown">
                <a class="navbar-item" href="http://localhost/index.php">
                  Home
                </a>
                <a class="navbar-item" href="http://localhost/html/browse.php">
                  Browse
                </a>
                <a class="navbar-item">
                  Favorites
                </a>
                <hr class="navbar-divider">
                <a class="navbar-item">
                  Account
                </a>
              </div>
            </div>
          </div>
      
          <div class="navbar-end">
            <div class="navbar-item">
            <?php if (isset($_SESSION["email"])) { ?>
                    <div class="buttons">
                        <a class="button is-light" href="http://localhost/html/logout.php">
                            Log out
                            <span class="is-size-7 has-text-grey">(<?php echo $_SESSION["email"]; ?>)</span>
            </a>
                    </div>
                <?php } else { ?>
              <div class="buttons">
                <a class="button is-primary" href="http://localhost/html/signup.php">
                  <strong>Sign up</strong>
                </a>
                <a class="button is-light" href="http://localhost/html/login.php">
                  Log in
                </a>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </nav>