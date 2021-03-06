<?php
    include("connection.php");
	include("bts.php");

    $receiver_id = $_GET['cust_id'];
    $receiver_name = $_GET['cust_name'];
    $sender_id = 260800;
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = strval(date("Y-m-d H:i:s"));

    $scurrent_balance = fetch_current_balance($sender_id);
    $rcurrent_balance = fetch_current_balance($receiver_id);

    if(isset($_GET["cancel"])&&$_GET["cancel"]==1){
        echo"
            <script>
                Swal.fire({
                    title: '<strong>Do you really want to cancel the payment?</strong>',
                    icon: 'question',
                    showCloseButton: false,
                    showCancelButton: true,
                    focusConfirm: false,
					
                    cancelButtonText: `No`,
                    confirmButtonText: `Yes`,
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = `index.php`;
                          }
                        })
            </script>
        ";
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $amount = $_POST["amount"];

        if($amount<=0){
            echo "
                <script>
                    Swal.fire({
                        title: 'Enter the valid amount!',
                        text: '',
                        icon: 'error',
                        }); 
                </script>      
                ";
        }
		elseif($amount>$scurrent_balance) {
            echo "
                <script>
                    Swal.fire({
                        title: 'Payment failed!',
                        text: 'Insufficient Funds (Current Balance: ₹ $scurrent_balance)',
                        icon: 'error',
                        }); 
                </script>      
                ";
        }else{
           
           $sql1 = "INSERT INTO `transactions` (`date`, `sender_id`, `receiver_id`, `amount`) VALUES ('$date', $sender_id, $receiver_id, $amount)";
           $sql2 = "UPDATE `customers` SET `current_balance`= $rcurrent_balance+$amount WHERE `cust_id` = $receiver_id";
           $sql3 = "UPDATE `customers` SET `current_balance`= $scurrent_balance-$amount WHERE `cust_id` = $sender_id";

           $result1 = $conn->query($sql1);
           $result2 = $conn->query($sql2);
           $result3 = $conn->query($sql3);
       
        if($result1 && $result2 && $result3){
                echo "
                    <script>
                        Swal.fire({
                                title: 'Success!',
                                html: 'Transfered ₹$amount to $receiver_name',
                                icon: 'success',
                                showConfirmButton: true,
                                showCancelButton: true,
                                confirmButtonText: `view Transaction history`,
                                cancelButtonText: 'Back to Home page',
                                backdrop: `grey`,
                                }).then((result) => {
                                if (result.value) {
                                    window.location.href = `transaction.php`;
                                }else{
                                    window.location.href = `index.php`;
                                }
                                });
                     </script>
                    ";
            }
			else{
               echo "
                <script>
                    Swal.fire({
                        title: 'Something went wrong!!',
                        text: '',
                        icon: 'error',
                        }); 
                </script>      
                ";
				}           
        
        }
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Transfer</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
	
		<div class="topnav">
			<a href="index.php" ><img src="pf logo.png" width="50" height="50" align=right style="padding-left: 100px; padding-top: 0px;"></a>
			<a class="italic" href="customer.php">Customers</a>
			<a class="italic" href="transaction.php">Transactions</a>
			<a class="italic" href="index.php">Home</a>
			<img src="SFB logo.png" width=100 height=80 style="float: left;padding-right: 0px;padding-top: 0px;">
		</div>
		
		<div class="container">
			<p style="padding-left:100px; font-family: 'Brush Script MT', cursive; font-size: 30px; color: #0000ff;padding-top:45px;">SPARK FOUNDATION BANK</p>
			<img src="online-banking-logo.jpg" width="280" height="230" style="padding-left:100px;">
			<p style="padding-left:100px; font-family: 'Brush Script MT', cursive; font-size: 40px; color: #0000ff";>Transfer funds</p>
        </div>
		
		

        <div id="transfer" class="transfer">

            <form action="" method="POST" class="animate-bottom">

                <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&cancel=1'?>" class="btn btn-danger">Cancel the payment</a>

                <h1><b>Transfering to <?php echo "<b>".$receiver_name."</b>" ?>:</b></h1>
                <label for="amount"><h2>Enter the amount:</h2></label>
				<div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="color: #ffffff;">₹</div>    
                    </div>
                    <div class="">
                        <input type="number" name="amount" class="form-control " required><br><br>
                    </div>

                </div>
                <input type="submit" value="submit" class="btn btn-primary">
				
            </form>
        </div>
		
	</body>
</html>

<style>

body{
	background:linear-gradient(90deg,#ffffff 40%,#0000ff 60%);
}

.topnav {
	overflow: hidden;
    background-color: none;
  }
  
.topnav a {
    float: right;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 30px;
    padding-top: 20px;
  }
  
.topnav a:hover {
    background-color: none;
    color: red;
    font-size: 30px;
  }
  
.italic  {  
	font-style: italic;
  }

.container{
	float:left;
}	

.transfer{
	float: right;
	padding-right:100px;
	padding-top: 70px;
}	
.btn{
	background-color: #ffffff;
	border: none;
	color: #0000ff;
	padding: 15px 32px;
	border-radius: 30px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 20px;
	margin: 5px 1px;
	cursor: pointer;
	width: 150px;
}
h1{
	color: #ffffff;
}
h2{
	color: #ffffff;
}