<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

class IndexController extends Controller
{
    public function index(){
        return view('index');
    }

    public function store(Request $request){

        $file = $request->file('photo') ;
        if(!$file){
            return redirect()->back()->with('msg','图片或者文件不可为空，请选择图片或者文件！');
        }

        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = "";
        $secretKey ="";

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        // 要上传的空间
        $bucketName = "test";

        // 生成上传 Token
        $token = $auth->uploadToken($bucketName);

        // 要上传文件的本地路径
        $filePath = $file->getRealPath();

        // 文件后缀
        $ext = $file->getClientOriginalExtension();

        // 上传到七牛后保存的文件名
        $key = time().rand(999,9999).'.'.$ext;

        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);

        if ($err !== null)
        {
            return redirect('index')->with('msg','图片或者文件传失败并且KEY是否正确！');
        }else{
            //这里可以把数据写入数据库等等操作...
            return redirect('index')->with('msg','图片或者文件传成功！http://7xrxc6.com1.z0.glb.clouddn.com/'.$ret['key'].'');
        }

    }

}
