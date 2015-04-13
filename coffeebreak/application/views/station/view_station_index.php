<div class="row">
  <div class="navfix">
    <!-- <nav class="mynav navbar navbar-inverse navbar-embossed"> -->
      <!-- <p class="navbar-text navbar-right loginwho">Signed in as <a class="navbar-link" href="#"><?php echo $cb_displayName?></a></p> -->
    <!-- </nav> -->
    <div class="col-md-2 myleftnav">
      <p class="">Coffee Break</p>
    </div>
    <div class="col-md-8"></div>
    <div class="col-md-2 myrightnav">
      <p class=""><?php echo $cb_displayName?> <a class="btn btn-primary btn-sm" href="/login/loginout">登出</a></p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-2 jumbotron leftbar">
    <div class="row">
      <?php foreach ($powerArray as $key => $value) {
        echo "<p><a href=''>".$value."</a></p>";
      } ?>
    
    </div>
  </div>
  <div class="col-md-2 test">
    <p>12222</p>
    <p>12222</p>
    <p>12222</p>
    <p>12222</p>
  </div>
  <div class="col-md-2"></div>
</div>
