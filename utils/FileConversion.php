<?php

namespace bs\yii\document\utils;

use Yii;

class FileConversion {
	
	// TODO：要通过模块配置进来，然后在初始化的时候，再配置到这里。
	// 生成文件相对路径，相对于 @webroot
	private function imageAccessPath($filename){
	    return "/upload/images/". uniqid(). '_' . $filename;
	}

	// 生成文件本地存储绝对路径
	// TODO: 需要验证路径是否正确
	private function imageUploadPath($webPath){
	    return Yii::getAlias('@webroot').$webPath;
	}

	/**
	 *
	 * 将缓冲区内 base64 编码的图片数据，以文件形式保存在服务器上，并将编码的图片数据
	 * 用 <img> 标签替换。 通过这种替换，能降低广告数据表单条存储容量，提升加载速度。
	 *
	 */
	
	public function convertFile($content){
	    $matches = [];
	    $ret = preg_match_all("/\<img src=\"data:image\/.*?;base64,(.*?)\" data-filename=\"(.*?)\"/", $content, $matches);
	    if (0 != $ret) {
	        $i = 0;
	        for ($i=0; $i < count($matches[0]); $i++) { 
	            $imageFilename = $matches[2][$i];

	            $webPath = $this->imageAccessPath($imageFilename);
	            $uploadPath = $this->imageUploadPath($webPath);

	            $file = fopen($uploadPath, "w");
	            $base64 = $matches[1][$i];
	            $decoded = base64_decode($base64);
	            fwrite($file, $decoded);
	            fclose($file);

	            // 存放图片的域名+文件名得到访问图片的地址
	            if (isset(Yii::$app->params['localImageDomain'])) {
	            	// 带域名的绝对路径
	            	$imageDomain = Yii::$app->params['localImageDomain'];
	            	$relativePath = str_replace("/upload/images/", "", $webPath);
	            	$url = $imageDomain . $relativePath;
	            }else{
	            	// 相对路径
	            	$url = $webPath;
	            }

	            $imageTag = "<img src=\"" . $url . "\"";
	            $content = str_replace($matches[0][$i], $imageTag, $content);
	        }
	        return $content;
	    }

	    return $content;
	}
}