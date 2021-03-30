    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          POLY APP
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li 
            <?php if (basename($_SERVER['PHP_SELF'])=='index.php')
            {
             echo 'class="active"';
            } else 
            {
             echo 'class=""'; 
            } 
            ?>
            >
            <a href="index">
              <i class="nc-icon nc-bank"></i>
              <p>DASHBOARD</p>
            </a>
          </li>


          <li 
            <?php if (basename($_SERVER['PHP_SELF'])=='customer.php')
            {
             echo 'class="active"';
            } else 
            {
             echo 'class=""'; 
            } 
            ?>
            >
            <a href="customer">
              <i class="nc-icon nc-single-02"></i>
              <p>CUSTOMERS</p>
            </a>
          </li>

          <li 
            <?php if (basename($_SERVER['PHP_SELF'])=='customer_loan.php')
            {
             echo 'class="active"';
            } else 
            {
             echo 'class=""'; 
            } 
            ?>
            >
            <a href="customer_loan">
              <i class="nc-icon nc-badge"></i>
              <p>CUSTOMER LOANS</p>
            </a>
          </li>

          <li 
            <?php if (basename($_SERVER['PHP_SELF'])=='debt_collection.php')
            {
             echo 'class="active"';
            } else 
            {
             echo 'class=""'; 
            } 
            ?>
            >
            <a href="debt_collection">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>DEBT COLLECTION</p>
            </a>
          </li>

           <li 
            <?php 
             if (basename($_SERVER['PHP_SELF'])=='cheque_transfer.php')
             {
              echo 'class="active"';
             } else 
             {
              echo 'class=""'; 
             } 
            ?>
            > 
            <a href="cheque_transfer">
              <i class="nc-icon nc-tap-01"></i>
              <p>CHEQUE TRANSFER</p>
            </a>
          </li> 

          <li 
            <?php if (basename($_SERVER['PHP_SELF'])=='report.php')
            {
             echo 'class="active"';
            } else 
            {
             echo 'class=""'; 
            } 
            ?>
            >
            <a href="report">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>CUSTOMER HISTORY</p>
            </a>
          </li>

          <li 
            <?php if (basename($_SERVER['PHP_SELF'])=='income.php')
            {
             echo 'class="active"';
            } else 
            {
             echo 'class=""'; 
            } 
            ?>
            >
            <!-- <a href="#">
              <i class="nc-icon nc-tap-01"></i>
              <p>Income Report</p>
            </a> -->
          </li>

          <li 
            <?php if (basename($_SERVER['PHP_SELF'])=='user.php')
            {
             echo 'class="active"';
            } else 
            {
             echo 'class=""'; 
            } 
            ?>
            >
            <a href="user">
              <i class="nc-icon nc-single-02"></i>
              <p>USER PROFILE</p>
            </a>
          </li>         
        </ul>
      </div>
    </div>
