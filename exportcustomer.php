<?php  
      //exportcustomer.php  
 if(isset($_POST["exportcustomer"]))  
 {  
      $connect = mysqli_connect("localhost","root","","invoice_system");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Customers.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Company Name', 'Total Invoiced Amount', 'Total Amount Paid','Total Amount Outstanding'));  
      $query = "select 
                  a.client, 
                  a.invoice_amount, 
                  CASE
                      WHEN a.invoice_status ='paid'THEN a.invoice_amount
                      ELSE '0'
                  END    as total_amount_paid,
                  CASE
                      WHEN a.invoice_status ='unpaid'THEN a.invoice_amount
                      ELSE '0'
                  END as total_amount_outstanding

                  from invoices a
                  order by a.id  "; 
      $result = mysqli_query($connect, $query,);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  

 }  
 ?>  