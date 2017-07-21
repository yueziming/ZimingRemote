/**
 * Created by yueziming on 2017-7-5.
 */
//定义一个全局变量，记录选中的ROLE的ID
var selectedRoleId = '';
$(function () {
    $("#products_style").fix({
        float: 'left',
        //minStatue : true,
        skin: 'green',
        durationTime: false,
        spacingw: 30,//设置隐藏时的距离
        spacingh: 260,//设置显示时间距
    });
    /**
     *  树状图
     */
    var zNodesRole = [];
    //获取用户角色列表
    Common.ajax(Api.getRoleList, "get", {}, function (res) {
        console.log(res);
        //让第一个父节点展开
        var openFirstFlag = true;
        for (var i = 0; i < res.length; i++) {
            var znode = {};
            znode.name = res[i].name;
            /*znode.font = {'color': '#0016bb'};*/
            znode.icon = "../../assets/Widget/zTree/css/zTreeStyle/img/diy/house.png";
            znode.id = res[i].ID;
            if (openFirstFlag) {
                znode.open = true;
                openFirstFlag = false;
            }
            znode.children = [];
            for (var j = 0; j < res[i].list.length; j++) {
                var obj = {};
                obj.name = res[i].list[j].Name;
                obj.id = res[i].list[j].ID;
                obj.icon = "../../assets/Widget/zTree/css/zTreeStyle/img/diy/user.png";
                // obj.open = true;
                znode.children.push(obj);
            }
            zNodesRole.push(znode);
        }
        // 角色树状图
        $.fn.zTree.init($("#treeDemo_role"), settingRole, zNodesRole);
    });
    // 权限树状图
    $.fn.zTree.init($("#treeDemo"), settingPower, zNodesPower);
    //监控搜索文本框文本变动
    $("#search").on("keyup", function () {
        var val = $.trim($("#search").val());
        if (val == '') {
            // 角色树状图
            $.fn.zTree.init($("#treeDemo_role"), settingRole, zNodesRole);
        } else {
            search(val);
        }
    });

//实时搜索
    function search(keyword) {
        var searchNode = [];
        for (var i = 0; i < zNodesRole.length; i++) {
            if (zNodesRole[i].children.length > 0) {
                for (var j = 0; j < zNodesRole[i].children.length; j++) {
                    if (zNodesRole[i].children[j].name.indexOf(keyword) != -1) {
                        var obj = {};
                        obj.icon = zNodesRole[i].children[j].icon;
                        obj.name = zNodesRole[i].children[j].name;
                        obj.id = zNodesRole[i].children[j].id;
                        searchNode.push(obj);
                    }
                }
            }
        }
        // 角色树状图
        $.fn.zTree.init($("#treeDemo_role"), settingRole, searchNode);
    }

});

//递归获取角色对应的权限列表
function recursionJson(json) {
    for (var i = 0; i < json.length; i++) {
        var obj = {};
        obj.name = json[i].name;
        obj.id = json[i].id;
        obj.pId = json[i].parent_id;
        obj.icon = "../../assets/Widget/zTree/css/zTreeStyle/img/diy/roleicon.png";
        obj.checked = json[i].granted;
        zNodesPower.push(obj);
        if (json[i]["_list"].length > 0) {
            recursionJson(json[i]["_list"]);
        }
    }
}

// 用户树状图的脚本设置
var settingRole = {
    //页面上的显示效果
    view: {
        fontCss: getFont,
        nameIsHTML: true
    },
    callback: {
        onClick: zTreeOnClick
    },
};

//获取角色组ztree字体样式
function getFont(treeId, node) {
    return node.font ? node.font : {};
}

//角色组ztree点击事件
function zTreeOnClick(event, treeId, treeNode) {
    if (!treeNode.isParent) {
        $("#roles-user").empty();
        selectedRoleId = treeNode.id;
        //获取角色对应的用户组并显示
        var submit_url = Api.getRolesUserList.replace('{role_id}', selectedRoleId);
        Common.ajax(submit_url, "get", {}, function (res) {
            if (res) {
                $("#roles-user-name").text(treeNode.name);
                for (var i = 0; i < res.length; i++) {
                    var name = res[i].Name;
                    var code = res[i].Code;
                    var template = '<li class="role-userList-li" title="' + name + '  ' + code + '">' +
                        '<span class="icon-user-md icon-3x"></span></br><p class="userList-name">' + name + '</p><p class="userList-code">(' + code + ')</p>' +
                        '</li>';
                    $("#roles-user").append(template);
                }
            }
            console.log(res);
        });
        //获取角色对应的权限组并显示
        $("#treeDemo").empty();
        submit_url = Api.getRoleRightsList.replace('{role_id}', selectedRoleId);
        Common.ajax(submit_url, "get", {}, function (res) {
            console.log(res);
            zNodesPower = [];
            for (var i = 0; i < res.length; i++) {
                var znode = {};
                znode.name = res[i].name;
                znode.icon = "../../assets/Widget/zTree/css/zTreeStyle/img/diy/roleicon.png";
                znode.id = res[i].id;
                znode.pId = res[i].parent_id;
                znode.checked = res[i].granted;
                zNodesPower.push(znode);
                if (res[i]["_list"].length > 0) {
                    recursionJson(res[i]["_list"]);
                }
            }
            $.fn.zTree.init($("#treeDemo"), settingPower, zNodesPower);
        })
    }
};
// 独立授权的脚本设置
var settingPower = {
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        onCheck: zTreeOnCheck
    }
};
var zNodesPower = [];
var code;
function showCode(str) {
    if (!code) code = $("#code");
    code.empty();
    code.append("<li>" + str + "</li>");
};
function zTreeOnCheck(event, treeId, treeNode) {
    var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
        nodes = zTree.transformToArray(treeNode);
    var permissionIds = new Array();
    for (var i = 0; i < nodes.length; i++) {
        permissionIds[i] = nodes[i].id;
    }
    permissionIds = permissionIds.join(",");
    var submit_url = '';

    if (treeNode.checked) {
        // alert(treeNode.id + ", " + treeNode.name);
        submit_url = Api.roleGrant.replace('{role_id}', selectedRoleId);
        Common.ajax(submit_url, "post", {permission: permissionIds}, function (res) {
            if (res.status) {
                layer.alert('授权成功!', {
                    title: '提示',
                    icon: 1,
                });
            } else {
                layer.alert(res.message, {
                    title: '提示',
                    icon: 1,
                });
            }
            console.log(res);
        })
    } else {
        submit_url = Api.roleRevoke.replace('{role_id}', selectedRoleId);
        Common.ajax(submit_url, "patch", {permission: permissionIds}, function (res) {
            if (res.status) {
                layer.alert('取消授权成功!', {
                    title: '提示',
                    icon: 1,
                });
            } else {
                layer.alert(res.message, {
                    title: '提示',
                    icon: 1,
                });
            }
            console.log(res);
        })
    }
    /*if (treeNode.checked) {
     alert('选中');
     alert(treeNode.tId + ", " + treeNode.name);
     }*/
};