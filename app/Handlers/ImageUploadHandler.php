<?php
namespace APP\Handlers;
use Image;
class ImageUploadHandler{

    //只允许以下后罪名的图片我呢见上传
    protected $allowed_ext = ['png','jpg','gif','jpeg'];

    public function save($file,$folder,$file_prefix,$max_width = false)
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
        if ($max_width && $extension != 'gif') {

            // 此类中封装的函数，用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' =>config('app.url')."/$folder_name/$filename"
        ];


    }
    public function reduceSize($file_path,$max_width)
    {
        $image=Image::make($file_path);

        $image->resize($max_width,null,function($constraint){
           // 设定宽度是 $max_width，高度等比例双方缩放
           $constraint->aspectRatio();

           // 防止裁图时图片尺寸变大
           $constraint->upsize();
        });
         // 对图片修改后进行保存
         $image->save();
    }
}