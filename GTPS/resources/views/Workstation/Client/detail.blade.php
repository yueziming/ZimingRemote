@extends('Workstation.Public.public')

@section('content')
    <div class="page-content clearfix" id="layout-2">
        <div class="flat-type">
            <div class="function-wrap clearfix">
       <span class="l_f">
        <a @click="goBack" title="返回" class="btn btn-primary Order_form"><i class="fa fa-reply mr4"></i>返回</a>
        {{--<a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-phone"></i>批量预约</a>
        <a href="javascript:void(0)" class="btn btn-info">国内品牌</a>
        <a href="javascript:void(0)" class="btn btn-success">国外品牌</a>--}}
       </span>
                {{--<span class="r_f">共：<b>234</b>个品牌</span>--}}
            </div>

            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">
                        客户基本资料</a>
                </li>
                <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle"
                       data-toggle="dropdown">预约信息 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <li><a href="#jmeter" tabindex="-1" data-toggle="tab">
                                预约基本信息</a>
                        </li>
                        <li><a href="#ejb" tabindex="-1" data-toggle="tab">
                                预约附加信息</a>
                        </li>
                    </ul>
                </li>
                <li><a href="#ios" data-toggle="tab">回访记录</a></li>
                <li><a href="#ios" data-toggle="tab">代办事件</a></li>
                <li><a href="#ios" data-toggle="tab">操作项目</a></li>
                <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle"
                       data-toggle="dropdown">日志相关 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <li><a href="#jmeter" tabindex="-1" data-toggle="tab">
                                服务日志</a>
                        </li>
                        <li><a href="#ejb" tabindex="-1" data-toggle="tab">
                                修改日志</a>
                        </li>
                        <li><a href="#ejb" tabindex="-1" data-toggle="tab">
                                查修改服务卡日志</a>
                        </li>
                    </ul>
                </li>
                <li><a href="#ios" data-toggle="tab">病例演示</a></li>
                <li><a href="#ios" data-toggle="tab">客户文档</a></li>
                <li><a href="#ios" data-toggle="tab">平板开单服务卡</a></li>
            </ul>
            {{--<div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="home">
                    <p>Tutorials Point is a place for beginners in all technical areas.
                        This website covers most of the latest technoligies and explains
                        each of the technology with simple examples. You also have a
                        <b>tryit</b> editor, wherein you can edit your code and
                        try out different possibilities of the examples.</p>
                </div>
                <div class="tab-pane fade" id="ios">
                    <p>iOS is a mobile operating system developed and distributed by Apple
                        Inc. Originally released in 2007 for the iPhone, iPod Touch, and
                        Apple TV. iOS is derived from OS X, with which it shares the
                        Darwin foundation. iOS is Apple's mobile version of the
                        OS X operating system used on Apple computers.</p>
                </div>
                <div class="tab-pane fade" id="jmeter">
                    <p>jMeter is an Open Source testing software. It is 100% pure
                        Java application for load and performance testing.</p>
                </div>
                <div class="tab-pane fade" id="ejb">
                    <p>Enterprise Java Beans (EJB) is a development architecture
                        for building highly scalable and robust enterprise level
                        applications to be deployed on J2EE compliant
                        Application Server such as JBOSS, Web Logic etc.
                    </p>
                </div>
            </div>--}}

            <div class="flat_list clearfix" id="category">
                <div class="table_menu_list2">
                    <table class="table table-striped table-bordered table-hover" id="sample-table">
                        <thead>
                        <tr>
                            <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label>
                            </th>
                            <th width="80px" @click="idSort">ID</th>
                            <th width="50px">排序</th>
                            <th width="120px">品牌LOGO</th>
                            <th width="120px">品牌名称</th>
                            <th width="130px">所属地区/国家</th>
                            <th width="350px">描述</th>
                            <th width="180px">加入时间</th>
                            <th width="70px">状态</th>
                            <th width="200px">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in 10">
                            <td width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label>
                            </td>
                            <td width="80px">@{{ item }}</td>
                            <td width="50px"><input type="text" class="input-text text-c" value="1" style="width:60px">
                            </td>
                            <td><img src="products/logo/156.jpg" width="130"/></td>
                            <td><a href="javascript:void(0);" name="Brand_detailed.html" style="cursor:pointer"
                                   class="text-primary brond_name" onclick="generateOrders('561');"
                                   title="玉兰油OLAY">玉兰油OLAY</a></td>
                            <td>法国</td>
                            <td class="text-l">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，OLAY以全球高科技护肤研发技术为后盾......</td>
                            <td>2014-6-11 11:11:42</td>
                            <td class="td-status"><span class="label label-success radius">已登记</span></td>
                            <td class="td-manage" style="width: 220px;">
                                {{--<div class="btn-group" role="group" aria-label="...">--}}
                                <div class="text-center">
                                    <button @click="appointment($event)" v-show="false" type="button" class="btn btn-default change-btn float_left mr2">预约</button>
                                    <button @click="cancelAppointment($event)" v-show="true" type="button" class="btn btn-default change-btn float_left mr2">取消预约</button>
                                    <button type="button" class="btn btn-default change-btn float_left mr2">编辑</button>
                                    <button type="button" class="btn btn-primary change-btn float_left mr2">删除</button>
                                    <button type="button" @click="goDetailPage" class="btn btn-primary change-btn float_left mr2">详情</button>
                                </div>
                                {{--<a @click="appointment($event)" href="javascript:;" title="预约" v-show="false"
                                   class="btn btn-xs btn-success"><i class="fa fa-phone bigger-120"></i>预约</a>
                                <a @click="cancelAppointment($event)" href="javascript:;" title="预约" v-show="true"
                                   class="btn btn-xs btn-success"><i class="fa fa-tty bigger-120"></i>取消预约</a>
                                <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"
                                   class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
                                <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                                   class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                                <a title="删除" href="javascript:;" onclick="member_del(this,'1')"
                                   class="btn btn-xs btn-danger"><i class="fa fa-life-ring  bigger-120"></i>详情</a>--}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--添加用户图层-->
                <div class="add_menber" id="add_menber_style" style="display:none">

                    <ul class=" page-content">
                        <li v-for="item in addClientList" v-if="item.necessary"><label class="label_name">@{{item.name}}
                                ：</label><span class="add_name selectWidth">
                        <input v-if="item.type == 'input'" name="用户名" type="text"
                               class="text_add form-control height-auto"/>
                        <select v-else-if="item.type == 'select'" class="text_add form-control ml10 height-auto">
                            <option>123456</option>
                        </select>
                        <div class="row" v-else>
                          <div class="col-lg-12 col-md-12 col-xs-12" style="padding-left: 0px">
                            <div class="input-group">
                              <input type="text" class="form-control height-auto search-text"
                                     @keyup="changeList($event)" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button class="btn btn-primary ptb0 search-btn" type="button"
                                        @click="changeList($event)">搜索</button>
                              </span>
                            </div><!-- /input-group -->
                          </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                                {{--<input v-else="item.type == 'input'"  name="用户名" type="text" class="text_add"/>--}}
                    </span>
                            <div class="prompt r_f"></div>
                        </li>
                        {{--<li><label class="label_name">真实姓名：</label><span class="add_name"><input name="真实姓名" type="text"
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
                        </li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--  base scripts -->
    <script src="{{ asset('js/WorkStation/client-detail.js')}}"></script>
@endsection