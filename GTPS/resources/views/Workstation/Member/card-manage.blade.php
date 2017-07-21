@extends('Workstation.Public.public')

@section('content')
<div class="page-content clearfix" id="layout-1">
    <div class="flat-type">
        <div class="function-wrap clearfix" id="function-wrap">
       <span class="l_f">
        <a @click="addCustomer" title="添加品牌" class="btn btn-warning Order_form"><i class="icon-plus"></i>入库</a>
        <a href="javascript:void(0)" class="btn btn-info">制卡</a>
        <a href="javascript:void(0)" class="btn btn-success">批量制卡</a>
           <a href="javascript:void(0)" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>
            <span class="r_f">共：<b>234</b>个品牌</span>
        </div>
        <!--用户列表展示-->
        <div class="h_products_list clearfix" id="products_list">
            <div id="scrollsidebar" class="left_Treeview">
                <div class="show_btn" id="rightArrow"><span></span></div>
                <div class="widget-box side_content">
                    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
                    <div class="side_list">
                        <div class="widget-header header-color-green2"><h4 class="lighter smaller">会员卡入库单</h4></div>
                        <div class="widget-body">
                            <div class="widget-main padding-8">
                                <div id="treeDemo_user" class="ztree"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table_menu_list" id="testIframe">
                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label>
                        </th>
                        <th width="80px">ID</th>
                        <th width="50px">排序</th>
                        <th width="120px">品牌LOGO</th>
                        <th width="120px">品牌名称</th>
                        <th width="130px">所属地区/国家</th>
                        <th width="350px">描述</th>
                        <th width="180px">加入时间</th>
                        <th width="70px">状态</th>
                        <th width="300px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label>
                        </td>
                        <td width="80px">45631</td>
                        <td width="50px"><input type="text" class="input-text text-c" value="1" style="width:60px"></td>
                        <td><img src="products/logo/156.jpg" width="130"/></td>
                        <td><a href="javascript:ovid()" name="Brand_detailed.html" style="cursor:pointer"
                               class="text-primary brond_name" onclick="generateOrders('561');"
                               title="玉兰油OLAY">玉兰油OLAY</a></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/34.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name" onclick="generateOrders('5621');"
                               title="玉兰油OLAY">玉兰油OLAY</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/245.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name" onclick="generateOrders('461');"
                               title="御泥坊">御泥坊</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/245.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name" onclick="generateOrders('461');"
                               title="御泥坊">御泥坊</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/245.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name" onclick="generateOrders('461');"
                               title="御泥坊">御泥坊</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/199.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">薇姿</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/152.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">丝塔芙</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/42.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">比克度</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/42.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">比克度</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/42.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">比克度</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/42.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">比克度</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/42.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">比克度</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/42.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">比克度</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                        <td>2045</td>
                        <td><input type="text" class="input-text text-c" value="2" style="width:60px"></td>
                        <td><img src="products/logo/42.jpg" width="130"/></td>
                        <td><u style="cursor:pointer" class="text-primary brond_name"
                               onclick="member_show('张三','member-show.html','10001','360','400')">比克度</u></td>
                        <td>法国</td>
                        <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                        <td>2014-6-11 11:11:42</td>
                        <td class="td-status"><span class="label label-success radius">已启用</span></td>
                        <td class="td-manage">
                            <a onClick="member_stop(this,'10001')" href="javascript:;" title="停用"
                               class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                            <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                               class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                               class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--添加用户图层-->
            <div class="add_menber" id="storage_model" style="display:none; padding: 0 20px; margin-top: 10px">
                <div class="panel panel-default">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">
                        <ul class=" page-content clearfix">
                            <li><label class="label_name">建卡类型：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">有效期：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">默认密码：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">卡号生成规则（长度 = 前缀长度 + 号码长度）</div>
                    <div class="panel-body">
                        <ul class=" page-content clearfix">
                            <li><label class="label_name">前缀：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">长度：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">卡ID和卡号相同：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">
                        <ul class=" page-content clearfix">
                            <li><label class="label_name">建卡类型：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">有效期：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">默认密码：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">
                        <ul class=" page-content clearfix">
                            <li><label class="label_name">建卡类型：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">有效期：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">默认密码：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">
                        <ul class=" page-content clearfix">
                            <li><label class="label_name">建卡类型：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">有效期：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">默认密码：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">
                        <ul class=" page-content clearfix">
                            <li><label class="label_name">建卡类型：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">有效期：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                            <li><label class="label_name">默认密码：</label><span class="add_name"><input
                                    value=""
                                    name="用户名"
                                    type="text"
                                    class="text_add"/></span>
                                <div class="prompt r_f"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  base scripts -->
<script src="{{ asset('js/WorkStation/member-card.js')}}"></script>
@endsection