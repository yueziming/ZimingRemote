@extends('Workstation.Public.public')
{{--<link rel="stylesheet" href=" {{ asset('css/client.css') }} "/>--}}
@section('content')
    <div class="page-content clearfix" id="layout-2">
        <div class="flat-type">
            <div class="function-wrap clearfix">
       <span class="l_f">
        <a @click="addCustomer" title="添加品牌" class="btn btn-primary Order_form"><i class="icon-plus"></i>客户登记</a>
        <a @click="addCustomer" title="添加品牌" class="btn btn-primary Order_form"><i class="icon-book"></i>字段定义</a>
        <a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-phone"></i>批量预约确认</a>
        <a href="javascript:void(0)" class="btn btn-success"><i class="icon-envelope"></i>批量发送短信</a>
        <a @click="batchDel" href="javascript:void(0)" class="btn btn-danger"><i class="icon-minus"></i>批量删除</a>
           {{--<a href="javascript:void(0)" class="btn btn-success">国外品牌</a>--}}
       </span>
                <span class="r_f">共：<b>@{{pageCount}}</b>条数据</span>
            </div>
            <div class="row" style="margin-bottom: 4px;">
                <div class="col-sm-6">
                    <div class="dataTables_length" id="sample-table_length"><label>每页显示条数: <select
                                    name="sample-table_length" aria-controls="sample-table" id="page_record_count" v-model="pageRecordCount">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select></label></div>
                </div>
                <div class="col-sm-6">
                    <div id="sample-table_filter" class="dataTables_filter"><input type="search" class=""
                                                                                   placeholder=""
                                                                                   aria-controls="sample-table" id="keyword" v-model="keyword" @keyup.enter="searchKeyword">
                        <button type="button" class="btn btn-primary"
                                style="padding: 0px 10px;border-radius:0px;bottom: 2px;" @click="searchKeyword">搜索
                        </button>
                    </div>
                </div>
            </div>
            <div class="flat_list clearfix" id="category">
                <div class="table_menu_list2">
                    <table class="table table-striped table-bordered table-hover" id="sample-table">
                        <thead>
                        <tr>
                            <th width="25px"><label><input @click="changeCheckbox($event)" type="checkbox"
                                                           class="ace all-check"><span class="lbl"></span></label>
                            </th>
                            <th v-for="item in clientListTitle">@{{item}}</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in clientListContent">
                            <td width="25px"><label><input @click="changeCheckbox($event)" type="checkbox"
                                                           class="ace checkbox"><span class="lbl"></span></label>
                            </td>
                            <template v-for="(data,index) in item">
                                <td v-if="index == 'id'" style="display: none">@{{data}}</td>
                                <td v-else>@{{data}}</td>
                            </template>
                            <td class="td-manage" style="width: 220px;">
                                <div class="btn-group" role="group" aria-label="...">
                                    <div class="text-center">
                                        <button @click="appointment($event)" v-show="true" type="button"
                                                class="btn btn-success change-btn float_left mr2">预约
                                        </button>
                                        {{--<button @click="cancelAppointment($event)" v-show="true" type="button" class="btn btn-default change-btn float_left mr2">取消预约</button>--}}
                                        <button type="button" class="btn btn-primary change-btn float_left mr2"
                                                @click="modifyClientInfo($event)">修改
                                        </button>
                                        <button type="button" class="btn btn-danger change-btn float_left mr2" @click="deleteClientInfo($event)">删除
                                        </button>
                                        <button type="button" @click="goDetailPage($event)"
                                                class="btn btn-primary change-btn float_left mr2">详情
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-xs-4 col-md-4 col-lg-4">
                        <span>共<i class="page-text">@{{pagesize}}</i>页，当前第<i
                                    class="page-text">@{{pageCurrent}}</i>页</span>
                    </div>
                    <div class="col-md-8 col-xs-8 col-lg-8">
                        <ul class="pagination pull-right">
                            <li class="start_page_btn"><a href="javascript:void(0)" @click="toStartPage">首页</a></li>
                            <li class="prev_page_btn disabled"><a href="javascript:void(0)" @click="prevPage">上一页</a>
                            </li>
                            <li v-for="count in countPages" :class="'page_'+count" class="pages"><a
                                        href="javascript:void(0)" @click="changePage($event)">@{{count}}</a></li>
                            <li class="next_page_btn"><a href="javascript:void(0)" @click="nextPage">下一页</a></li>
                            <li class="end_page_btn"><a href="javascript:void(0)" @click="toEndPage">末页</a></li>
                        </ul>
                    </div>
                </div>
                <!--添加用户图层-->
                <add-dialog :data="addClientList" :outid="'add_menber_style'" :outclass="'add_menber'" :formid="'addClient'">

                </add-dialog>
            <!--登记预约信息-->
                {{--<add-dialog :data="appointmentClientList" :outid="'add_appointment_info'" :outclass="'add_menber'" :formid="'appClient'">

                </add-dialog>--}}
                <div class="add_menber" id="add_appointment_info" style="display:none;padding: 0 20px;margin-top: 10px">
                    <form id="appClient">
                        <div class="panel panel-default">
                            <div class="panel-heading">基本信息</div>
                                <div class="panel-body">
                                    <ul class=" page-content">
                                        <template v-for="(item,index) in appointmentClientList.reservation">
                                            <li v-if="item.field != 'reservation[department_id]'">
                                                <label class="label_name2" :class="{ 'necessary': item.is_necessary}">@{{item.name}}
                                                    ：</label><span class="add_name selectWidth">
                                    <input v-if="item.type == 'input'" :name="item.field" type="text"
                                           class="text_add form-control height-auto"/>
                                    <select v-else-if="item.type == 'select'" :name="item.field"
                                            class="text_add form-control ml10 height-auto">
                                        <template v-for="list in item.data">
                                            <option>@{{list.value}}</option>
                                        </template>
                                    </select>
                                    <select v-else-if="item.type == 'select&id'" :name="item.field"
                                                            class="text_add form-control ml10 height-auto">
                                        <template v-for="list in item.data">
                                            <option :value="list.id">@{{list.value}}</option>
                                        </template>
                                    </select>
                                    <textarea v-else-if="item.type == 'textarea'" :name="item.field"
                                              class="text_add form-control ml10 height-auto">
                                    </textarea>
                                    <div class="row" v-else-if="item.type == 'select&search'" style="position: relative">
                                      <div class="col-lg-12 col-md-12 col-xs-12" style="padding-left: 0px">
                                        <div class="input-group">
                                            <input type="hidden" :data-count="count" :name="item.field" value="">
                                          <input type="text" class="form-control height-auto search-text" :data-index="index"
                                                 @keyup.enter="changeSearch($event)" placeholder="Search for...">
                                          <span class="input-group-btn">
                                            <button class="btn btn-primary ptb0 search-btn" type="button"
                                                    @click="changeSearch($event)">搜索</button>
                                          </span>
                                        </div>
                                          <div class="text_add form-control ml10 height-auto"
                                               style="position: absolute;top: 30px;padding: 0px;border: 0px;">
                                            <ul class="dropdown-menu" role="menu" v-show="item.showLength" style="display: block;max-height: 200px;overflow: auto;">
                                                <li>
                                                    <a v-for="list in item.data" v-show="list.show"
                                                       @click="changeSearchList($event)" :data-id="list.client_id"
                                                       href="javascript:void(0);">@{{list.value}}</a>
                                                </li>
                                            </ul>
                                         </div>
                                      </div><!-- /.col-lg-6 -->
                                    </div>
                                     <div v-else-if="item.type == 'date'" class="input-append date form_datetime">
                                        <input size="16" class="text_add" :name="item.field" style="width: 82%" type="text" value="" readonly>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                     </div>
                                </span>
                                                <div class="prompt r_f"></div>
                                            </li>
                                            <template v-else>
                                                <li>
                                                    <label class="label_name2" :class="{ 'necessary': item.is_necessary}">科室
                                                        ：</label><span class="add_name selectWidth">
                                                            <select name="reservation[department_id]" v-model="departmentId"
                                                                    class="text_add form-control ml10 height-auto">
                                                                <template v-for="list in item.data.department">
                                                                    <option :value="list.id">@{{list.value}}</option>
                                                                </template>
                                                            </select>
                                                        </span>
                                                    <div class="prompt r_f"></div>
                                                </li>
                                                <li>
                                                    <label class="label_name2" :class="{ 'necessary': item.is_necessary}">医生
                                                        ：</label><span class="add_name selectWidth">
                                                            <select name="reservation[doctor_id]"
                                                                    class="text_add form-control ml10 height-auto">
                                                                <template v-for="doctor in showDoctor">
                                                                    <option :value="doctor.id">@{{doctor.value}}</option>
                                                                </template>
                                                            </select>
                                                        </span>
                                                    <div class="prompt r_f"></div>
                                                </li>
                                            </template>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">附加信息</div>
                            <div class="panel-body">
                                <ul class=" page-content">
                                    <template v-for="(item,index) in appointmentClientList.reservation_additional">
                                        <li v-if="item.field != 'province'">
                                            <label class="label_name2" :class="{ 'necessary': item.is_necessary}">@{{item.name}}
                                                ：</label><span class="add_name selectWidth">
                                    <input v-if="item.type == 'input'" :name="item.field" type="text"
                                           class="text_add form-control height-auto"/>
                                    <select v-else-if="item.type == 'select'" :name="item.field"
                                            class="text_add form-control ml10 height-auto">
                                        <template v-for="list in item.data">
                                            <option>@{{list.value}}</option>
                                        </template>
                                    </select>
                                    <textarea v-else-if="item.type == 'textarea'" :name="item.field"
                                              class="text_add form-control ml10 height-auto">
                                    </textarea>
                                    <div class="row" v-else-if="item.type == 'select&search'" style="position: relative">
                                      <div class="col-lg-12 col-md-12 col-xs-12" style="padding-left: 0px">
                                        <div class="input-group">
                                            <input type="hidden" :data-count="count" :name="item.field" value="">
                                          <input type="text" class="form-control height-auto search-text" :data-index="index"
                                                 @keyup="changeList($event)" placeholder="Search for...">
                                          <span class="input-group-btn">
                                            <button class="btn btn-primary ptb0 search-btn" type="button"
                                                    @click="changeSearch($event)">搜索</button>
                                          </span>
                                        </div>
                                          <div class="text_add form-control ml10 height-auto"
                                               style="position: absolute;top: 30px;padding: 0px;border: 0px;">
                                            <ul class="dropdown-menu" role="menu" v-show="item.showLength" style="display: block;">
                                                <li>
                                                    <a v-for="list in item.data" v-show="list.show"
                                                       @click="changeSearchList($event)" :data-id="list.id"
                                                       href="javascript:void(0);">@{{list.name}}</a>
                                                </li>
                                            </ul>
                                         </div>
                                      </div><!-- /.col-lg-6 -->
                                    </div>
                                </span>
                                            <div class="prompt r_f"></div>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <!--修改信息-->
                <mod-dialog :data="modClientField" :outid="'modify_client_info'" :outclass="'add_menber'" :formid="'modClient'">

                </mod-dialog>
            </div>
        </div>
    </div>
    <!--  base scripts -->
    <script src="{{ asset('js/Bootstrap/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/WorkStation/client.js')}}"></script>
    <script src="{{ asset('js/component/ziming.dialogComponent.js')}}"></script>
@endsection