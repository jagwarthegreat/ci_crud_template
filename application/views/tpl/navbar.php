<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?=base_url();?>">WDY INVENTORY</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=base_url();?>">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php 
        if($this->session->userdata('username')){
      ?>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url();?>inventory">Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url();?>category">Category</a>
      </li>
      <?php } ?>

    </ul>

    <ul class="navbar-nav float-right">
      <?php 
        if($this->session->userdata('username')){
          
          $id = $this->session->userdata('user_id');
          $res = $this->user_model->getUser($id);
          foreach ($res as $row) {
            $fullname = $row->name;
          }
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle"></i> <?php echo $fullname;?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?=base_url();?>profile"><i class="fas fa-user-circle"></i> Profile</a>
          <a class="dropdown-item" href="<?=base_url();?>logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
      <?php }else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
      <?php } ?>
    </ul>  

  </div>
</nav>