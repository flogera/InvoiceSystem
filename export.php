<?php  
      //export.php  
 if(isset($_POST["export"]))  
 {  
      $connect = mysqli_connect("localhost","root","","invoice_system");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=transactions.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Invoice ID', 'Company Name', 'Invoice Amount'));  
      $query = "SELECT id,client,invoice_amount from invoices ORDER BY id "; 
      $result = mysqli_query($connect, $query,);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  

 }  
 ?>  