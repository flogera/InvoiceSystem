<?php  
      //analytical.php  
 if(isset($_POST["analytical"]))  
 {  
      $connect = mysqli_connect("localhost","root","","invoice_system");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Analytical.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Invoice ID', 'Company Name','Total Invoiced Amount', 'Invoiced Amount Plus Vat','Invoice Category','Invoice Category Amount','Status'));  
      $query = "select
                    a.id,
                    a.client,
                    a.invoice_amount,
                    a.invoice_amount_plus_vat,
                    b.name ,
                    b.amount ,
                    a.invoice_status
                    from invoices a
                    inner join invoice_items b on a.id = b.invoice_id 
                    order by a.id "; 
      $result = mysqli_query($connect, $query,);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  

 }  
 ?>  