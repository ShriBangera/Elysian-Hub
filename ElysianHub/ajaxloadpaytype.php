<?php
if($_GET['paytype']=="cashondelivery")
{
?>
<span style="visibility: hidden;" id="idPaymenttype"></span>
<span  style="visibility: hidden;"   id="idCardNumber"></span>
<span  style="visibility: hidden;"   id="idExpirydate"></span>
<span  style="visibility: hidden;"   id="idCVVnumber"></span>
<input type="hidden" name="Paymenttype" value=" ">
<input type="hidden" name="CardNumber" value=" ">
<input type="hidden" name="Expirydate" value=" ">
<input type="hidden" name="CVVnumber" value=" ">
						<table class="table">							
							<tr>
								<td>
					<br>
					<center><label class="control-label"><b>Cash on Delivery opted</b></label></center>
								</td>
								<td>
									
								</td>
							</tr>
				
						</table>
<?php
}
else
{
?>

						<table class="table">
							<tr>
								<td>
			<div class="control-group">
				<label class="control-label">Payment type: <span class="errmsg" id="idPaymenttype"></span></label>
				<div class="controls">
					<select  class="form-control" name="Paymenttype">
					<option value=''>Select Payment type</option>				
					<?php
						$arr = array("VISA","Master Card","Rupay","American Express");
						foreach($arr as $val)
						{
							echo "<option value='$val'>$val</option>";
						}
						?>
					</select>
				</div>
			</div>	
								</td>
							    </tr>
							    <tr>
								<td>
								
			<div class="control-group">
					<label class="control-label">Card Number: <span class="errmsg" id="idCardNumber"></span></label>
					<div class="controls">
					<input type="number" name="CardNumber" placeholder="Card Number" class="form-control" value="">
					</div>
			</div>							
								</td>
							    </tr>
				
							<tr>
								<td>
			<div class="control-group">
				<label class="control-label">Expiry date: <span class="errmsg" id="idExpirydate"></span></label>
				<div class="controls">
					<input type="month" min="<?php echo date("Y-m"); ?>" name="Expirydate" placeholder="Expiry date" class="form-control" >
				</div>
			</div>	
								</td>
							    </tr>
							    <tr>
								<td>
								
			<div class="control-group">
					<label class="control-label">Card holder: <span class="errmsg" id="idCardholder"></span></label>
					<div class="controls">
					<input type="text" name="Cardholder" placeholder="Card Holder Name" class="form-control" value="">
					</div>
			</div>							
								</td>
							</tr>
													<tr>
								<td>
					
					<label class="control-label">CVV Number: <span class="errmsg" id="idCVVnumber"></span></label>
					<div class="controls">
					<input type="number" name="CVVnumber" placeholder="CVV Number" class="form-control" >
					</div>
								</td>
							</tr>
							<tr>
								<td>
									
								</td>
							</tr>
				
						</table>
<?php
}
?>
