<?php
function paid_amt() {
       var loan_amt = document.getElementById('l_amt').value;
       var interest = document.getElementById('interest').value;
       if (loan_amt == "")
           txtFirstNumberValue = 0;
       if (interest == "")
           txtSecondNumberValue = 0;

       var result = (parsedouble(loan_amt) + (parsedouble(loan_amt) * parsedouble(interest/100)));
       if (!isNaN(result)) {
           document.getElementById('p_amt').value = result;
       }
   }
?>