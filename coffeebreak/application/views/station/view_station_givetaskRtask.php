<div class="row">
    <div class="col-md-6">
        <div class="row">
            <p>
                <div class="input-group">
                    <span class="input-group-btn">
                        <button id="case_submit" class="btn btn-default case_btn" type="button">完成</button>
                        <button id="case_reject" class="btn btn-default case_btn" type="button">拒绝</button>
                        <button id="case_forward" class="btn btn-default case_btn" type="button">转发至</button>
                    </span>
                    <input id="forward_input" type="text" placeholder="请选择..." class="form-control" disabled="disabled" aria-label="...">
            

                

                </div>
            </p>
            <p>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        选择转发人<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($defaultusers as $key => $value) {
                               echo ' <li><a class="forward_a" href="#"  value="'.$key.'" >'.$value.'</a></li>';
                            }

                         ?>
                        <!-- <li><a href="#">Separated link</a></li> -->
                    </ul>
                </div>
            </p>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">待处理 <span ><?php echo count($undealtask) ?></span> 项</div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                    <?php 
                    foreach ($undealtask as $key => $value) {
                        echo '<li><a class="case_a" id="'.$value->id.'" href="#">(CaseID:'.$value->id.')'.$tasktypes[$value->typeID].' @ '.date('m-d H:i',$value->startTime).'</a></li>';
                    }
                     ?>
                    <!-- <li><a href="">1 - 3- - 4- 5</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <p>
            <div class="panel panel-default show_case_detail">
                <div class="panel-heading">
                    <span id="case_detail_id"></span>
                </div>
                <div class="panel-body">
                    <p id="case_detail_content"></p>
                </div>
            </div>
        </p>
    </div>
    
</div>
<div class="row">
    
    
</div>
<div class="row"></div>