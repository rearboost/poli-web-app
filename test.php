
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php




?>


<script>

$(document).ready(function(){

    dt = new Date();
    console.log(add_months(dt, 2).toString());  

    // dt = new Date(2014,10,2);
    // console.log(add_months(dt, 10).toString());
 
});

function add_months(dt, n) 
 {

   return new Date(dt.setMonth(dt.getMonth() + n));      
 }

</script>