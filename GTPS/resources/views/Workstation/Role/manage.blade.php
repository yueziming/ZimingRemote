@extends('Workstation.Public.public')

@section('content')
<div class="page-content clearfix" id="layout-1">
    <div id="products_style">
        <div class="search_style">
            <ul class="search_content clearfix">
                <li><label class="l_f">关键字</label><input id="search" name="" type="text" class="text_add"
                                                         placeholder="角色名关键字"
                                                         style=" width:250px"/></li>
            </ul>
        </div>
        <!--用户列表展示-->
        <div class="h_products_list clearfix" id="products_list">
            <div id="scrollsidebar" class="left_Treeview">
                <div class="show_btn" id="rightArrow"><span></span></div>
                <div class="widget-box side_content">
                    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
                    <div class="side_list">
                        <div class="widget-header header-color-green2"><h4 class="lighter smaller">角色组</h4></div>
                        <div class="widget-body">
                            <div class="widget-main padding-8">
                                <div id="treeDemo_role" class="ztree"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table_menu_list" id="testIframe">
                <div class="panel panel-default">
                    <div class="panel-heading panel-green"><h6>用户列表 - 角色[<span id="roles-user-name"
                                                                               class="shallow-red-bold"></span>]</h6>
                    </div>
                    <div class="panel-body userlist userlist-header">
                        <ul class="tab-box-list">
                            <li>
                                <div class="tab-img">
                                    <ul class="role-userList-ul" id="roles-user">
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading panel-green"><h6>权限列表</h6></div>
                    <div class="panel-body">
                        <div id="treeDemo" class="ztree"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--添加用户图层-->
<div class="add_menber" id="add_menber_style" style="display:none">

    <ul class=" page-content">
        <li><label class="label_name">用&nbsp;&nbsp;户 &nbsp;名：</label><span class="add_name"><input value="" name="用户名"
                                                                                                   type="text"
                                                                                                   class="text_add"/></span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">真实姓名：</label><span class="add_name"><input name="真实姓名" type="text"
                                                                                 class="text_add"/></span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</label><span class="add_name">
     <label><input name="form-field-radio" type="radio" checked="checked" class="ace"><span class="lbl">男</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="form-field-radio" type="radio" class="ace"><span class="lbl">女</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="form-field-radio" type="radio" class="ace"><span class="lbl">保密</span></label>
     </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">固定电话：</label><span class="add_name"><input name="固定电话" type="text"
                                                                                 class="text_add"/></span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">移动电话：</label><span class="add_name"><input name="移动电话" type="text"
                                                                                 class="text_add"/></span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">电子邮箱：</label><span class="add_name"><input name="电子邮箱" type="text"
                                                                                 class="text_add"/></span>
            <div class="prompt r_f"></div>
        </li>
        <li class="adderss"><label class="label_name">家庭住址：</label><span class="add_name"><input name="家庭住址" type="text"
                                                                                                 class="text_add"
                                                                                                 style=" width:350px"/></span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label><span class="add_name">
     <label><input name="form-field-radio1" type="radio" checked="checked" class="ace"><span
             class="lbl">开启</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="form-field-radio1" type="radio" class="ace"><span class="lbl">关闭</span></label></span>
            <div class="prompt r_f"></div>
        </li>
    </ul>
</div>
<!--  base scripts -->
<script src="{{ asset('js/WorkStation/role.js')}}"></script>
@endsection