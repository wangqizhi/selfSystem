<div class="row">
    <div class="col m2">
        <p></p>
    </div>
        <div class="col m8">
             <table class="bordered">
                <thead>
                    <tr>
                        <th data-field="u_id">员工工号</th>
                        <th data-field="u_name">姓名</th>
                        <th data-field="u_group">用户组</th>
                        <th data-field="u_lasttime">最后登录时间</th>
                        <th data-field="u_status">状态功能</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    // var_dump($allusrsname);exit;
                    foreach ($allusrs as $key => $value) {
                        if ($value->loginPower == 0) {
                            echo '<tr><td>'.$value->uid.'</td><td>'.$allusrsname[$value->uid].'</td><td>'.$allpowerarray[$value->gid].'</td><td>'.date("Y-m-d H:i:s",$value->lastLoginTime).'</td><td><a herf="#">点击开通</a></td></tr>';
                            
                        } else {
                            echo '<tr><td>'.$value->uid.'</td><td>'.$allusrsname[$value->uid].'</td><td>'.$allpowerarray[$value->gid].'</td><td>'.date("Y-m-d H:i:s",$value->lastLoginTime).'</td><td>可以登录 </td></tr>';
                            # code...
                        }
                        
                        // echo '<tr><td>'.$value->uid.'</td><td>'.$allusrsname[$value->uid].'</td><td>'.$allpowerarray[$value->gid].'</td><td>'.date("Y-m-d H:i:s",$value->lastLoginTime).'</td><td>'.$value->loginPower.'</td></tr>';
                    } 
                    ?>
                  <!-- <tr><td>Alvin</td><td>Eclair</td><td>$0.87</td></tr> -->
                </tbody>
            </table>
            <div class="container">
                
            <ul class="pagination">
                <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
            </ul>

            </div>

            
        </div>
</div>

