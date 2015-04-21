<div class="row">
    <div class="col-md-6">

        <!-- 待处理模块 -->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">待处理 <span ><?php if($undealtask){echo count($undealtask);}else{echo "0";} ?></span> 项</div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                    <?php 
                    if ($undealtask && count($undealtask)!=0 ) {
                        foreach ($undealtask as $key => $value) {
                            echo '<li><a class="case_a" id="'.$value->id.'" href="#">(CaseID:'.$value->id.')'.$tasktypes[$value->typeID].' @ '.date('m-d H:i',$value->startTime).'</a></li>';
                        }
                    }
                   
                     ?>
                    <!-- <li><a href="">1 - 3- - 4- 5</a></li> -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- 待关闭模块 -->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">待关闭 <span ><?php if($aboutusr){echo count($aboutusr);}else{echo "0";} ?></span> 项</div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                    <?php 
                    if ($aboutusr && count($aboutusr)!=0 ) {
                        foreach ($aboutusr as $key => $value) {
                            echo '<li><a class="case_c_a" id="'.$value->id.'" href="#">(CaseID:'.$value->id.')'.$tasktypes[$value->typeID].' @ '.date('m-d H:i',$value->startTime).'</a></li>';
                        }
                    }
                     ?>
                    <!-- <li><a href="">1 - 3- - 4- 5</a></li> -->
                    </ul>
                </div>
            </div>
        </div>


    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <!-- 显示case全部内容 -->
        <div class="row">
            <div class="panel panel-default show_case_detail">
                <div class="panel-heading">
                    <span id="case_detail_id" realcaseid=0></span>
                </div>
                <div class="panel-body">
                    <p id="case_detail_content"></p>
                </div>
                <div id="case_detail_user" class="panel-footer">
                    <!-- <a href="" target="_blank">详细内容</a> -->
                <!-- Large modal -->
                    <a  class="case_meth_a" data-toggle="modal" data-target=".case_meth">点击显示更多</a>

                        <div class="modal fade case_meth" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel">流转情况<a class="anchorjs-link" href="#myLargeModalLabel"><span class="anchorjs-icon"></span></a></h4>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                            </div>
                          </div>
                        </div>
                </div>
                <!-- <div id="case_detail_user" class="panel-footer">1</div> -->
                <!-- <div id="case_detail_user" class="panel-footer">2</div> -->
            </div>
        </div>
        <!-- <input id="fun_btn" type="hidden" value="0"> -->


        <!-- 显示功能按钮 -->
        <div class="row">


            <!-- 标准功能 -->
            <div class="input-group show_btn_deal group_btn_deal">
                <span class="input-group-btn">
                    <button id="case_submit" class="btn btn-default case_btn" type="button">完成</button>
                    <button id="case_reject" class="btn btn-default case_btn" type="button">拒绝</button>
                    <!-- <button id="case_close" class="btn btn-default case_btn" type="button">关闭</button> -->
                    <!-- <button id="case_forward" class="btn btn-default case_btn" type="button">转发至</button> -->
                </span>
                <!-- <input id="forward_input" type="text" placeholder="请选择..." class="form-control" disabled="disabled" aria-label="..."> -->.
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        选择转发人<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($defaultusers as $key => $value) {
                                if ($_SESSION['cb_id'] != $key) {
                                    echo ' <li><a id="case_forward" class="forward_a case_btn" href="#"  value="'.$key.'" >'.$value.'</a></li>';
                                }
                            }
                         ?>
                        <!-- <li><a href="#">Separated link</a></li> -->
                    </ul>
                </div>
            </div>
   


            <!-- 关闭功能 -->
            <div class="input-group show_btn_close group_btn_close">
                    <button id="case_close"  type="button" class="btn btn-default">关闭</button>
            </div>
        </div>


        
    </div>
    
</div>
<div class="row">
    
</div>
<div class="row"></div>