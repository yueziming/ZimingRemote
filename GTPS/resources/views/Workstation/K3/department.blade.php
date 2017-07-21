@extends('Workstation.Public.public')

@section('content')
<div class="page-content clearfix" id="layout-2">
    <div class="flat-type">
        <div class="search_style" id="search-wrap">
            <form action="">
                <ul class="search_content clearfix">
                    <li>
                        <label class="l_f">地址</label>
                        <select name="" id="" class=" inline" style="width: 200px;margin-left:10px;"
                                v-model="chose_area">
                            <option :value="index" v-for="(areai,index) in areas">@{{ areai }}</option>
                        </select>
                    </li>
                    <li><label class="l_f">开始时间</label><input class="inline laydate-icon" id="start"
                                                              style=" margin-left:10px;" v-model="start_time"></li>
                    <li><label class="l_f">结束时间</label><input class="inline laydate-icon" id="end"
                                                              style=" margin-left:10px;" v-model="end_time"></li>
                    <li style="width:90px;">
                        <button type="button" class="btn_search" id="search" @click="setSearch()"><i
                                class="icon-search"></i>查询
                        </button>
                    </li>
                </ul>
            </form>
            <button class="ab_right_btn btn-primary" @click="submitData()">同步金蝶数据</button>
        </div>
        <div class="flat_list clearfix" id="category">
            <div class="table_menu_list2">
                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="80px">ID</th>
                        <th width="50px">部门</th>
                        <!--<th width="120px">品牌LOGO</th>
                        <th width="120px">品牌名称</th>
                        <th width="130px">所属地区/国家</th>
                        <th width="350px">描述</th>
                        <th width="180px">加入时间</th>
                        <th width="70px">状态</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item,index) in list">
                        <td>@{{index + 1}}</td>
                        <td>@{{item.BCK03}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--添加用户图层-->
            <div class="add_menber" id="add_menber_style" style="display:none">
                <form id="addClient">
                </form>
            </div>
        </div>
    </div>
</div>
<!--  base scripts -->
<script src="{{ asset('js/WorkStation/k-department.js')}}"></script>
@endsection