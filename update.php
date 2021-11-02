<?php
$conn = mysqli_connect("localhost","root","","invoice_system");
if(count($_POST)>0) {
mysqli_query($conn,"UPDATE invoices  
		SET invoice_status = CASE invoice_status  
		WHEN 'paid' THEN 'unpaid'  
		WHEN 'unpaid' THEN 'paid'  
		ELSE NULL
		END
		WHERE id='". $_POST['id'] . "'");


$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM invoices WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Change Invoice Status </title>
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
<form name="frmUser" method="post" action="">

</div>
<h3 font-family: sans-serif; align="center"><br><br>Are you Sure you want to change status for<br> <?php echo $row['client']; ?>?</h3>
<input type="hidden" name="id" class="txtField" value="<?php echo $row['id']; ?>">
<br><br>
<div align="center">
<input  type="submit" name="YES" value="YES" class="btn-success">
</div>
<div align="center"><?php if(isset($message)) { echo $message; } ?>

<div align="center">
<a href="index.php">Return</a>
</div>

</form>
</body>
</html>



