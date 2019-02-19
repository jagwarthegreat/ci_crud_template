<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username')){
if($this->session->flashdata('success')){
?>
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success! </strong><?php echo $this->session->flashdata('success'); ?>
</div>
<?php } ?>

<div class="container-fluid" style="margin-top: 10px;">
<form action="<?php echo base_url();?>category/delete" method="POST">
	<div class="col-md-12">
		<div class="text-right">
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCatModal"><i class="fas fa-plus-circle"></i> Add Category</button>

			<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
		</div>
	</div>
	<div class="col-md-12" style="margin-top: 10px;">
		<table class="table table-bordered table-dark">
		  <thead>
		    <tr>
		      <th scope="col"></th>
		      <th scope="col">Item Category</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>

		  	<?php foreach($content as $row){ ?>
		    <tr id='<?php echo $row->id;?>' >
		      <td width="20px"><input type="checkbox" value="<?php echo $row->id;?>" id="defaultCheck1" name="delete[]"></td>
		      <td class="cat_name"><?php echo $row->name;?></td>
		      <td data-id = "<?php echo $row->id;?>" style="width: 10%;"><button type="button" class="btn btn-primary btn-sm edit-item" data-toggle="modal" data-target="#editCatModal"><i class="fas fa-edit"></i> Edit</button></td>
		    </tr>
			<?php } ?>

		  </tbody>
		</table>
	</div>
</form>
</div>
<?php }else{ show_404(); }?>

<!-- Modal -->
<div class="modal fade" id="addCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url();?>category/add" method="POST">
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<label for="catname">Category Name</label>
    			<input type="text" class="form-control" id="catname" name="catname" autocomplete="off">
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url();?>category/edit" method="POST">
      <div class="modal-body">
      	<input type="hidden" class="form-control" id="edit_id" name="edit_id">

        <div class="row">
        	<div class="col-md-12">
        		<label for="catname">Category Name</label>
    			<input type="text" class="form-control" id="edit_catname" name="edit_catname" autocomplete="off">
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
	$("body").on("click",".edit-item",function(){
		var id = $(this).parent("td").data('id');
		var name = $('tr#'+id+' .cat_name').text();
		
		$("#editCatModal").find("input[name='edit_id']").val(id);
		$("#editCatModal").find("input[name='edit_catname']").val(name);
	});
</script>