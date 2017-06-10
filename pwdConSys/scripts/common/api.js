/**
 * Created by yueziming on 2017-6-8.
 */

var Api = {
	//url基础配置
//	baseUrl:'https://192.168.0.70:8443/',
	url:{
		//登录接口
		LOGIN:'https://192.168.0.70:8443/oauth/token',
		//左侧菜单接口
		LEFTMENU:'https://192.168.0.70:8443/api/menu-index',
		//主页表格接口
		INDEXTABLE:'https://192.168.0.70:8443/content/ajaxindex/',
		//权限管理页面接口
		RIGHTMANAGEMENT:"https://192.168.0.70:8443/api/permission-index",
		//创建权限字段接口
		PERMISSION:"https://192.168.0.70:8443/api/permission-create",
		//创建权限接口
		CREATERIGHT:"https://192.168.0.70:8443/api/permission-store",
		//编辑权限接口
		EDITRIGHT:"https://192.168.0.70:8443/api/permission-edit-",
		//修改权限接口
		MODIFYRIGHT:"https://192.168.0.70:8443/api/permission-update-",
		//删除权限接口
		DELRIGHT:"https://192.168.0.70:8443/api/permission-delete-",
		//用户管理界面接口
		USERINFO:"https://192.168.0.70:8443/api/user-index",
		//添加用户接口
		ADDUSER:"https://192.168.0.70:8443/api/user-store",
		//角色列表页面接口
		ROLELIST:"https://192.168.0.70:8443/api/role-index",
		//获取角色接口
		GETROLE:"https://192.168.0.70:8443/api/role-create",
		//创建角色接口
		CREATEROLE:"https://192.168.0.70:8443/api/role-store",
	},
	localJson:{
		//左侧菜单接口
		LEFTMENU:'json/menu.json',
		//主页表格接口
		INDEXTABLE:'json/test.json'
	}
};