@extends('Workstation.Public.public')

@section('content')
    <div class="margin clearfix">
    <div class="Guestbook_style">
        <div class="search_style">

            <ul class="search_content clearfix">
                <li><label class="l_f">留言</label><input name="" type="text" class="text_add" placeholder="输入留言信息" style=" width:250px"></li>
                <li><label class="l_f">时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
                <li style="width:90px;"><button type="button" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
            </ul>
        </div>
        <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:ovid()" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;批量删除</a>
        <a href="javascript:ovid()" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>&nbsp;已浏览</a>
        <a href="javascript:ovid()" class="btn btn-yellow"><i class="fa fa-times"></i>&nbsp;未浏览</a>
       </span>
            <span class="r_f">共：<b>2334</b>条</span>
        </div>
        <!--留言列表-->
        <div class="Guestbook_list">
            <table class="table table-striped table-bordered table-hover" id="sample-table">
                <thead>
                <tr>
                    <th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
                    <th width="80">ID</th>
                    <th width="150px">用户名</th>
                    <th width="">留言内容</th>
                    <th width="200px">时间</th>
                    <th width="70">状态</th>
                    <th width="250">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                    <td>1</td>
                    {{--<td><u style="cursor:pointer"  class="text-primary" onclick="member_show('张小泉','member-show.html','1031','500','400')">张小泉</u></td>--}}
                    <td><span class="text-primary">张小泉</span></td>
                    <td class="text-l">
                        <a href="javascript:;" onclick="Guestbook_iew('12')">“第二届中国无锡水蜜桃开摘节”同时开幕，为期三个月的蜜桃季全面启动。值此京东“618品质狂欢节”之际，中国特产无锡馆限量上线618份8只装精品水蜜桃，61.8元全国包邮限时抢购。为了保证水蜜桃从枝头到达您的手中依旧鲜甜如初，京东采用递送升级服务，从下单到包装全程冷链运输。</a>
                    <td>2016-6-11 11:11:42</td>
                    <td class="td-status"><span class="label label-success radius">已浏览</span></td>
                    <td class="td-manage">
                        <a onClick="member_stop(this,'10001')"  href="javascript:;" title="已浏览"  class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a>
                        <a  onclick="member_edit('回复','member-add.html','4','','510')" title="回复"  href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
                        <a  href="javascript:;"  onclick="member_del(this,'1')" title="删除" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <!--留言详细-->
    <div id="Guestbook" style="display:none">
        <div class="content_style">
            <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">留言用户 </label>
                <div class="col-sm-9">胡海天堂</div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 留言内容 </label>
                <div class="col-sm-9">三年同窗，一起沐浴了一片金色的阳光，一起度过了一千个日夜，我们共同谱写了多少友谊的篇章?愿逝去的那些闪亮的日子，都化作美好的记忆，永远留在心房。认识您，不论是生命中的一段插曲，还是永久的知已，我都会珍惜，当我疲倦或老去，不再拥有青春的时候，这段旋律会滋润我生命的每一刻。在此我只想说：有您真好!无论你身在何方，我的祝福永远在您身边!</div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">是否回复 </label>
                <div class="col-sm-9">
                    <label><input name="checkbox" type="checkbox" class="ace" id="checkbox"><span class="lbl"> 回复</span></label>
                    <div class="Reply_style">
                        <textarea name="权限描述" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea>
                        <span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <script type="text/javascript">

    </script>
    <!--  base scripts -->
    <script src="{{ asset('js/WorkStation/message.js')}}"></script>
@endsection