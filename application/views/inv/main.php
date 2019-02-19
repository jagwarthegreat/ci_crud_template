<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username')){
?>
<?php if($this->session->flashdata('success')){?>
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success! </strong><?php echo $this->session->flashdata('success'); ?>
</div>
<?php } ?>
<div class="container-fluid" style="margin-top: 10px;">
<form action="<?php echo base_url();?>inventory/delete" method="POST">
	<div class="col-md-12">
		<div class="text-right">
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i> Add Items</button>

			<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
		</div>
	</div>
	<div class="col-md-12" style="margin-top: 10px;">
		<table class="table table-bordered table-dark">
		  <thead>
		    <tr>
		      <th scope="col"></th>
		      <th scope="col">Category</th>
		      <th scope="col">Barcode</th>
		      <th scope="col">Name</th>
		      <th scope="col">Serial</th>
		      <th scope="col">Variation</th>
		      <th scope="col">Encoded by</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>

		  	<?php foreach($content as $row){ ?>
		    <tr id="<?php echo $row->item_id;?>">
				<td width="20px"><input type="checkbox" value="<?php echo $row->item_id;?>" id="defaultCheck1" name="delete[]"></td>
				<td class="cat"><?php echo $row->cat_name;?></td>
				<td class="barcode"><?php echo $row->barcode;?></td>
				<td class="item_name"><?php echo $row->item_name;?></td>
				<td class="serial"><?php echo $row->serial;?></td>
				<td class="variation"><?php echo $row->variation;?></td>
				<td class="encodedby">
		      	<?php 
		      		$res = $this->user_model->getUser($row->user_id);
					foreach ($res as $userRow) {
						$fullname = $userRow->name;
					}
					echo $fullname;
				?>
				</td>
				<td data-id = '<?php echo $row->item_id;?>'><button type="button" class="btn btn-primary btn-sm edit-item" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</button></td>
		    </tr>
			<?php } ?>

		  </tbody>
		</table>
	</div>
</form>
</div>
<?php }else{ show_404(); } ?>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url();?>inventory/add" method="POST">
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<input type="hidden" name="userID" value="<?=$this->session->userdata('user_id');?>">
        		<label for="name">Category</label>
    			<select class="form-control" id="category" name="category">
    				<?php foreach($content_category as $catrow){ ?>
    					<option value="<?php echo $catrow->id;?>"><?php echo $catrow->name;?></option>
    				<?php } ?>
    			</select>

        		<label for="barcode">Barcode</label>
        		<input type="text" class="form-control" id="barcode" name="barcode">

        		<label for="name">Name</label>
    			<input type="text" class="form-control" id="name" name="name">

    			<label for="serial">Serial</label>
    			<input type="text" class="form-control" id="serial" name="serial">

    			<label for="variation">Variation</label>
    			<input type="text" class="form-control" id="variation" name="variation">
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url();?>inventory/edit" method="POST">
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<input type="hidden" class="form-control" id="id" name="id">

        		<label for="name">Category</label>
    			<select class="form-control" id="category" name="category">
    				<?php foreach($content_category as $catrow){ ?>
    					<option value="<?php echo $catrow->id;?>"><?php echo $catrow->name;?></option>
    				<?php } ?>
    			</select>

        		<label for="barcode">Barcode</label>
        		<input type="text" class="form-control" id="barcode" name="barcode">

        		<label for="name">Name</label>
    			<input type="text" class="form-control" id="name" name="name">

    			<label for="serial">Serial</label>
    			<input type="text" class="form-control" id="serial" name="serial">

    			<label for="variation">Variation</label>
    			<input type="text" class="form-control" id="variation" name="variation">
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
		var barcode = $('tr#'+id+' .barcode').text();

		var name = $('tr#'+id+' .item_name').text();
		var serial = $('tr#'+id+' .serial').text();
		var variation = $('tr#'+id+' .variation').text();
		var cat = $('tr#'+id+' .cat').text();
		
		$("#editModal").find("input[name='id']").val(id);
		$("#editModal").find("input[name='category']").val(cat);
		$("#editModal").find("input[name='barcode']").val(barcode);
		$("#editModal").find("input[name='name']").val(name);
		$("#editModal").find("input[name='serial']").val(serial);
		$("#editModal").find("input[name='variation']").val(variation);
	});
</script>