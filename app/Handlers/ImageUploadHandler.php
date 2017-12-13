<?php
/**
 * VNNOX - ImageUploadHandler.php.
 * User: 王星渊
 * Date: 2017/12/8
 * Time: 17:30
 */
namespace App\Handles;

use Image;

class ImageUploadHandler{
	//只允许一下后缀的图片上传
	protected $allowed_ext = ['png','jpg','gif','jpeg'];

	/**
	 * 返回图片上传路径
	 * @param $file
	 * @param $folder
	 * @param $file_prefix
	 * @return array|bool
	 */
	public function save($file,$folder,$file_prefix,$max_width=false){
		//构件存储的文件名规则,值如: uploads/images/avatars/201709/21
		//文件夹切割能使查找效率更高
		$folder_name = "uploads/images/{$folder}/" . date('Ym',time()) . '/' . date('d',time());

		//文件具体存储的物理路径 public_path() 获取的是 public 文件夹的物理路径
		$upload_path = public_path() . '/' . $folder_name;

		//获取文件的后缀,因图片从剪贴板里黏贴时后缀名为空,所以此处确保后缀一直存在
		$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

		//拼接文件的后缀名, 加前缀是为了增加辨析度,前缀可以是相关数据模型ID如 : 1_1493521050_7BVc9v9ujP.png
		$filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

		//如果上传的不是图片则终止操作
		if (! in_array($extension,$this->allowed_ext)) return false;

		//将图片移动到我们的目标存储路径中
		$file->move($upload_path,$filename);

		//如果限制了图片的宽度,就进行裁剪
		if ($max_width && $extension != 'gif') {
			//等比例缩放
			$this->reduceSize($upload_path . '/' . $filename, $max_width);
		}

		return [
			'path'=>"/$folder_name/$filename"
		];

	}

	/**
	 * 对图片进行等比例裁剪
	 *使用说明:
	 *        http://image.intervention.io/api/resize
	 *        http://image.intervention.io/api/save
	 * @param $filePath
	 * @param $maxWidth
	 */
	private function reduceSize($filePath,$maxWidth){
		//先实例化,传参是文件的磁盘物理路径
		$image = Image::make($filePath);

		//进行大小调整的操作
		$image->resize($maxWidth, null, function ($constraint) {
			// 设定宽度是 $maxWidth，高度等比例双方缩放
			$constraint->aspectRatio();
			// 防止裁图时图片尺寸变大
			$constraint->upsize();
		});

		// 对图片修改后进行保存
		$image->save();
	}
}