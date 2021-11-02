<?php 

require_once('DB_Connection.php');

if (isset($_GET['page']))
{
  $page = $_GET['page'];

}

else
{
  $page = 1;
}

$num_per_page = 05;
$start_from = ($page-1)*05;
$query = "select * from invoices limit $start_from,$num_per_page";
$result = mysqli_query($con,$query)

?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           <title>Invoicing System </title>
           <style>
      body {

        font-family: sans-serif;
      }
      table,th,td{
            border-collapse:collapse;
            border:1px solid black;
            padding:10px;
      }
      tr:nth-child(even) {
        background-color: #dddddd;
      }
      th{
        background-color: #5c5c5c;
        color: white;
      }
    </style>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h1 align="center">PHP Invoicing System</h1>                
                <br />  
                <form method="post" action="analytical.php" align="left">
                  <input type="submit" name="analytical" value=" Analytical Customer Report CSV" class="btn btn-success" />  
                </form>
                <form method="post" action="export.php" align="left">
                  <input type="submit" name="export" value="Transactions Report CSV" class="btn btn-success" />  
                </form> 
                <form method="post" action="exportcustomer.php" align="left">
                  <input type="submit" name="exportcustomer" value="Customer Report CSV" class="btn btn-success" />  
                </form>
                <br />  
                <div class="table-responsive" id="Data-table">  
                     <table class="table  table-striped table-bordered">  
                          <tr>  
                               <th width="10%">ID</th>  
                               <th>Client</th>  
                               <th>Total Amount</th>
                               <th>Amount Plus Vat</th>  
                               <th>Vat Rate</th>  
                               <th>Status</th>
                               <th>Date</th>
                               <th>Timestamp</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?> 
                     <form method="post" action="update.php" align="left">
                          <tr>
                               <td><?php echo $row["id"]; ?></td>  
                               <td> <?php echo $row['client'] ?> </td>
                               <td> <?php echo $row['invoice_amount'] ?> </td>
                               <td> <?php echo $row['invoice_amount_plus_vat'] ?> </td>
                               <td> <?php echo $row['vat_rate'] ?> </td>
                               <td> <?php echo $row['invoice_status'] ?>
                               <a href="update.php?id=<?php echo $row["id"]; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                               <td> <?php echo $row['invoice_date'] ?> </td>
                               <td> <?php echo $row['created_at'] ?> </td>  
                          </tr> 
                         </form> 
                     <?php       
                     }  
                     ?>  
                     </table>

<?php
$pr_query = "select * from invoices ";
$pr_result = mysqli_query($con,$pr_query);
$total_record = mysqli_num_rows($pr_result );
                
$total_page = ceil($total_record/$num_per_page);

if($page>1)
{
echo "<a href='index.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
}

                
for($i=1;$i<$total_page;$i++)
{
echo "<a href='index.php?page=".$i."' class='btn btn-success'>$i</a>";
}

if($i>$page)
{
echo "<a href='index.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
}
?>

     </body>  
</html>  
