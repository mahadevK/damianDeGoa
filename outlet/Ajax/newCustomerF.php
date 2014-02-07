<?php
	$msg  = '';
	$msg .=	'<div class="thumbnail">
				<div class="widget-content">
					<table style="color:#000000;width:700px;border:0px solid black;>
							<tr height="30px"><td><span style="color:red;" id="sucessMsg"></span></td></tr>
							<tr>
								<td style="width:15%;padding:5px;">Name<span style="color:red">*</span></td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:35%;padding:5px;"><input type="text" name="name" id="name" style="width:291px"></td>
							</tr>
							<tr>
								<td style="width:15%;padding:5px;">Email Id</td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:35%;padding:5px;"><input type="text" name="emailId" id="emailId" style="width:291px"></td>
							</tr>
							<tr>
								<td style="width:15%;padding:5px;">Contact No.<span style="color:red">*</span></td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:35%;padding:5px;"><input type="text" name="contactNo" id="contactNo" style="width:291px"></td>
							</tr>
							<tr>
								<td style="width:15%;padding:5px;">Address<span style="color:red">*</span></td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:35%;padding:5px;"><textarea type="text" name="address" id="address" style="width:291px"></textarea></td>
							</tr>
							<tr>
								<td style="width:15%;padding:5px;">Country</td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:35%;padding:5px;">
									<!--<select onchange="print_state("state",this.selectedIndex)" id="country" name ="country" style="width:306px"></select>-->
									<select id="country" name ="country" style="width:306px">
										<option value="India">India</option>
									<select>
								</td>
							</tr>
							<tr>	
								<td style="width:15%;padding:5px;">State<span style="color:red">*</span></td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:35%;padding:5px;">
									<!--<select name ="state" id ="state" style="width:306px"></select>-->
									<select id="state" name ="state" style="width:306px">
										<option value="Goa">Goa</option>
									<select>
								</td>
							</tr>
							<tr>	
								<td style="width:15%;padding:5px;">City<span style="color:red">*</span></td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:5%;padding:5px;"><input type="text" name="city" id="city" style="width:291px" /></td>
							</tr>
							<tr>
								<td style="width:15%;padding:5px;">Pin Code</td>
								<td style="width:5%;padding:5px;">:</td>
								<td style="width:35%;padding:5px;"><input type="text" name="pinCode" id="pinCode" style="width:291px"></td>
							</tr>
							<tr height="25px;"></tr>
							<tr>
								<td colspan="3" align="center">
									<input type="submit" name="submit" id="submit" value="Submit" onclick="return validateCustomer()">&nbsp;&nbsp;&nbsp; 
									<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
									<input type="hidden" name="customerId" id="customerId" />
								</td>
							</tr>
						</table>
					</div>
				</form>
				<div class="widget-footer"></div>
			</div>';
	echo $msg;