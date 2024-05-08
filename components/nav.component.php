<nav>
    <div> <?= (isset($_SESSION['uname'])) ? "User: ".$_SESSION['uname'] : null;?></div>
    <div class="nav">
        <?php if (!$auth->loggedin()) {  ?>

            <button class="btn btn-nav" onclick="displayLogin()">Login</button>

        <?php } else { ?>
            
            <a class="btn btn-nav" href="index.php">Home</a>
            
            <div class="dropdown">
            <button class="btn btn-nav">Dataset Management</button>

            <div class="content">
                <!-- <a class="btn btn-nav" href="index.php">Add dataset</a>
                <a class="btn btn-nav" href="">Train model</a> -->
                <button class="btn btn-nav" onclick="displayUploadCSV()">Upload CSV file</button>
                <a class="btn btn-nav" href="uploads.php">View uploads</a>
            </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-nav">User Management</button>

                <div class="content">
                    <button class="btn btn-nav" onclick="displayAddUsers()">Add new user</button>
                    <a class="btn btn-nav" href="user_management.php">View users</a>
                </div>
            </div>
            
            <a class="btn btn-nav" href="includes/logout.include.php">Logout</a>

        <?php } ?>
    </div>
</nav>