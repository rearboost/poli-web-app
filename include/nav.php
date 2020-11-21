<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
        <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <a class="navbar-brand" href="javascript:;">Dashboard</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
        
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="notification">
                <i class="nc-icon nc-bell-55"></i>
                <h6 style='color:red;'>
                <?php
                if($numRows>0){
                    echo " " . $numRows . " NEW ";
                }
                ?>
                </h6>
            </a>
            </li>
            <li class="nav-item">
            Loged as <?php echo $_SESSION['loged_user'] ?>&nbsp; 
            <a href="#" onclick="confirmationLogout(event)" class="btn btn-danger square-btn-adjust">Logout</a> 
            </li>
        </ul>
        </div>
    </div>
</nav>

<script>

    // logout confirmation javascript
  function confirmationLogout(e) {

        swal({
        title: "Are you sure?",
        text: "Want to logout !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "logout";
            } 
        });
    }

</script>