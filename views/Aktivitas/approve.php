<h1 style='padding-top:25px; margin-top: 0px;'>Activity Approval</h1>
<hr>

<table>
	<form action="<?php echo Yii::$app->params['url']?>aktivitas/approveprocess" method='get'>
		<tr height="30">
			<td width='100'><label>Tanggal</label>&nbsp;</td>
			<td><label>: <?= $data['tanggal']?></label></td>
		</tr>
		<tr height="30">
			<td width='80'><label>Activity</label></td>
			<td><label>: <?= $data['judul']?></label></td>
		</tr>
		<tr height="30">
			<td><label>Creator</label></td>
			<td><label>: <?= $data->findCreator($data->creator)?></label></td>
		</tr>
		<tr height="30">
			<td colspan="2"><label>Status</label></td>
		</tr>
		<tr>
			<td colspan='2'><select class='form-control' name='statusApproval' required>
				<option></option>
				<option value='approve'><label>Approve</label></option>
				<option value='reject'><label>Reject</label></option>
			</select></td>
		</tr>
		<tr height="30">
			<td colspan='2' valign="top"><label>Notes</label></td>
		</tr>
		<tr>
			<td colspan='2' width="600"><input class='form-control' name='notes' rows='200'></td>
		</tr>		
		<input type='hidden' name='user' value='<?php echo Yii::$app->user->identity->jabatan;?>'>
		<input type='hidden' name='id' value='<?= $data['id'] ?>'>
		<input type='hidden' name='keterangan' value='<?= $data['keterangan']?>'>
		<input type='hidden' name='username' value='<?= Yii::$app->user->identity->nama;?>'>
		<input type='hidden' name='approveSP' value="<?= $data['status_approval_supervi'] ?>">
		<tr height='50'>
			
			<td width="140">
				<button type='submit'class='btn btn-success' onclick="return confirm('are you sure want to approve this activity?')">Save</button> &nbsp;
	</form>
				<a href='<?php echo Yii::$app->params['url']?>aktivitas'><button class='btn btn-default'>Back</button>
			</td><td></td>
		</tr>
</table>

<?php
	//notification
	if(isset($_GET['status'])){
		$status=$_GET['status'];
		if($status=='suksesApprove'){
			echo "<div class='alert alert-success' style='line-height:0px'>Activity Has Been Approved!</div>";
		}
		if($status=='suksesReject'){
			echo "<div class='alert alert-warning' style='line-height:0px'>Activity Has Been Rejected!</div>";
		}
		if($status=='failApprove'){
			echo "<div class='alert alert-danger' style='line-height:0px'>Activity Should Be Approved by Supervisor Before!</div>";
		}
	}
?>