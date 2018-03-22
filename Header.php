<header>
  
  <div id="titleHeader">
    <div class="container">
      <div class="pull-right">        
      </div>
      <div id="topSearchBar">
        <form id="searchBar" class="searchBar" method="get">

        </form>
      </div>
    </div>
  </div>
   
  <div class="navbar navbar-default ">
    <div class="container">
      <nav>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" id="Gamepedia" href="Gamepedia.php">Gamepedia</a>
        </div>

        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="Gamepedia.php">Home</a></li>
            <li class="dropdown">
              <a href="#games" class="dropdown-toggle" data-toggle="dropdown">Browse Games By<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="GameList.php?page=1&name=1">Name</a></li>
                <li><a href="GameList.php?page=1&score=1">Score</a></li>
                <li><a href="GameList.php?page=1&release=1">Release</a></li>
                <li><a href="GameList.php?page=1&developer=1">Developer</a></li>
                <li><a href="GameList.php?page=1&genre=1">Genre</a></li>
              </ul>
            </li>
             <li><a href="Login.php">Admin Login</a></li>
          </ul>

          <div class="nav navbar-default navbar-right">
            <div class="col-sm-3 col-md-12">
              
              <form class="navbar-form" method="get" action="GameList.php" role="search">
                <div class="input-group">
                  <?php
                if(isset($_GET['name'])){
                 echo "<input type='hidden' name='type' value='namelook'>"; 
                }
                else if(isset($_GET['developer'])){
                 echo "<input type='hidden' name='type' value='developerlook'>";  
                }
                else if(isset($_GET['genre'])){
                 echo "<input type='hidden' name='type' value= 'genrelook'>";  
                }
                else if(!isset($_GET['name']) && !isset($_GET['developer']) && !isset($_GET['genre'])){
                 echo "<input type='hidden' name='type' value='namelook'>";    
                }
                
                
                ?>
                  <input type="text" class="form-control" placeholder="Search" name="search">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                      
                  </div>
                </div>
              </form>
            </div>
          </div>
        
        </div>
      </nav>
    </div>
  </div>

</header>