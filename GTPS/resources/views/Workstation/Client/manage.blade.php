@extends('Workstation.Public.public')
{{--<link rel="stylesheet" href=" {{ asset('css/client.css') }} "/>--}}
@section('content')
<div class="page-content clearfix" id="layout-2">
    <div class="flat-type">
        <div class="function-wrap clearfix">
       <span class="l_f">
        <a @click="addCustomer" title="添加品牌" class="btn btn-primary Order_form"><i class="icon-plus"></i>客户登记</a>
        <a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-phone"></i>批量预约</a>
        <a href="javascript:void(0)" class="btn btn-info">国内品牌</a>
        <a href="javascript:void(0)" class="btn btn-success">国外品牌</a>
       </span>
            <span class="r_f">共：<b>234</b>个品牌</span>
        </div>

            <div class="flat_list clearfix" id="category">
                <div class="table_menu_list2">
                    <table class="table table-striped table-bordered table-hover" id="sample-table">
                        <thead>
                        <tr>
                            <th width="25px"><label><input @click="changeCheckbox($event)" type="checkbox" class="ace all-check"><span class="lbl"></span></label>
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
                            <td width="25px"><label><input @click="changeCheckbox($event)" type="checkbox" class="ace checkbox"><span class="lbl"></span></label>
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
                                    <button type="button" @click="goDetailPage($event)" class="btn btn-primary change-btn float_left mr2">详情</button>
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
                    <form id="addClient">
                    <ul class=" page-content">
                        <li v-for="(item,index) in addClientList" v-if="item.write_viewable"><label class="label_name" :class="{ 'necessary': item.necessary}">@{{item.name}}
                                ：</label><span class="add_name selectWidth">
                        <input v-if="item.type == 'input'" :name="item.field" type="text"
                               class="text_add form-control height-auto"/>
                        <select v-else-if="item.type == 'select'" :name="item.field" class="text_add form-control ml10 height-auto">
                            {{--<option disabled value="">请选择</option>--}}
                            <template v-for="list in item.data">
                                <option>@{{list.value}}</option>
                            </template>
                        </select>
                        <textarea v-else-if="item.type == 'textarea'" :name="item.field" class="text_add form-control ml10 height-auto">
                        </textarea>
                        <div class="row" v-else-if="item.type == 'select&search'" style="position: relative">
                          <div class="col-lg-12 col-md-12 col-xs-12" style="padding-left: 0px">
                            <div class="input-group">
                                {{--<input type="hidden" :data-count="count" :name="item.field" value="">--}}
                                <input type="hidden" :data-count="count" :name="item.field" value="">
                              <input type="text" class="form-control height-auto search-text" :data-index="index"
                                     @keyup="changeList($event)" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button class="btn btn-primary ptb0 search-btn" type="button"
                                        @click="changeList($event)">搜索</button>
                              </span>
                            </div><!-- /input-group -->
                              <div class="text_add form-control ml10 height-auto" style="position: absolute;top: 30px;padding: 0px;border: 0px;">
                                <ul class="dropdown-menu" role="menu" v-show="item.showLength" style="display: block;">
                                {{--<ul class="dropdown-menu" role="menu" v-show="item.showLength" style="display: block;">--}}
                                    <li>
                                        <a v-for="list in item.data" v-show="list.show" @click="changeSearchModel($event)" :data-id="list.id" href="javascript:void(0);">@{{list.name}}</a>
                                        {{--<a v-for="list in item.data" v-show="list.show" href="javascript:void(0);">@{{list.name}}</a>--}}
                                    </li>
                                </ul>
                             </div>
                          </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                                {{--<input v-else="item.type == 'input'"  name="用户名" type="text" class="text_add"/>--}}
                        {{--<template v-else>--}}
                        <template v-else>
                            <select v-if="item.field == 'province'" :name="item.field" :class="item.field" class="text_add form-control ml10 height-auto" v-model="pname" @change="prochange()">
                                <option :value="v.name" v-for="v in pro">@{{v.name}}</option>
                            </select>
                            <select v-else-if="item.field == 'city'" :name="item.field" :class="item.field" class="text_add form-control ml10 height-auto" v-model="cname" @change="citychange()">
                                <option :value="v.name" v-for="v in city">@{{v.name}}</option>
                            </select>
                            <select v-else :name="item.field" :class="item.field" class="text_add form-control ml10 height-auto" v-model="ccname">
                                <template  v-if="county.length>0">
                                <option :value="v.name" v-for="v in county">@{{v.name}}</option>
                                    </template>
                            </select>
                        </template>
                            {{--<select class="pro" v-model="pid" @change="prochange()">
                                <option :value="v.id" v-for="v in pro">{{v.name}}</option>
                            </select>省
                            <select v-else-if="item.type == 'select&chain'" class="city" v-model="cid" @change="citychange()">
                                <option :value="v.id" v-for="v in city">{{v.name}}</option>
                            </select>市

                            <template  v-if="county.length>0">
                            <select class="county" v-model="ccid">
                                <option :value="v.id" v-for="v in county">{{v.name}}</option>
                            </select>县/区
                            </template>--}}
                        {{--</template>--}}
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  base scripts -->
    <script src="{{ asset('js/WorkStation/client.js')}}"></script>
@endsection