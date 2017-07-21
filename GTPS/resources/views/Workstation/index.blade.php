@extends('Workstation.Public.public')

@section('content')
<div class="page-content clearfix">
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
        <i class="icon-ok green"></i>欢迎使用<strong class="green">后台管理系统
        <small>(v1.2)</small>
    </strong>,你本次登陆时间为2016年7月12日13时34分，登陆IP:192.168.1.110.
    </div>
    <div class="state-overview clearfix">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <a href="#" title="商城会员">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>
                    <div class="value">
                        <h1>34522</h1>
                        <p>商城用户</p>
                    </div>
                </a>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol red">
                    <i class="icon-tags"></i>
                </div>
                <div class="value">
                    <h1>140</h1>
                    <p>分销记录</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol yellow">
                    <i class="icon-shopping-cart"></i>
                </div>
                <div class="value">
                    <h1>345</h1>
                    <p>商城订单</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="value">
                    <h1>￥34,500</h1>
                    <p>交易记录</p>
                </div>
            </section>
        </div>
    </div>
    <!--实时交易记录-->
    <div class="clearfix">
        <div class="Order_Statistics ">
            <div class="title_name">订单统计信息</div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td class="name">未处理订单：</td>
                    <td class="munber"><a href="#">0</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">待发货订单：</td>
                    <td class="munber"><a href="#">10</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">待结算订单：</td>
                    <td class="munber"><a href="#">13</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">已成交订单数：</td>
                    <td class="munber"><a href="#">26</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">交易失败：</td>
                    <td class="munber"><a href="#">26</a>&nbsp;个</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="Order_Statistics">
            <div class="title_name">商品统计信息</div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td class="name">商品总数：</td>
                    <td class="munber"><a href="#">340</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">回收站商品：</td>
                    <td class="munber"><a href="#">10</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">上架商品：</td>
                    <td class="munber"><a href="#">13</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">下架商品：</td>
                    <td class="munber"><a href="#">26</a>&nbsp;个</td>
                </tr>
                <tr>
                    <td class="name">商品评论：</td>
                    <td class="munber"><a href="#">21s6</a>&nbsp;条</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="Order_Statistics">
            <div class="title_name">会员登陆统计信息</div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td class="name">注册会员登陆：</td>
                    <td class="munber"><a href="#">3240</a>&nbsp;次</td>
                </tr>
                <tr>
                    <td class="name">新浪会员登陆：</td>
                    <td class="munber"><a href="#">1130</a>&nbsp;次</td>
                </tr>
                <tr>
                    <td class="name">支付宝登陆：</td>
                    <td class="munber"><a href="#">1130</a>&nbsp;次</td>
                </tr>
                <tr>
                    <td class="name">QQ会员登陆：</td>
                    <td class="munber"><a href="#">1130</a>&nbsp;次</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!--<div class="t_Record">
          <div id="main" style="height:300px; overflow:hidden; width:100%; overflow:auto" ></div>
         </div> -->
        <div class="news_style">
            <div class="title_name">最新消息</div>
            <ul class="list">
                <li><i class="icon-bell red"></i><a href="#">后台系统找那个是开通了。</a></li>
                <li><i class="icon-bell red"></i><a href="#">6月共处理订单3451比，作废为...</a></li>
                <li><i class="icon-bell red"></i><a href="#">后台系统找那个是开通了。</a></li>
                <li><i class="icon-bell red"></i><a href="#">后台系统找那个是开通了。</a></li>
                <li><i class="icon-bell red"></i><a href="#">后台系统找那个是开通了。</a></li>
            </ul>
        </div>
    </div>

</div>
<!--  base scripts -->
<script src="{{ asset('js/WorkStation/index.js')}}"></script>
@endsection