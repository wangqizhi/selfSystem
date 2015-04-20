<div class="row">
  <div class="navfix">

    <div class="col-md-2 myleftnav">
      <p class="">Coffee Break</p>
    </div>
    <div class="col-md-8">
      <div class="container">

        <?php 
          if($substation){
            foreach ($substation as $key => $value) {
              if ($key ==$subtag) {
                echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.' active"><span class="spanchoose">'.$value[0].'</span></div>';
              } else {
                // echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.'"><a href="/station/playstation/choose/'.$station.'/'.$key.'" class="suba">'.$value.'</a></div>';
                echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.'"><a href="'.$value[1].'" class="suba">'.$value[0].'</a></div>';
              }
            }
          }else{
            echo '<div class="col-sm-2 topnav_btn"><span class="spanchoose">Welcome</span></div>';
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
  <div class="col-md-10 mainstage">
    <!-- 以下具体模块 start -->