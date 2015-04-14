<div class="row">
    <div class="col-md-6">
        <div class="input-group taskInput">
            <div class="input-group-btn">
                <button id="levelone_btn" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    输入
                    <span class="caret"></span>
                </button>
                <ul id="levelone_dropdown" class="dropdown-menu" role="menu">
                    <li role="presentation" class="dropdown-header">下拉菜单标题</li>
                    <li><a class="choose_levelone" href="#">a1</a></li>
                    <li><a class="choose_levelone" href="#">a2</a></li>
                    <li role="presentation" class="dropdown-header">下拉菜单标题2</li>
                    <li><a class="choose_levelone" href="#">a3</a></li>
                    <li><a class="choose_levelone" href="#">a4</a></li>
                </ul>
            </div>
            <input id="levelone_input" type="text" placeholder="事件类型" class="form-control" />
        </div>

<!-- 
        <div class="input-group taskInput show_disable">
            <div class="input-group-btn">
                <button id="leveltwo_btn" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    输入
                    <span class="caret"></span>
                </button>
                <ul id="leveltwo_dropdown" class="dropdown-menu" role="menu">
                    <li><a class="choose_leveltwo" href="#">a3</a></li>
                    <li><a class="choose_leveltwo" href="#">a4</a></li>
                </ul>
            </div>
            <input id="leveltwo_input" type="text" placeholder="事件小类" class="form-control" />
        </div> -->



        <div class="input-group taskInput">
            <span class="input-group-addon">@</span>
            <input id="taskcontent_input" type="text" placeholder="事件内容" class="form-control" />
        </div>

        

        <div class="btn-toolbar taskInput" role="group">
            <div class="btn-group">
                <button id="dealman_btn" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" value="default">默认处理人</button>
                <ul id="dealman_dropdown" class="dropdown-menu" role="menu">
                    <li><a class="choose_dealman" value="10000179" href="#">wqz</a></li>
                    <li><a class="choose_dealman" value="10000266" href="#">wws</a></li>
                </ul>
            </div>

            <div class="btn-group pull-right">
                <button id="submit_btn" class="btn btn-primary taskBtn">提交</button>
                <button id="clear_btn" class="btn btn-default taskBtn">清空</button>
            </div>
        </div>
    </div>
    

    <div class="col-md-6">
        <p>2</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>3</p>
    </div>
    <div class="col-md-6">
        <p>4</p>
    </div>
</div>