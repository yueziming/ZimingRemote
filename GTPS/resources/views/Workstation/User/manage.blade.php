@extends('Workstation.Public.public')

@section('content')
<div class="page-content clearfix" id="layout-1">
    <div id="products_style">
        <div class="search_style" id="search-wrap">
            <ul class="search_content clearfix">
                <li><label class="l_f" for="keyword">搜索：</label><input name="" id="keyword" type="text" class="text_add"
                                                                       placeholder="用户名/工号/拼音码/五笔码"
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
                        <div class="widget-header header-color-green2"><h4 class="lighter smaller">用户组</h4></div>
                        <div class="widget-body">
                            <div class="widget-main padding-8">
                                <div id="treeDemo_user" class="ztree"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table_menu_list" id="testIframe">
                <div class="panel panel-default">
                    <div class="panel-heading panel-green">
                        <h6>角色列表 - 用户[<span id="user_name" class="shallow-red-bold"></span>] - 编码[<span id="code"
                                                                                                        class="shallow-red-bold"></span>]
                        </h6>
                    </div>
                    <div class="panel-body">
                        <ul class="tab-box-list">
                            <!-- <li>
                                 <div class="tab-img">
                                     <div class="default-btn">
                                         <button class="btn btn-primary active" id="independent-power">独立权限详情</button>
                                     </div>
                                 </div>
                             </li>-->
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading panel-green"><h6>权限列表 - 角色 [<span id="role-name"
                                                                                class="shallow-red-bold"></span>]</h6>
                    </div>
                    <div class="panel-body">
                        <div id="treeDemo" class="ztree"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  base scripts -->
<script src="{{ asset('js/WorkStation/user.js')}}"></script>
@endsection