<a  href="<?php echo site_url('admin/department/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Department'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/department/save/'.$department['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
          <label for="Department Name" class="col-md-4 control-label">Department Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="department_name" value="<?php echo ($this->input->post('department_name') ? $this->input->post('department_name') : $department['department_name']); ?>" class="form-control" id="department_name" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Description" class="col-md-4 control-label">Description</label> 
          <div class="col-md-8"> 
           <textarea  name="description"  id="description"  class="form-control" rows="4"/><?php echo ($this->input->post('description') ? $this->input->post('description') : $department['description']); ?></textarea> 
          </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($department['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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