/**
 * Created by yueziming on 2017-8-21.
 */
function interface(pathname,request,response) {
     if(pathname == "/myrouter"){
         response.write("This is running in myrouter page");
     }else{
         response.write("This is running in other page")
     }
};
exports.interface = interface;