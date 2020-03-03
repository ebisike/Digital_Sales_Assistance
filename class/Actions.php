<?php
/**
* 
*/
class Actions extends DB

{
	
	public function invoice(){
		for ($i=1; $i <= 100; $i++) {
			try {
				$invoice_number = mt_rand(100000,999000);
				$this->checkIfInvoiceExist($invoice_number);
				$sql = "INSERT INTO invoice (invoice) VALUES ('$invoice_number')";
				$stmt = DB::DBInstance()->query($sql);
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}
		}
			//echo "INVOICE NUMBER GENERATED";
			return true;
	}

	public function checkIfInvoiceExist($num) {
		$sql = "SELECT invoice FROM invoice WHERE invoice = '$num'";
		$stmt = DB::DBInstance()->query($sql);

		if($stmt){
			if($stmt->ifExist()>0) {
				throw new Exception("Invoice number already exist", 1);
			}
			return true;
		}
		return false;
	}

	public function usedInvoice(){
		#get all used invoice where status=1
		$count=0;
		$sql = "SELECT * FROM order_contact";
		$stmt = DB::DBInstance()->query($sql);
		if($stmt->ifExist()>0){
			while ($data=$stmt->getResults()) {
				if($data['payment_status']){
					echo '
						<tr>
							<td>'.++$count.'</td>
							<td><a href="order.php?var='.$data['invoice'].'">'.$data['invoice'].'</a></td>
							<td>'.$data['customer_name'].'</td>
							<td>full payment</td>
							<td>'.$data['order_date'].'</td>
						</tr>
					';
				}else{
					echo '
						<tr>
							<td>'.++$count.'</td>
							<td><a href="order.php?var='.$data['invoice'].'">'.$data['invoice'].'</a></td>
							<td>'.$data['customer_name'].'</td>
							<td><a data-toggle="modal" href="#" data-target="#updatepay">part payment</a></td>
							<td>'.$data['order_date'].'</td>
						</tr>
					';
				}
			}
		}else{
			echo "<script>alert('No Sales History yet')</script>";
		}
	}

	public function getOrders($invoice,$num){
		//get all the order related to a particular invoice number

		switch ($num) {
			case '1':
				$count=0;
				$sql = "SELECT * FROM orders WHERE invoice='$invoice'";
				$stmt = DB::DBInstance()->query($sql);
				if($stmt){
					while ($data=$stmt->getResults()) {
						echo '
							<tr>
								<td>'.++$count.'</td>
								<td>'.$data['product_type'].'</td>
								<td>'.$data['description'].'</td>
								<td>'.$data['size'].'</td>
								<td>'.$data['quantity'].'</td>
								<td>'.$data['cost'].'</td>
								<td>'.$data['cobbler_cost'].'</td>
								<td>'.$data['cobbler_price'].'</td>
								<td>'.$data['company_price'].'</td>
								<td><a href="order.php?del='.$data['id'].'&invoice='.$data['invoice'].'">x</a></td>
							</tr>
						';
					}
					return true;
				}
				break;

			case '2':
				$sql = "SELECT * FROM orders WHERE invoice='$invoice'";
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

	public function getOrderContact($num) {
		$sql = "SELECT * FROM order_contact WHERE invoice='$num'";
		$runsql = DB::DBInstance()->query($sql);
		if($runsql){
			return $data=$runsql->getResults();
		}
	}

	public function getProfit($num){
		switch ($num) {
			case '1':
				# get the total amount for any money paid
				$sql = "SELECT SUM(amount_paid) AS price2 FROM order_contact";
				$stmt = DB::DBInstance()->query($sql);
				if($stmt){
					$data=$stmt->getResults();
					return $data;
				}
				break;

			case '2':
				# get the total amount for full payments made
				$sql = "SELECT SUM(amount_paid) AS price2, SUM(cobbler_price) AS price1 FROM order_contact WHERE payment_status=1";
				$stmt = DB::DBInstance()->query($sql);
				if($stmt){
					$data=$stmt->getResults();
					return $data;
				}
				break;
		}

	}

	public function countInvoice($state){
		switch ($state) {
			case '1':
				$sql = "SELECT COUNT(invoice) as used FROM invoice WHERE status=1";
				$stmt = DB::DBInstance()->query($sql);
				if($stmt){
					$data=$stmt->getResults();
					return $data;
				}
				break;

			case '2':
				$sql = "SELECT COUNT(invoice) as used FROM invoice WHERE status=0";
				$stmt = DB::DBInstance()->query($sql);
				if($stmt){
					$data=$stmt->getResults();
					return $data;
				}
				break;
			
			default:
					
				break;
		}
	}
}