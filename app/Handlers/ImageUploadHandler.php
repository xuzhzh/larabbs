<?php
namespace APP\Handlers;
class ImageUploadHandler{

    //只允许以下后罪名的图片我呢见上传
    protected $allowed_ext = ['png','jpg','gif','jpeg'];

    public function save($file,$folder,$file_prefix)
    {
        //构建存储文件夹规则
        //文件夹切割能让查找效率
        $folder_name ="uploads/images/$folder/".date("Ym/d",time());

        $upload_path = public_path().'/'.$folder_name;

        //保证后缀名一直存在
        $extension =strtolower($file->getClientOriginalExtension())?:'png';

        //拼接文件名

        $filename = $file_prefix.'_'.time().'_'.str_random(10).'.'.$extension;
        
        //如果上传不是图片终止操作

        if(!in_array($extension,$this->allowed_ext))
        {
            return false;
        }

        //将图片移动到我们目标存储路径中

        $file->move($upload_path,$filename);

        return [
            'path' =>config('app.url')."/$folder_name/$filename"
        ];


    }
}