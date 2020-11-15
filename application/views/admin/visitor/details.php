<a  href="<?php echo site_url('admin/visitor/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Visitor'); ?></h5>
<!--Data display of visitor with id--> 
<?php
	$c = $visitor;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Visitor Name</td><td><?php echo $c['visitor_name']; ?></td></tr>

<tr><td>Visitor Email</td><td><?php echo $c['visitor_email']; ?></td></tr>

<tr><td>Visitor Mobile No</td><td><?php echo $c['visitor_mobile_no']; ?></td></tr>

<tr><td>File Picture</td><td><?php
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
										</td></tr>

<tr><td>Visitor Address</td><td><?php echo $c['visitor_address']; ?></td></tr>

<tr><td>Meet Person Name</td><td><?php echo $c['meet_person_name']; ?></td></tr>

<tr><td>Department</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Department_model');
									   $dataArr = $this->CI->Department_model->get_department($c['department_id']);
									   echo $dataArr['department_name'];?>
									</td></tr>

<tr><td>Reason To Meet</td><td><?php echo $c['reason_to_meet']; ?></td></tr>

<tr><td>Visitor Enter Time</td><td><?php echo $c['visitor_enter_time']; ?></td></tr>

<tr><td>Visitor Outing Remark</td><td><?php echo $c['visitor_outing_remark']; ?></td></tr>

<tr><td>Out Time</td><td><?php echo $c['out_time']; ?></td></tr>

<tr><td>Visitor Status</td><td><?php echo $c['visitor_status']; ?></td></tr>


</table>
<!--End of Data display of visitor with id//--> 