<div class="row">
    <div class="col-md-6">
        <div class="input-group taskInput">
            <input id="levelone_input" type="text" placeholder="事件类型(格式:大类-小类)" class="form-control" />
            <div class="input-group-btn" id="dropdowngroup">
                <button id="levelone_btn" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                    选择事件类型
                    <span class="caret"></span>
                </button>
                

                <ul id="levelone_dropdown" class="dropdown-menu" role="menu">
                   <?php 
                   foreach ($tasktypes as $key => $value) {
                        // echo '<li role="presentation" class="dropdown-header" id="taskid-'.$key.'">'.$value.'</li>';
                        echo '<li role="presentation"><a role="menuitem" class="choose_levelone" id="taskid-'.$key.'" href="#">'.$value.'</a></li>';
                   }
                   ?>
                   <!--  <li role="presentation" class="dropdown-header">下拉菜单标题2</li>
                    <li ><a class="choose_levelone" href="#">a3</a></li> -->
                </ul>
            </div>
        </div>


        <div class="input-group taskInput">
            <span class="input-group-addon">@</span>
            <!-- <input id="taskcontent_input" type="text" placeholder="事件内容" class="form-control" /> -->
            <textarea rows="5" id="taskcontent_input" type="text" placeholder="事件内容" class="form-control" ></textarea>
        </div>

        

        <div class="btn-toolbar taskInput" role="group">
            <div class="btn-group">
                <button id="dealman_btn" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" value="default">默认处理人</button>
                <ul id="dealman_dropdown" class="dropdown-menu" role="menu">
                    <?php 
                    foreach ($defaultusers as $key => $value) {
                        echo '<li><a class="choose_dealman" value="'.$key.'" href="#">'.$value.'</a></li>';
                    }
                     ?>
                    <!-- <li><a class="choose_dealman" value="10000179" href="#">wqz</a></li> -->
                </ul>
            </div>

            <div class="btn-group pull-right">
                <button id="submit_btn" class="btn btn-primary taskBtn">提交</button>
                <button id="clear_btn" class="btn btn-default taskBtn">清空</button>
            </div>
        </div>
    </div>
    

    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">我的提交(还未处理)</div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <?php 
                        if ($commitusr && count($commitusr)!=0 ) {
                            foreach ($commitusr as $key => $value) {
                                echo '<li><a class="" href="#">'.$defaultusers[$value->nowMan].'正在处理CaseID:'.$value->id.'</a><p><small>'.$value->taskContent.'</small></p></li>';
                            }
                        }
                     ?>
                        <!-- <li><a href="">1 - 3- - 4- 5</a><p>helo</p></li>
                        <li><a href="">1 - 3- - 4- 5</a></li> -->
                    </ul>
                </div>
        </div>    


    </div>


</div>
<div class="row">
    <div class="col-md-6">
    </div>    
</div>
    <div class="col-md-6">
    </div>
</div>