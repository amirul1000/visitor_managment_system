<a  href="<?php echo site_url('admin/visitor/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Visitor'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/visitor/save/'.$visitor['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
          <label for="Visitor Name" class="col-md-4 control-label">Visitor Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="visitor_name" value="<?php echo ($this->input->post('visitor_name') ? $this->input->post('visitor_name') : $visitor['visitor_name']); ?>" class="form-control" id="visitor_name" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Visitor Email" class="col-md-4 control-label">Visitor Email</label> 
          <div class="col-md-8"> 
           <input type="text" name="visitor_email" value="<?php echo ($this->input->post('visitor_email') ? $this->input->post('visitor_email') : $visitor['visitor_email']); ?>" class="form-control" id="visitor_email" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Visitor Mobile No" class="col-md-4 control-label">Visitor Mobile No</label> 
          <div class="col-md-8"> 
           <input type="text" name="visitor_mobile_no" value="<?php echo ($this->input->post('visitor_mobile_no') ? $this->input->post('visitor_mobile_no') : $visitor['visitor_mobile_no']); ?>" class="form-control" id="visitor_mobile_no" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="File Picture" class="col-md-4 control-label">File Picture</label> 
          <div class="col-md-8"> 
           <input type="file" name="file_picture"  id="file_picture" value="<?php echo ($this->input->post('file_picture') ? $this->input->post('file_picture') : $visitor['file_picture']); ?>" class="form-control-file"/> 
          </div> 
            </div>
<div class="form-group"> 
          <label for="Visitor Address" class="col-md-4 control-label">Visitor Address</label> 
          <div class="col-md-8"> 
           <input type="text" name="visitor_address" value="<?php echo ($this->input->post('visitor_address') ? $this->input->post('visitor_address') : $visitor['visitor_address']); ?>" class="form-control" id="visitor_address" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Meet Person Name" class="col-md-4 control-label">Meet Person Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="meet_person_name" value="<?php echo ($this->input->post('meet_person_name') ? $this->input->post('meet_person_name') : $visitor['meet_person_name']); ?>" class="form-control" id="meet_person_name" /> 
          </div> 
           </div>
<div class="form-group"> 
                                    <label for="Department" class="col-md-4 control-label">Department</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Department_model'); 
             $dataArr = $this->CI->Department_model->get_all_department(); 
          ?> 
          <select name="department_id"  id="department_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($visitor['department_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['department_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                        <label for="Reason To Meet" class="col-md-4 control-label">Reason To Meet</label> 
          <div class="col-md-8"> 
           <textarea  name="reason_to_meet"  id="reason_to_meet"  class="form-control" rows="4"/><?php echo ($this->input->post('reason_to_meet') ? $this->input->post('reason_to_meet') : $visitor['reason_to_meet']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Visitor Enter Time" class="col-md-4 control-label">Visitor Enter Time</label> 
          <div class="col-md-8"> 
           <input type="text" name="visitor_enter_time"  id="visitor_enter_time"  value="<?php echo ($this->input->post('visitor_enter_time') ? $this->input->post('visitor_enter_time') : $visitor['visitor_enter_time']); ?>" class="form-control-static datepicker"/> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Visitor Outing Remark" class="col-md-4 control-label">Visitor Outing Remark</label> 
          <div class="col-md-8"> 
           <textarea  name="visitor_outing_remark"  id="visitor_outing_remark"  class="form-control" rows="4"/><?php echo ($this->input->post('visitor_outing_remark') ? $this->input->post('visitor_outing_remark') : $visitor['visitor_outing_remark']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Out Time" class="col-md-4 control-label">Out Time</label> 
          <div class="col-md-8"> 
           <input type="text" name="out_time"  id="out_time"  value="<?php echo ($this->input->post('out_time') ? $this->input->post('out_time') : $visitor['out_time']); ?>" class="form-control-static datepicker"/> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Visitor Status" class="col-md-4 control-label">Visitor Status</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('visitor','visitor_status'); 
           ?> 
           <select name="visitor_status"  id="visitor_status"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($visitor['visitor_status']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php 
              } 
             ?> 
           </select> 
          </div> 
            </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($visitor['id'])){?>Save<?php }else{?>Update<?php } ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->	
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>  			