<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="col-sm-2" ></div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <!--<a class="navbar-brand" style="color:yellow;font-family:cursive;" href="index.php">e-Voting</a>-->
            <?php
                if (isset($_SESSION['utype']))
                {
                    echo "<a class='navbar-brand' style='color:yellow;font-family:cursive;' href='index2.php'>e-Voting</a>";
                }
                else
                {
                    echo "<a class='navbar-brand' style='color:yellow;font-family:cursive;' href='index.php'>e-Voting</a>";
                }
                ?>
            <label style='padding:20px; color:tomato; font-family:cursive'>
                <?php
                if (isset($_SESSION['uname'])) {
                    echo "Welcome " . $_SESSION['uname'];
                }
                ?>
            </label>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <!--<li class="active"><a href="index.php">Home</a></li>-->
                <?php
                if (isset($_SESSION['utype']))
                {
                    echo "<li class='active'><a href='index2.php'>Home</a></li>";
                }
                else
                {
                    echo "<li class='active'><a href='index.php'>Home</a></li>";
                }
                ?>
                

                <?php
                if (isset($_SESSION['utype'])) {
                    echo "<li class='active'><a href='vote.php'>Vote</a></li>";
                    if ($_SESSION['utype'] == 'admin') {
                        echo "<li class='active' class='dropdown'>";
                        echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Admin <span class='caret'></span></a>";
                        echo "<ul class='dropdown-menu'>";
                        echo "<li><a href='Category_list.php'>Category List</a></li>";
                        echo "<li><a href='Voting_list.php'>Voting List</a></li>";
                        echo "<li><a href='Users.php'>Users</a></li>";
                        echo "<li><a href='New_voter.php'>Add New Voter</a></li>";
                        echo "</ul>";
                        echo "</li>";
                    }
                }
                ?>

                <li class="active"><a href="Result.php">View Result</a>
                </li>
                <?php
                if (isset($_SESSION['uname'])) {
                    echo "<li class='active'><a href='logout.php' onclick='return confirm(\"Are you sure to log out?\")'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
