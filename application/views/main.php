<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->flashdata('pass')){
?>
<div class="alert alert-warning">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong></strong><?php echo $this->session->flashdata('pass'); ?>
</div>
<?php } ?>

<div class="container-fluid" style="margin-top: 10px;">
	<div class="jumbotron">
	  <h1 class="display-4">Hello, world!</h1>
	  <p class="lead">This is a simple inventory, a simple tracker for your assets inside your premises. A simple way to keep records of your inventory items.</p>
	  <hr class="my-4">
	  <p>Built with <i class="fas fa-coffee"></i> and <i class="fas fa-heart"></i> by Jagwarthegreat.</p>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Welcome back!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url();?>login" method="POST">
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<label for="catname">Username</label>
    			<input type="text" class="form-control" id="username" name="username" autocomplete="off">

    			<label for="catname">Password</label>
    			<input type="password" class="form-control" id="password" name="password" autocomplete="off">
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>
      </form>
    </div>
  </div>
</div>