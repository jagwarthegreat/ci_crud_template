<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username')){
?>
<div class="container-fluid" style="margin-top: 10px;">
	<div class="jumbotron">
	  <h1 class="display-4">Profile</h1>
	  <p class="lead"></p>
	  <hr class="my-4">
	  <p>Built with <i class="fas fa-coffee"></i> and <i class="fas fa-heart"></i> by Jagwarthegreat.</p>
	</div>
</div>
<?php }else{ show_404(); } ?>