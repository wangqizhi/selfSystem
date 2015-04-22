<div class="">
        <!-- Page Content goes here -->

    <div class="row navbar-fixed">
        
        <nav>
            <div class="nav-wrapper">
              <a href="/station/playstation" class="brand-logo center">CoffeeBreak</a>
              <ul id="nav-mobile" class=" hide-on-med-and-down">
                <!-- <li><a href="sass.html">Sass</a></li> -->
                <?php 
                if($substation){
                    foreach ($substation as $key => $value) {
                        if ($key ==$subtag) {
                            // echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.' active"><span class="spanchoose">'.$value[0].'</span></div>';
                            echo '<li class="active"><a href="#" class="mysubC_'.$key.'">'.$value[0].'</a></li>';
                        } else {
                            // echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.'"><a href="/station/playstation/choose/'.$station.'/'.$key.'" class="suba">'.$value.'</a></div>';
                            echo '<li><a href="'.$value[1].'" class="mysubC_'.$key.' active">'.$value[0].'</a></li>';
                            // echo '<div class="col-sm-2 topnav_btn mysubC_'.$key.'"><a href="'.$value[1].'" class="suba">'.$value[0].'</a></div>';
                        }
                    }
                }else{
                    // echo '<div class="col-sm-2 topnav_btn"><span class="spanchoose">Welcome</span></div>';
                    echo '<li><a href="#">Welcome</a></li>';
                }
                ?>
              </ul>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="#"><?php echo $cb_displayName?></a></li>
                <li><a href="/login/loginout">登出</a></li>
              </ul>
            </div>
        </nav>
    

    </div>


    <div class="row">
        <!-- 以下为模块具体功能 -->