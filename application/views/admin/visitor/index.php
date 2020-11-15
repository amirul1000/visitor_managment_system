<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Visitor'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/visitor/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/visitor/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/visitor/search/',array("class"=>"form-horizontal")); ?>
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>
<!--End of Action//--> 
   
<!--Data display of visitor-->       
<table class="table table-striped table-bordered">
    <tr>
		<th>Visitor Name</th>
<th>Visitor Email</th>
<th>Visitor Mobile No</th>
<th>File Picture</th>
<th>Visitor Address</th>
<th>Meet Person Name</th>
<th>Department</th>
<th>Reason To Meet</th>
<th>Visitor Enter Time</th>
<th>Visitor Outing Remark</th>
<th>Out Time</th>
<th>Visitor Status</th>

		<th>Actions</th>
    </tr>
	<?php foreach($visitor as $c){ ?>
    <tr>
		<td><?php echo $c['visitor_name']; ?></td>
<td><?php echo $c['visitor_email']; ?></td>
<td><?php echo $c['visitor_mobile_no']; ?></td>
<td><?php
											if(is_file(APPPATH.'../public/'.$c['file_picture'])&&file_exists(APPPATH.'../public/'.$c['file_picture']))
											{
										 ?>
										  <img src="<?php echo base_url().'public/'.$c['file_picture']?>" class="picture_50x50">
										  <?php
											}
											else
											{
										?>
										<img src="<?php echo base_url()?>public/uploads/no_image.jpg" class="picture_50x50">
										<?php		
											}
										  ?>	
										</td>
<td><?php echo $c['visitor_address']; ?></td>
<td><?php echo $c['meet_person_name']; ?></td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Department_model');
									   $dataArr = $this->CI->Department_model->get_department($c['department_id']);
									   echo $dataArr['department_name'];?>
									</td>
<td><?php echo $c['reason_to_meet']; ?></td>
<td><?php echo $c['visitor_enter_time']; ?></td>
<td><?php echo $c['visitor_outing_remark']; ?></td>
<td><?php echo $c['out_time']; ?></td>
<td><?php echo $c['visitor_status']; ?></td>

		<td>
            <a href="<?php echo site_url('admin/visitor/details/'.$c['id']); ?>"  class="action-icon"> <i class="zmdi zmdi-eye"></i></a>
            <a href="<?php echo site_url('admin/visitor/save/'.$c['id']); ?>" class="action-icon"> <i class="zmdi zmdi-edit"></i></a>
            <a href="<?php echo site_url('admin/visitor/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="zmdi zmdi-delete"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<!--End of Data display of visitor//--> 

<!--No data-->
<?php
	if(count($visitor)==0){
?>
 <div align="center"><h3>Data is not exists</h3></div>
<?php
	}
?>
<!--End of No data//-->

<!--Pagination-->
<?php
	echo $link;
?>
<!--End of Pagination//-->
