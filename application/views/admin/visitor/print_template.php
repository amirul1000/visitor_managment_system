<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Visitor'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of visitor-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
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

    </tr>
	<?php } ?>
</table>
<!--End of Data display of visitor//--> 