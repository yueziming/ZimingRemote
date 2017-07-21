/**
 * Created by Iceman on 2017-7-5.
 */

var Api = {
    // 获取部门用户树
    getDepartment: '/workstation/user/get-tree',
    // 获取用户角色列表
    getRoleByUser: '/workstation/user/get-role-by-user/{user_id}',
    //获取角色列表
    getRoleList: '/workstation/role/get-list',
    //角色管理-获取角色对应用户列表
    getRolesUserList: '/workstation/role/manage/get-user-by-role/{role_id}',
    //角色管理-获取角色对应的权限列表
    getRoleRightsList: '/workstation/role/get-permission/{role_id}',
    //获取用户的独立权限列表
    getPermission: '/workstation/user/get-permission/{user_id}',
    //获取登录用户名
    getLoginUserInfo: '/get-login-user',
    // 用户的独立授权
    userGrant: '/workstation/user/grant/{user_id}',
    // 收回用户的独立授权
    userRevoke: '/workstation/user/revoke/{user_id}',
    //角色授权地址
    roleGrant: '/workstation/role/grant/{role_id}',
    //角色取消授权
    roleRevoke: '/workstation/role/revoke/{role_id}',
    // 绑定用户和Socket标识
    socketBind: '/workstation/socket/bind',
    // 注销
    logout: '/logout',
    //获取客户字段列表
    getClientFieldList: '/workstation/client/get-field-list',
    //创建客户信息
    createClientInfo: '/workstation/client/save',
    // 获取区域列表
    getArea: '/workstation/k3/get-area',
    // 获取部门带同步数据
    getInputList: '/workstation/k3/department/get-input-list/{area}'

};
