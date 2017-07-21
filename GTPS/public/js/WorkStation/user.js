$(function () {
    /**
     * 隐藏显示左侧用户树
     */
    $("#products_style").fix({
        float: 'left',
        //minStatue : true,
        skin: 'green',
        durationTime: false,
        spacingw: 30,//设置隐藏时的距离
        spacingh: 260,//设置显示时间距
    });

    /**
     * other
     */
    // 初始化获取用户部门树
    getUserTree('');

    $('#keyword').on('keyup', function (e) {
        var keyword = $(this).val();
        $('#treeDemo_user').html('');
        if (keyword != '') {
            // 模糊查询
            User.data.arr = [];
            var zNodes_user = fuzzy_query(keyword);
            $.fn.zTree.init($("#treeDemo_user"), setting_user, zNodes_user);
        } else {
            $.fn.zTree.init($("#treeDemo_user"), setting_user, User.data.storageUserList);
        }

    })
});

var User = {
    template: {
        roleBtn: '<li>\n    <div class="tab-img">\n        <div class="default-btn">\n            <button class="btn role-btn" data-rid="*rid*" data-uid="*uid*">*role*</button>\n        </div>\n    </div>\n</li>'
    },
    data: {
        arr: [], // 储存部门用户的数组
        arr_power: [], // 储存权限的数组
        storageUserList: [], // 储存本地部门用户的数组
        currentUserId: '', // 储存选中当前用户

    }
};


// 1
// 用户树状图的脚本设置    for  user
var setting_user = {
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        onClick: zTreeOnClick
    }
};
/**
 *  点击部门用户树中的用户，获取角色列表   for  user
 * @param event
 * @param treeId
 * @param treeNode  点击节点的数据
 */
function zTreeOnClick(event, treeId, treeNode) {
    if (treeNode.isUser) {
        $('#treeDemo').html('');
        User.data.currentUserId = treeNode.userId;
        var $user_name = $('#user_name'); // DOM 角色列表，用户姓名
        var $code = $('#code'); // DOM 角色列表，编码
        var $tab_box_list = $('.tab-box-list'); // DOM 角色列表
        var $independent_power = $('#independent-power'); // DOM 独立权限按钮
        $tab_box_list.html(''); // 初始化清空角色列表
        $user_name.text(treeNode.name); // 定义用户姓名
        $code.text(treeNode.id); // 定义用户id
        var userId = treeNode.userId; // 辅助用户ID
        $independent_power.attr('data-id', userId); // 定义独立权限的id
        // 获取用户的角色
        var submit_url = Api.getRoleByUser.replace('{user_id}', userId);
        Common.ajax(submit_url, "get", {}, function (res) {
            if (res) {
                var str = '<li>\n    <div class="tab-img">\n        <div class="default-btn">\n            <button class="btn btn-primary active" id="independent-power" data-id=' + userId + '>独立权限详情</button>\n        </div>\n    </div>\n</li>';
                var template = User.template.roleBtn; // 角色按钮的模板
                $.each(res, function (index, value) {
                    str += template.replace('*rid*', value.ID).replace('*uid*', userId).replace('*role*', value.Name);
                })
            }
            $tab_box_list.html(str);
            $('.role-btn').off('click').on('click', function () {
                $treeDemo = $('#treeDemo');
                $treeDemo.html('');
                var rid = $(this).attr('data-rid');
                var name = $(this).text();
                var $role_name = $('#role-name');
                $role_name.text(name);
                User.data.arr_power = [];
                getRolePowerList(rid);
            })
            //独立授权按钮点击
            $('#independent-power').on('click', function () {
                var $treeDemo = $('#treeDemo');
                $treeDemo.html('');
                var userId = $(this).attr('data-id');
                var name = $(this).text();
                var $role_name = $('#role-name');
                User.data.arr_power = [];
                if (userId) {
                    $role_name.text(name);
                    getIndependentPowerList(userId);
                } else {
                    layer.alert('请选择用户！', {
                        title: '错误提示',
                        icon: 2,
                    });
                }

            });
        });
    }
};

/**
 *  获取部门用户树  for  user
 * @param keyword
 */
function getUserTree(keyword) {
    if (!(keyword === undefined || keyword === '')) keyword = encodeURI(keyword);
    Common.ajax(Api.getDepartment, "get", {keyword: keyword}, function (res) {
        var zNodes_user = getDepartmentUserData(res);
        User.data.storageUserList = zNodes_user;
        // 用户树状图
        $.fn.zTree.init($("#treeDemo_user"), setting_user, User.data.storageUserList);
    });
}
//部门用户树数据获取 -- 递归  for user
function getDepartmentUserData(data) {
    var id = '', pId = '', name = '', icon = '', isUser, userId = '', pinyin = '', wubi = '';
    for (var i = 0; i < data.length; i++) {
        if (data[i].BCE03 === undefined) {
            id = data[i].BCK01;
            pId = data[i].BCK01A;
            name = data[i].BCK03;
            icon = "../../assets/Widget/zTree/css/zTreeStyle/img/diy/house.png";
            isUser = false;
        } else {
            id = data[i].BCE02;
            pId = data[i].BCK01;
            name = data[i].BCE03;
            icon = "../../assets/Widget/zTree/css/zTreeStyle/img/diy/user.png";
            isUser = true;
            userId = data[i].ID;
            pinyin = data[i].ABBRP;
            wubi = data[i].ABBRW;
        }

        try {
            if (data[i]._list.length > 0) {
                // 如果data[i]._list（部门列表）长度大于0
                getDepartmentUserData(data[i]._list);
                if (data[i]._userList === undefined) {
                } else {
                    // 如果data[i]._userList（用户列表）存在且长度大于0
                    getDepartmentUserData(data[i]._userList);
                }
            } else {
                // 如果data[i]._list（部门列表）长度等于0
                if (data[i]._userList === undefined) {
                } else {
                    // 如果data[i]._userList（用户列表）存在且长度大于0
                    getDepartmentUserData(data[i]._userList);
                }
            }
        }
        catch
            (err) {
        }
        User.data.arr.push({
            id: id,
            pId: pId,
            name: name,
            icon: icon,
            isUser: isUser,
            userId: userId,
            pinyin: pinyin,
            wubi: wubi
        })

    }
    return User.data.arr;
}
// 模糊查询
function fuzzy_query(keyword) {
    var storageUserList = User.data.storageUserList, arr = [];
    var reg = new RegExp(keyword);
    $.each(storageUserList, function (index, value) {
        if (value.isUser) {
            if (value.name.match(reg) || value.pinyin.match(reg) || value.id.match(reg) || value.wubi.match(reg)) {
                arr.push(value);
            }
        }
    });
    return arr;
}


// 2 角色授权的脚本设置
var setting_role_power = {
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        beforeCheck: zTreeOnCheck
    }
};
// 权限树不可编辑
function zTreeOnCheck(event, treeId, treeNode) {
    return false;
};
/**
 *  获取角色权限列表
 * @param roleID
 */
function getRolePowerList(roleID) {
    var submit_url = Api.getRoleRightsList.replace('{role_id}', roleID);
    Common.ajax(submit_url, "get", {}, function (res) {
        var zNodes_role_power = getPowerData(res);
        // 权限树状图
        $.fn.zTree.init($("#treeDemo"), setting_role_power, zNodes_role_power);
    });
}
// 遍历权限数组
function getPowerData(data) {
    var id = '', pId = '', name = '', icon = '', checked;
    for (var i = 0; i < data.length; i++) {
        id = data[i].id;
        pId = data[i].parent_id;
        name = data[i].name;
        icon = "../../assets/Widget/zTree/css/zTreeStyle/img/diy/roleicon.png";
        checked = data[i].granted;
        try {
            if (data[i]._list.length !== undefined) {
                getPowerData(data[i]._list);
            }
        }
        catch
            (err) {
        }
        User.data.arr_power.push({
            id: id,
            pId: pId,
            name: name,
            icon: icon,
            checked: checked
        })

    }
    return User.data.arr_power;
}


/** 3
 * 独立授权
 */
var setting_independent_power = {
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        onCheck: zTreeOnCheckindependent
    }
};
// 权限树可编辑 -- 独立权限
function zTreeOnCheckindependent(event, treeId, treeNode) {
    var userID = User.data.currentUserId; // 当前用户的ID
    var powerID = treeNode.id;
    var treeObj = $.fn.zTree.getZTreeObj("treeDemo"),
        nodes = treeObj.transformToArray(treeNode);
    var arr_permission = new Array();
    for (var i = 0; i < nodes.length; i++) {
        arr_permission[i] = nodes[i].id;
    }
    arr_permission = arr_permission.join(",");
    var submit_url = '';
    if (treeNode.checked === true) {
        // 选中
        submit_url = Api.userGrant.replace('{user_id}', userID);
        Common.ajax(submit_url, "post", {permission: arr_permission}, function (res) {
            if (res.status) {
                layer.alert('授权成功!', {
                    title: '提示',
                    icon: 1,
                });
            } else {
                layer.alert(res.message, {
                    title: '提示',
                    icon: 2,
                });
            }
        });
    } else {
        // 取消选中
        submit_url = Api.userRevoke.replace('{user_id}', userID);
        Common.ajax(submit_url, "patch", {userID: userID, permission: arr_permission}, function (res) {
            if (res.status) {
                layer.alert('取消授权成功!', {
                    title: '提示',
                    icon: 1,
                });
            } else {
                layer.alert(res.message, {
                    title: '提示',
                    icon: 2,
                });
            }
        });
    }
};
/**
 *  获取角色权限列表
 * @param userID
 */
function getIndependentPowerList(userID) {
    var submit_api = Api.getPermission.replace('{user_id}', userID);
    Common.ajax(submit_api, "get", {}, function (res) {
        var zNodes_independent_power = getPowerData(res);
        console.log(res);
        // 权限树状图
        $.fn.zTree.init($("#treeDemo"), setting_independent_power, zNodes_independent_power);
    });
}