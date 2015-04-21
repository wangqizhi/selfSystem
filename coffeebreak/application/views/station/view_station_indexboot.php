<div class="row">
    <!-- 顶部导航 -->
    <nav id="mynav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
             <!-- 顶部-左 -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/station/playstation">CoffeeBreak  <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
              
            </div>

            <!-- 顶部-主要 -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
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
                <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
                <!-- <li><a href="#">Link</a></li> -->
                <!-- <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li> -->
              </ul>

              <!-- 顶部-右 -->
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><?php echo $cb_displayName?></a></li>
                <li><a class="btn btn-primary btn-sm" href="/login/loginout">登出</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>

<!-- 测边主菜单 -->
<div class="row">
    <div id="nav-myself-left" class="col-md-2 jumbotron">
        <ul class="nav nav-pills nav-stacked">
            <?php foreach ($powerArray as $key => $value) {
                echo '<li><a href="/station/playstation/choose/'.$key.'">'.$value.'</a></li>';
            } ?>
            <!-- <li><a href='/station/playstation/choose/1'>test</a></li> -->
        </ul>
    </div>
    <div class="col-md-9 cb_mainstage">