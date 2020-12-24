 <div class="menu">
    <div class="navbar">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <i class="fw-icon-th-list"></i>
        </a>
        <div class="nav-collapse collapse">
            <ul class="nav">
                <li class="active border-left"><a href="#">Home</a></li>
                <?php
          if(Session::get('admin') == true){
             echo "<li><a href=\"#\">Dashboard</a></li>";
          } 
          else if(Session::get('user') == true){ 
             echo "<li><a href=\"#\">Dashboard</a></li>";
           }
        ?>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
            <div class="mini-menu">
        <label>
      <select class="selectnav">
        <option value="login.php" selected="">Home</option>
        <option value="userdashboard.php">Dashboard</option>
        <option value="howitworks.php">How It Work</option>
        <option value="about.php">About Us</option>
        <option value="contact.php">Contact Us</option>
      </select>
      </label>
      </div>
</div>