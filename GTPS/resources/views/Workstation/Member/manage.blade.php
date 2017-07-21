@extends('Workstation.Public.public')

@section('content')
<div class="page-content clearfix" id="layout-2">
    <div class="flat-type">
        <div class="function-wrap clearfix">
       <span class="l_f">
        <a @click="addCustomer" title="添加品牌" class="btn btn-warning Order_form"><i class="icon-plus"></i>成为会员</a>
        <a href="javascript:void(0)" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>
            <span class="r_f">共：<b>234</b>个会员</span>
        </div>

        <div class="flat_list clearfix" id="category">
            <div class="table_menu_list2">
                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label>
                        </th>
                        <th width="80px">ID</th>
                        <th width="50px">卡号</th>
                        <th width="120px">会所</th>
                        <th width="120px">基本余额</th>
                        <th width="130px">赠送余额</th>
                        <th width="350px">积分余额</th>
                        <th width="180px">押金</th>
                        <th width="70px">门诊号</th>
                        <th width="300px">姓名</th>
                        <th width="300px">出生日期</th>
                        <th width="300px">年龄</th>
                        <th width="300px">病人类别</th>
                        <th width="300px">病人费用</th>
                        <th width="300px">移动电话</th>
                        <th width="300px">创建事件</th>
                        <th width="300px">有效时间</th>
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
                            1
                        </td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--添加用户图层-->
            <div class="add_menber" id="add_menber_style" style="display:none">
            </div>
        </div>
    </div>
</div>
<!--  base scripts -->
<script src="{{ asset('js/WorkStation/member-manage.js')}}"></script>
@endsection