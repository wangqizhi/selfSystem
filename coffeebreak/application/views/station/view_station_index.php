<div class="row">
  <div class="navfix">
    <!-- <nav class="mynav navbar navbar-inverse navbar-embossed"> -->
      <!-- <p class="navbar-text navbar-right loginwho">Signed in as <a class="navbar-link" href="#"><?php echo $cb_displayName?></a></p> -->
    <!-- </nav> -->
    <div class="col-md-2 myleftnav">
      <p class="">Coffee Break</p>
    </div>
    <div class="col-md-8">
      <div class="container">
      <!--   <div class="col-sm-2 topnav_btn active">
          <span>hello</span>
        </div>
        <div class="col-sm-2 topnav_btn topnav_btn ">
          <span>hello2</span>
        </div>
        <div class="col-sm-2">
        </div> -->
        <?php 
          if($substation){
            foreach ($substation as $key => $value) {
              if ($key ==$subtag) {
                echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.' active"><span class="spanchoose">'.$value.'</span></div>';
                # code...
              } else {
                # code...
                echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.'"><a href="/station/playstation/choose/'.$station.'/'.$key.'" class="suba">'.$value.'</a></div>';

              }
              
              // echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.'"><a href="/station/playstation/choose/'.$station.'/'.$key.'" class="suba">'.$value.'</a></div>';
            }
            // echo '<script>var substationClass="'.$subtag.'"</script>';
          }else{
            echo '<div class="col-sm-2 topnav_btn"><span>Welcome</span></div>';
          }
         ?>
      </div>
    </div>
    <div class="col-md-2 myrightnav">
      <p class=""><?php echo $cb_displayName?> <a class="btn btn-primary btn-sm" href="/login/loginout">登出</a></p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-2 jumbotron leftbar">
    <div class="row">
      <?php foreach ($powerArray as $key => $value) {
        echo "<p><a href='/station/playstation/choose/".$key."'>".$value."</a></p>";
      } ?>
    
    </div>
  </div>
  <div class="col-md-8 mainstage">
    <div class="">
     
    </div>
  </div>
  <div class="col-md-2"></div>
</div>
