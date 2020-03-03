<?php

/**
* 
*/
class Sales extends DB
{
	
	public function getInvoice($val) {
		$sql = "SELECT * FROM invoice WHERE status=0 LIMIT 1";
		$stmt = DB::DBInstance()->query($sql);

			if($stmt->ifExist()>0){
				$result = $stmt->getResults();
				$invoice = $result['invoice'];
				if ($this->updateInvoiceStatus($invoice,$val)){
					$this->setOrderContact($val,$invoice);
					$this->setCartValues($val,$invoice,1);
					return $result;
				}else{
					return false;
				}
			}else{
				echo "<script>alert('No Invoice available')</script>";
			}
	}

	public function setOrderContact($values,$invoice){
		$customer_name = $values['name'];
		$amt_paid = $values['amt_paid'];
		$payStat = $values['payment_status'];
		$location = $values['location'];
		$today = date('d-M-Y');
		if($payStat){
			$payStat = 1;
		}else{
			$payStat = 0;
		}

		$sql = "INSERT INTO order_contact (invoice,customer_name,location,amount_paid,payment_status,order_date) VALUES ('$invoice','$customer_name','$location','$amt_paid','$payStat','$today')";
		$stmt = DB::DBInstance()->query($sql);
		if($stmt){
			return true;
		}else{
			return false;
		}
	}

	public function setCartValues($val,$invoice,$action){
		#$action = [1,2];
		# 1  = setting all SESSION variables for the cart
		# 2 = unsetting all SESSION variables for the cart
		switch ($action) {
			case '1':
				$_SESSION['invoice'] = $invoice;
		        $_SESSION['customer'] = $val['name'];
		        $_SESSION['amt_paid'] = $val['amt_paid'];
		        $_SESSION['payment_status'] = $val['payment_status'];
		        $_SESSION['location'] = $val['location'];
				break;
			case '2':
				unset($_SESSION['invoice']);
		        unset($_SESSION['customer']);
		        unset($_SESSION['amt_paid']);
		        unset($_SESSION['payment_status']);
		        unset($_SESSION['location']);
		        unset($_SESSION['invoice_id']);
				break;
			
			default:
				# code...
				break;
		}
	}

	public function updateInvoiceStatus($val,$name) {
		$today = date('d-M-Y');
		$name = $name['name'];
		$sql = "UPDATE invoice SET status=1, date_gotten='$today', customer_name='$name' WHERE invoice='$val'";
		$stmt = DB::DBInstance()->query($sql);
		if($stmt) {
			//echo "UPDATED";
			return true;
		}
		return false;
	}

	public function getCartRecords($num){
		# $num is representing the case we are considering.
		// case 1: is to get cart items while shopping
		// case 2: is to  get cart records while checking out.
		switch ($num) {
			case '1':
				$sql = "SELECT * FROM orders WHERE invoice='{$_SESSION['invoice']}'";
				$stmt = DB::DBInstance()->query($sql); 
				$count=0;
				if($stmt->ifExist()>0){
					while ($result=$stmt->getResults()) {
						echo '<tr>                 
				           <td>'.++$count.'</td>
				           <td>'.$result['product_type'].'</td>
				           <td>'.$result['description'].'</td>
				           <td>'.$result['size'].'</td>
				           <td>'.$result['quantity'].'</td>
				           <td>'.$result['cost'].'</td>
				           <td>'.$result['cobbler_cost'].'</td>
				           <td>'.$result['cobbler_price'].'</td>
				           <td>'.$result['company_price'].'</td>
				           <td><a href="cart.php?var='.$result['id'].'">x</a></td>
				          </tr>';
					}
				}else{
					echo '<h4 class="text-danger">No items in this cart yet</h4>';
				}
				break;

			case '2':
				$sql = "SELECT * FROM orders WHERE invoice='{$_SESSION['invoice']}'";
				$stmt = DB::DBInstance()->query($sql); 
				$count=1;
				if($stmt->ifExist()>0){
					while ($result=$stmt->getResults()) {
						echo '<tr>                 
				           <td>'.$count++.'</td>
				           <td>'.$result['product_type'].'</td>
				           <td>'.$result['description'].'</td>
				           <td>'.$result['size'].'</td>
				           <td>'.$result['quantity'].'</td>
				           <td>'.$result['cost'].'</td>
				          </tr>';
					}
				}else{
					echo '<h4 class="text-danger">No items in this cart yet</h4>';
				}
				break;
			
			default:
				# code...
				break;
		}
	}
	public function addItems($values,$case){
		switch ($case) {
			case '1':
				$product = strtoupper($values['product']);
				$size = $values['size'];
				$price1 = $values['price1'];
				$price2 = $values['price2'];
				$desc = $values['desc'];
				$qty = $values['qty'];
				$cost = $price2 * $qty;
				$cobbler_cost = $price1 * $qty;
				//$bal = $this->getTotalCost() - $_SESSION['amt_paid'];

				//post to orders table
				$sql = "INSERT INTO orders (invoice,product_type,description,size,cobbler_price,company_price,quantity,cost,cobbler_cost) VALUES ('{$_SESSION['invoice']}','$product','$desc','$size','$price1','$price2','$qty','$cost','$cobbler_cost')";
				$stmt = DB::DBInstance()->query($sql);
				if($stmt){
					$prev_cobbler_cost=$this->getTotalCost(2,$_SESSION['invoice']);
					$new_cobbler_cost += $prev_cobbler_cost['cost1'];
					$sql = "UPDATE order_contact SET cobbler_price='$new_cobbler_cost' WHERE invoice='{$_SESSION['invoice']}'";
					$stmt = DB::DBInstance()->query($sql);
					if($stmt){
						return true;
					}
				}
				break;

			case '2':
				$invoice = $values['invoice'];
				$product = strtoupper($values['product']);
				$size = $values['size'];
				$price1 = $values['price1'];
				$price2 = $values['price2'];
				$desc = $values['desc'];
				$qty = $values['qty'];
				$cost = $price2 * $qty;
				$cobbler_cost = $price1 * $qty;
				//$bal = $this->getTotalCost() - $_SESSION['amt_paid'];

				//post to orders table
				$sql = "INSERT INTO orders (invoice,product_type,description,size,cobbler_price,company_price,quantity,cost,cobbler_cost) VALUES ('$invoice','$product','$desc','$size','$price1','$price2','$qty','$cost','$cobbler_cost')";
				$stmt = DB::DBInstance()->query($sql);
				if($stmt){
					$cost=$this->getTotalCost(2,$invoice);
					$bal=$this->getBalance($invoice);
					$cobbler_cost += $bal['cobbler_price'];
					if($cost['cost2'] > $bal['amount_paid']){
						$sql = "UPDATE order_contact SET payment_status=0, cobbler_price='$cobbler_cost' WHERE invoice='$invoice'";
						$stmt = DB::DBInstance()->query($sql);
						return true;
					}else{
						return false;
					}
				}
				break;
			
			default:
				# code...
				break;
		}
	}

	public function getTotalCost($num,$invoice){
		#$num implies the case
		#1 -> get total cost for invoice
		#2 -> get total cost from customer records
		$sum = 0;
		switch ($num) {
			case '1':
				$sql = "SELECT cost FROM orders WHERE invoice='{$_SESSION['invoice']}'";
				$runsql = DB::DBInstance()->query($sql);
				if($runsql->ifExist()>0){
					while ($data=$runsql->getResults()) {
						$sum += $data['cost'];
					}
					return $sum;
				}
				break;
			case '2':
				$sql = "SELECT SUM(cost) AS cost2, SUM(cobbler_cost) AS cost1 FROM orders WHERE invoice='$invoice'";
				$runsql = DB::DBInstance()->query($sql);
				if($runsql->ifExist()>0){
					
					return $data=$runsql->getResults();
				}
				break;
			
			default:
				# code...
				break;
		}
	}

	public function deleteItem($item,$invoice){
		$sql = "SELECT * FROM orders WHERE id='$item'";
		$runsql = DB::DBInstance()->query($sql);
		$data=$runsql->getResults();
		$sql = "DELETE FROM orders WHERE id='$item'";
		$stmt = DB::DBInstance()->query($sql);
		if($stmt){
			$cost = $this->getTotalCost(2,$invoice);
			$bal = $this->getBalance($invoice);
			$cobbler_cost = $bal['cobbler_price'] - $data['cobbler_cost'];
			if($cost['cost2'] > $bal['amount_paid'] || $cost['cost2'] < $bal['amount_paid']){
				$sql = "UPDATE order_contact SET payment_status=0, cobbler_price='$cobbler_cost' WHERE invoice='$invoice'";
				$stmt = DB::DBInstance()->query($sql);
			}else{
				$sql = "UPDATE order_contact SET payment_status=1, cobbler_price='$cobbler_cost' WHERE invoice='$invoice'";
				$stmt = DB::DBInstance()->query($sql);
			}
			return true;
		}
	}

	public function countItem($invoice){
		$sql = "SELECT * FROM orders WHERE invoice='$invoice'";
		$stmt = DB::DBInstance()->query($sql);
		if($stmt->ifExist()>0){
			return true;
		}else{
			$sql = "DELETE FROM order_contact WHERE invoice='$invoice'";
			$stmt = DB::DBInstance()->query($sql);
			if($stmt){
				$this->deleteInvoice($invoice);
				header("Location: records.php");
				echo "<h3>You have deleted all itmes in this invoice slip</h3>";
				return true;
			}
		}
	}

	public function deleteInvoice($num){
		$sql = "DELETE FROM invoice WHERE invoice='$num'";
		$stmt = DB::DBInstance()->query($sql);
		if($stmt){
			return true;
		}
	}

	public function updatePay($values){
		$bal = $values['pay'];
		$invoice = $values['invoice'];
		$cost = $this->getTotalCost(2,$invoice);

		// check if balance deposited is greater than the total cost. if it is, return false. else excute the remaing code.
			if($prev_bal = $this->getBalance($invoice)){
				if(!($cost['cost2'] == $prev_bal['amount_paid'])){
					$bal += $prev_bal['amount_paid']; //adds the new amount to the previous amount

					if($bal > $cost['cost2']){
						echo "<script>alert('The amount entered is greater than total cost (".$cost['cost2'].")')</script>";
						return false;
					}
					elseif($bal == $cost['cost2']){
						$sql = "UPDATE order_contact SET payment_status=1, amount_paid='$bal' WHERE invoice='$invoice'";
						$stmt = DB::DBInstance()->query($sql);
						echo "<script>alert('The complete amount has been deposited')</script>";
						return true;

					}else{
						$sql = "UPDATE order_contact SET amount_paid='$bal' WHERE invoice='$invoice'";
						$stmt = DB::DBInstance()->query($sql);
						echo "<script>alert('This is still part payment!')</script>";
						return true;
					}
				}else{
					echo "<script>alert('All payments has been made for this invoice')</script>";
				}

		}else{
			echo "<script>alert('Invalid Invoice Number!')</script>";
		}
	}
	
	// public function getCobblerPrice($invoice){
	// 	$sql = "SELECT SUM(cobbler_cost) AS cobbler FROM orders WHERE invoice='$invoice'";
	// 	$stmt = DB::DBInstance()->query($sql);
	// 	if($stmt){
	// 		$data=$stmt->getResults();
	// 		return $data;
	// 	}
	// }

	public function getBalance($num){
		$sql = "SELECT * FROM order_contact WHERE invoice='$num'";
		$runsql = DB::DBInstance()->query($sql);
		if($runsql->ifExist()>0){
			$data=$runsql->getResults();
			return $data;
		}else{
			return false;
		}
	}
}