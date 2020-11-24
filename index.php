<?php
include("db_config.php");
include("msg_show.php");
include("card.php");
session_start();
if (!isset($_SESSION['loged_user'])) {
    //echo "Access Denied";
    header('location: login.php');
}else {
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Poli App - DASHBOARD
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
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
          <li class="active">
            <a href="index">
              <i class="nc-icon nc-bank"></i>
              <p>DASHBOARD</p>
            </a>
          </li>
          <li>
            <a href="customer">
              <i class="nc-icon nc-single-02"></i>
              <p>CUSTOMERS</p>
            </a>
          </li>
          <li class="">
            <a href="customer_loan">
              <i class="nc-icon nc-badge"></i>
              <p>Customer Loans</p>
            </a>
          </li>
          <li>
            <a href="debt_collection">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>DEBT COLLECTION</p>
            </a>
          </li>
          <li>
            <a href="cheque_transfer">
              <i class="nc-icon nc-tap-01"></i>
              <p>CHEQUE TRANSFER</p>
            </a>
          </li>
          <li>
            <a href="user">
              <i class="nc-icon nc-single-02"></i>
              <p>USER PROFILE</p>
            </a>
          </li>         
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('include/nav.php');  ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Customers</p>
                      <p class="card-title">
                        <?php
                          echo $card_1;
                        ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Available Customers
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-badge text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Loans</p>
                      <p class="card-title">
                        <?php
                          echo $card_2;
                        ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  Last day
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-tap-01 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Valid Cheques</p>
                      <p class="card-title">
                        <?php
                          echo $card_3;
                        ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  Not yet exchange
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Outstanding</p>
                    </div>
                      <p class="card-title" style="text-align:right;margin-top:6px;">
                        <?php
                          echo "<b> LKR. </b>". $card_4 ;
                          
                        ?>
                      <p>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Total cheque Amount
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-14">
              <div class="card shadow mb-7">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Loans and Debt Collection Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <!-- <canvas id="myAreaChart"></canvas> -->
                    <?php 

                        $year =  date("Y");
//                         $query="SELECT 
// /*SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC ', (month * 4) - 3, 3)AS  monthName,*/
//                         DATE_FORMAT(loan.l_date,'%m') as month,  
//                         SUM(loan.amount) AS loan, 
//                         SUM(loan_installement.installement_amt) AS debt
//                         FROM loan,loan_installement  
//                         WHERE loan.loan_no = loan_installement.loan_no AND
//                         YEAR(loan.l_date)='$year' AND YEAR(loan_installement.li_date)='$year'
//                         GROUP BY month" ;

                        $query1=mysqli_query($con,"SELECT 
                        DATE_FORMAT(l_date,'%m') as month,  
                        SUM(amount) AS loan, 
                        SUM(total_amt) AS income
                        FROM loan
                        WHERE YEAR(l_date)='$year' 
                        GROUP BY month") ;

                        $query2=mysqli_query($con,"SELECT 
                        DATE_FORMAT(li_date,'%m') as month,  
                        SUM(installement_amt+interest_amt) AS debt
                        FROM loan_installement
                        WHERE YEAR(li_date)='$year' 
                        GROUP BY month") ;

                        // get loan amount and total amount for each months
                        while($row=mysqli_fetch_array($query1)){
                          //echo $row['monthName'] . "   /   ";
                          echo $row['month'] . "   /   ";
                          echo $row['loan']. "   /   ";
                          echo $row['income'] . "</br>";

                        }
                        // get debt collection for each months
                        while($row1=mysqli_fetch_array($query2)){
                          echo $row1['month'] . "   /   ";
                          echo $row1['debt'] . "</br>";

                          //$chart_data .= "{ y:'".$row["month"]."', a:".$row["loan"].", b:".$row["debt"]."}, ";
                        }

                    ?>
                    <div id="myfirstchart" style="height: 250px;"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Calendar</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">

                  <script language="javascript" type="text/javascript">
                      var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
                      var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

                      //  DECLARE AND INITIALIZE VARIABLES
                      var Calendar = new Date();

                      var year = Calendar.getFullYear();     // Returns year
                      var month = Calendar.getMonth();    // Returns month (0-11)
                      var today = Calendar.getDate();    // Returns day (1-31)
                      var weekday = Calendar.getDay();    // Returns day (1-31)

                      var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
                      var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
                      var cal;    // Used for printing

                      Calendar.setDate(1);    // Start the calendar day at '1'
                      Calendar.setMonth(month);    // Start the calendar month at now


                      /* VARIABLES FOR FORMATTING
                      NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
                            tags to customize your caledanr's look. */

                      var TR_start = '<TR>';
                      var TR_end = '</TR>';
                      var highlight_start = '<TD WIDTH="30"><TABLE style="width: 100%;" CELLSPACING=0 BORDER=1 BGCOLOR=DEDEFF BORDERCOLOR=CCCCCC><TR><TD WIDTH=20><B><CENTER>';
                      var highlight_end   = '</CENTER></TD></TR></TABLE></B>';
                      var TD_start = '<TD WIDTH="30"><CENTER>';
                      var TD_end = '</CENTER></TD>';

                      /* BEGIN CODE FOR CALENDAR
                      NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
                      tags to customize your calendar's look.*/

                      cal =  '<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0 BORDERCOLOR=BBBBBB style="width: 100%;"><TR><TD>';
                      cal += '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 style="width: 100%;">' + TR_start;
                      cal += '<TD COLSPAN="' + DAYS_OF_WEEK + '" BGCOLOR="#EFEFEF"><CENTER><B>';
                      cal += month_of_year[month]  + '   ' + year + '</B>' + TD_end + TR_end;
                      cal += TR_start;

                      //   DO NOT EDIT BELOW THIS POINT  //

                      // LOOPS FOR EACH DAY OF WEEK
                      for(index=0; index < DAYS_OF_WEEK; index++)
                      {

                      // BOLD TODAY'S DAY OF WEEK
                      if(weekday == index)
                      cal += TD_start + '<B>' + day_of_week[index] + '</B>' + TD_end;

                      // PRINTS DAY
                      else
                      cal += TD_start + day_of_week[index] + TD_end;
                      }

                      cal += TD_end + TR_end;
                      cal += TR_start;

                      // FILL IN BLANK GAPS UNTIL TODAY'S DAY
                      for(index=0; index < Calendar.getDay(); index++)
                      cal += TD_start + '  ' + TD_end;

                      // LOOPS FOR EACH DAY IN CALENDAR
                      for(index=0; index < DAYS_OF_MONTH; index++)
                      {
                      if( Calendar.getDate() > index )
                      {
                        // RETURNS THE NEXT DAY TO PRINT
                        week_day =Calendar.getDay();

                        // START NEW ROW FOR FIRST DAY OF WEEK
                        if(week_day == 0)
                        cal += TR_start;

                        if(week_day != DAYS_OF_WEEK)
                        {

                        // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
                        var day  = Calendar.getDate();

                        // HIGHLIGHT TODAY'S DATE
                        if( today==Calendar.getDate() )
                        cal += highlight_start + day + highlight_end + TD_end;

                        // PRINTS DAY
                        else
                        cal += TD_start + day + TD_end;
                        }

                        // END ROW FOR LAST DAY OF WEEK
                        if(week_day == DAYS_OF_WEEK)
                        cal += TR_end;
                        }

                        // INCREMENTS UNTIL END OF THE MONTH
                        Calendar.setDate(Calendar.getDate()+1);

                      }// end for loop

                      cal += '</TD></TR></TABLE></TABLE>';

                      //  PRINT CALENDAR
                      document.write(cal);

                      //  End -->
                      </script>
                        <br/>
                      <div style="clear:both">
                    </div>
                    <div>
                    </div>

                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
      </div>
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <!-- <script src="assets/js/plugins/chartjs.min.js"></script> -->
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
    <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>
  <!-- chart JS -->
  <script src="assets/js/chart/chart-area-demo.js"></script>
  <!-- <script src="assets/js/chart/chart-pie-demo.js"></script> -->
  <script>

  // $(document).ready(function() {
  //   // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
  //   demo.initChartsPages();
  // });

  var data = [
    <?php echo $chart_data; ?>
  ],
  config = {
    data: data,
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['Total loans', 'Total income'],
    fillOpacity: 0.6,
    hideHover: 'auto',
    behaveLikeLine: true,
    resize: true,
    pointFillColors:['#ffffff'],
    pointStrokeColors: ['black'],
    lineColors:['gray','red']
    };

    config.element = 'myfirstchart';
    Morris.Bar(config);
    config.element = 'stacked';
    config.stacked = true;

  </script>

</body>

</html>


<?php
mysqli_close($con);
}
?>
