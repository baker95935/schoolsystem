<?php
/**
 * Created by PhpStorm.
 * User: fangzheng
 * Date: 2018/1/25
 * Time: 上午9:27
 */
function app_func(){
    echo "我是应用函数".__FUNCTION__;
}

function rotatesub($src,$degrees){//图片旋转
    $degrees=(int)$degrees;
    $image_size = getimagesize($src);
    $i=$image_size[2];

    switch ($i)
    {
        case 1:
            $src_img = imagecreatefromgif($src);
            $src=str_replace('.gif', 'o.gif', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
//            $x=imagesx($new_img);
            $msg=imagegif($new_img,$src);
            break;
        case 2:
            $src_img = imagecreatefromjpeg($src);
            $src=str_replace('.jpeg', 'o.jpeg', $src);
            $src=str_replace('.jpg', 'o.jpg', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagejpeg($new_img,$src);
            break;
        case 3:
            $src_img = imagecreatefrompng($src);
            $src=str_replace('.png', 'o.png', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagepng($new_img,$src);
            break;
        case 6:
            $src_img = imagecreatefrombmp($src);
            $src=str_replace('.bmp', 'o.bmp', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagewbmp($new_img,$src);
            break;
    }
   echo $msg;

    //1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM

}
//
function rotatesize($src,$reg)
{
    $src_img = imagecreatefrompng($src);
    $new_img = imagerotate($src_img, $reg, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
    echo imagesy($new_img);
}

function usersrc($src)
{
    $src=str_replace('./uploads/', '/uploads/', $src);
    return $src;
}

//kind:'cut',x:x,y:y,width:width,height:height,src:src,x_ratio:x_ratio,y_ratio:y_ratio,reg:reg

function cutsub($kind,$x,$y,$width,$height,$src,$degrees)
{

    $standarddx=420;
    $standarddy=610;

//    return $kind;

    $command = './public/cfile/ctbcut '.$kind.' '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$degrees.' '.$standarddx.' '.$standarddy;


    $result = exec($command);

   // return $result;


    $array = explode(",",$result);

//    return $result;


    switch($kind){
        case 1:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[0];
            $imgmsg[1]['y_ratio']=$array[1];
            $imgmsg[1]['src']=changsrc($array[2])."?".mt_rand();

            break;
        case 2:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[0];
            $imgmsg[1]['y_ratio']=$array[1];
            $imgmsg[1]['src']=changsrc($array[2])."?".mt_rand();

            $imgmsg[2]['reg']=0;
            $imgmsg[2]['x_ratio']=$array[3];
            $imgmsg[2]['y_ratio']=$array[4];
            $imgmsg[2]['src']=changsrc($array[5])."?".mt_rand();
            break;
        case 3:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[1];
            $imgmsg[1]['y_ratio']=$array[2];
            $imgmsg[1]['src']=changsrc($array[3])."?".mt_rand();

            $imgmsg[2]['reg']=0;
            $imgmsg[2]['x_ratio']=$array[4];
            $imgmsg[2]['y_ratio']=$array[5];
            $imgmsg[2]['src']=changsrc($array[6])."?".mt_rand();

            $imgmsg[3]['reg']=0;
            $imgmsg[3]['x_ratio']=$array[7];
            $imgmsg[3]['y_ratio']=$array[8];
            $imgmsg[3]['src']=changsrc($array[9])."?".mt_rand();
            break;
        case 4:
            $imgmsg[1]['reg']=0;
            $imgmsg[1]['x_ratio']=$array[0];
            $imgmsg[1]['y_ratio']=$array[1];
            $imgmsg[1]['src']=changsrc($array[2])."?".mt_rand();

            $imgmsg[2]['reg']=0;
            $imgmsg[2]['x_ratio']=$array[3];
            $imgmsg[2]['y_ratio']=$array[4];
            $imgmsg[2]['src']=changsrc($array[5])."?".mt_rand();
            break;
    }
            return $imgmsg;

}

function png2jpg($srcPathName, $delOri=true)
{
    $srcFile=$srcPathName;
    $srcFileExt=strtolower(trim(substr(strrchr($srcFile,'.'),1)));
    if($srcFileExt=='png')
    {
        $dstFile = str_replace('.png', '.jpg', $srcPathName);
        $photoSize = GetImageSize($srcFile);
        $pw = $photoSize[0];
        $ph = $photoSize[1];
        $dstImage = ImageCreateTrueColor($pw, $ph);
        imagecolorallocate($dstImage, 255, 255, 255);
        //读取图片
        $srcImage = ImageCreateFromPNG($srcFile);
        //合拼图片
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $pw, $ph, $pw, $ph);
        imagejpeg($dstImage, $dstFile, 90);
        if ($delOri)
        {
            unlink($srcFile);
        }
        imagedestroy($srcImage);
    }
}

function cutsub1($src,$ox)
{
    echo "helloworld";
    $photoSize = GetImageSize($src);
    $pw = $photoSize[0];
    $ph = $photoSize[1];
    $dstImage = ImageCreateTrueColor($pw / 2, $ph);
    imagecolorallocate($dstImage, 255, 255, 255);
    //读取图片
    $srcImage = ImageCreateFromPNG($src);
//        //合拼图片
    imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $pw / 2, $ph, $pw / 2, $ph);
    imagepng($dstImage, './uploads/inittestimg/2018-03-24/test1.png');

}

function imgxy($src)
{
    $photoSize = GetImageSize($src);
    $imgsize['x']=$photoSize[0];
    $imgsize['y']=$photoSize[1];

    return $imgsize;
}

function trsrc($src,$num)
{
    if($num==2)//分割两个
    {
        $image_size = getimagesize($src);
        $i=$image_size[2];

        if(strpos($src,'.gif')>-1)
        {
            $src1=str_replace('.gif', '_a.gif', $src);
            $src2=str_replace('.gif', '_b.gif', $src);
        }
        if(strpos($src,'.jpg')>-1 )
        {
            $src1=str_replace('.jpg', '_a.jpg', $src);
            $src2=str_replace('.jpg', '_b.jpg', $src);
        }

        if(strpos($src,'.jpeg')>-1 )
        {
            $src1=str_replace('.jpeg', '_a.jpeg', $src);
            $src2=str_replace('.jpeg', '_b.jpeg', $src);
        }

        if(strpos($src,'.png')>-1)
        {
            $src1=str_replace('.png', '_a.png', $src);
            $src2=str_replace('.png', '_b.png', $src);
        }

        if(strpos($src,'.bmp')>-1)
        {
            $src1=str_replace('.bmp', '_a.bmp', $src);
            $src2=str_replace('.bmp', '_b.bmp', $src);
        }

        $msg[1]=$src1;
        $msg[2]=$src2;
    }
    if($num==3)//分割三个
    {
        $image_size = getimagesize($src);
        $i=$image_size[2];

        if(strpos($src,'.gif')>-1)
        {
            $src1=str_replace('.gif', '_a.gif', $src);
            $src2=str_replace('.gif', '_b.gif', $src);
            $src3=str_replace('.gif', '_c.gif', $src);
        }
        if(strpos($src,'.jpg')>-1 )
        {
            $src1=str_replace('.jpg', '_a.jpg', $src);
            $src2=str_replace('.jpg', '_b.jpg', $src);
            $src3=str_replace('.jpg', '_c.jpg', $src);
        }

        if(strpos($src,'.jpeg')>-1 )
        {
            $src1=str_replace('.jpeg', '_a.jpeg', $src);
            $src2=str_replace('.jpeg', '_b.jpeg', $src);
            $src3=str_replace('.jpeg', '_c.jpeg', $src);
        }

        if(strpos($src,'.png')>-1)
        {
            $src1=str_replace('.png', '_a.png', $src);
            $src2=str_replace('.png', '_b.png', $src);
            $src3=str_replace('.png', '_c.png', $src);
        }

        if(strpos($src,'.bmp')>-1)
        {
            $src1=str_replace('.png', '_a.bmp', $src);
            $src2=str_replace('.png', '_b.bmp', $src);
            $src3=str_replace('.png', '_c.bmp', $src);
        }
        $msg[1]=$src1;
        $msg[2]=$src2;
        $msg[3]=$src3;
    }

    return $msg;

}
//kind:'cut',x:x,y:y,width:width,height:height,src:src,x_ratio:x_ratio,y_ratio:y_ratio,reg:reg
//对于习题进行单个分割
function cut03sub($y,$height,$src)
{
    $folder='./uploads/questionanswer/'.date("Y-m-d");
    if(!file_exists($folder)) {
        mkdir($folder);
    }
    $len=3;
    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $string=time();
    for(;$len>=1;$len--)
    {
        $position=rand()%strlen($chars);
        $position2=rand()%strlen($string);
        $string=substr_replace($string,substr($chars,$position,1),$position2,0);
    }

    if(stripos($src,'.png')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.png';
    }
    if(stripos($src,'.jpg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpg';

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpeg';
    }


    $command = './public/cfile/recut03sub '.$y.' '.$height.' '.$src.' '.$nowsrc;
    $result = exec($command);

    if($result==1)
    {
        $htmlfilename=str_replace('./','/',$nowsrc);
    }
    else
    {
        $htmlfilename=0;
    }

    echo $htmlfilename;
}

//对答案进行分割

//对于习题进行单个分割
function cutanswersub($x,$y,$width,$height,$src)
{
    $folder='./uploads/questionanswer/'.date("Y-m-d");
    if(!file_exists($folder)) {
        mkdir($folder);
    }
    $len=3;
    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $string=time();
    for(;$len>=1;$len--)
    {
        $position=rand()%strlen($chars);
        $position2=rand()%strlen($string);
        $string=substr_replace($string,substr($chars,$position,1),$position2,0);
    }

    if(stripos($src,'.png')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.png';
    }
    if(stripos($src,'.jpg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpg';

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpeg';
    }


    $command = './public/cfile/answercut '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$nowsrc;
    $result = exec($command);

    if($result==1)
    {
        $htmlfilename=str_replace('./','/',$nowsrc);
    }
    else
    {
        $htmlfilename=0;
    }

    return $htmlfilename;
}

//对于习题进行矩形分割
function cutrectangle($x,$y,$width,$height,$src)
{
    $folder='./uploads/questionanswer/'.date("Y-m-d");
    if(!file_exists($folder)) {
        mkdir($folder);
    }
    $len=3;
    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $string=time();
    for(;$len>=1;$len--)
    {
        $position=rand()%strlen($chars);
        $position2=rand()%strlen($string);
        $string=substr_replace($string,substr($chars,$position,1),$position2,0);
    }

    if(stripos($src,'.png')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.png';
    }
    if(stripos($src,'.jpg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpg';

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $nowsrc=$folder.'/'.$string.'.jpeg';
    }

    $command = './public/cfile/cutrectangle '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$nowsrc;
    $result = exec($command);

    if($result==1)
    {
        $htmlfilename=str_replace('./','/',$nowsrc);
    }
    else
    {
        $htmlfilename=0;
    }

    echo $htmlfilename;
}
function recut03sub($y,$height,$src,$nowsrc)
{
    $command = './public/cfile/recut03sub '.$y.' '.$height.' '.$src.' '.$nowsrc;
    echo $result = exec($command);

}
function addcutimgto($src1,$src2){
    $command = './public/cfile/addcutimgto '.$src1.' '.$src2;
    return $result = exec($command);

}
function imgcutimg($src,$degrees){

    $msd=123;


    $degrees=(int)$degrees;
    $standx=3000;
    $standy=4564;
    $dstImage = imagecreatetruecolor($standx, $standy);
    $color=imagecolorallocate($dstImage, 255, 255, 255);
    imagecolortransparent($dstImage,$color);
    imagefill($dstImage,0,0,$color);
    $standradio=round(($standx/$standy),2);
    $image_size = getimagesize($src);
    $i=$image_size[2];


            switch ($i)
            {
                case 1:
                    $src_img = imagecreatefromgif($src);
                    if($degrees!=0) {
                        $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
                    }
                    $y=imagesy($src_img);
                    $x=imagesx($src_img);
                    $radio=round(($y/$x),2);
                    $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
                    $msg=imagegif($dstImage, $src);
                    imagedestroy($dstImage);
                    imagedestroy($src_img);

                    break;
                case 2:
                    $src_img = imagecreatefromjpeg($src);
                    if($degrees!=0) {
                        $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
                    }
                    $y=imagesy($src_img);
                    $x=imagesx($src_img);
                    $radio=round(($y/$x),2);
                    $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
                    $msg=imagejpeg($dstImage, $src);
                    imagedestroy($dstImage);
                    imagedestroy($src_img);


                    break;
                case 3:


                    $src_img = imagecreatefrompng($src);

                    return $src;
                    if($degrees!=0) {
                        $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
                    }
                    $y=imagesy($src_img);
                    $x=imagesx($src_img);
                    $radio=round(($y/$x),2);
                    $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
                    $msg=imagepng($dstImage, $src);
                    imagedestroy($dstImage);
                    imagedestroy($src_img);
                    break;
                case 6:
                    $src_img = imagecreatefrombmp($src);
                    if($degrees!=0) {
                        $src_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
                    }
                    $y=imagesy($src_img);
                    $x=imagesx($src_img);
                    $radio=round(($y/$x),2);
                    $dstImage=changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img);
                    $msg=imagewbmp($dstImage, $src);
                    imagedestroy($dstImage);
                    imagedestroy($src_img);
                    break;
            }


    //1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM

}
function changexy($x,$y,$standx,$standy,$radio,$standradio,$dstImage,$src_img){
    if($y>$standy || $x>$standx){
        if($radio<$standradio){
            $width=$standx;
            $height=($width/$x)*$y;
        }else
        {
            $height=$standy;
            $width=($height/$y)*$x;
        }
        imagecopyresampled($dstImage, $src_img, 0,0,0,0,$width, $height, $x,$y);
    }
    else{
        imagecopyresampled($dstImage, $src_img, 0,0,0,0, $x,$y, $x,$y);
    }
    imagedestroy($src_img);

    return $dstImage;
}
function regtest($src,$degrees){
    $degrees=(int)$degrees;
    $image_size = getimagesize($src);
    $i=$image_size[2];

    switch ($i)
    {
        case 1:
            $src_img = imagecreatefromgif($src);
            $src=str_replace('.gif', 'o.gif', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
//            $x=imagesx($new_img);
            $msg=imagegif($new_img,$src);
            break;
        case 2:
            $src_img = imagecreatefromjpeg($src);
            $src=str_replace('.jpeg', 'o.jpeg', $src);
            $src=str_replace('.jpg', 'o.jpg', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagejpeg($new_img,$src);
            break;
        case 3:
            $src_img = imagecreatefrompng($src);
            $src=str_replace('.png', 'o.png', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagepng($new_img,$src);
            break;
        case 6:
            $src_img = imagecreatefrombmp($src);
            $src=str_replace('.bmp', 'o.bmp', $src);
            $new_img = imagerotate($src_img, $degrees, imagecolorallocatealpha($src_img, 255, 255, 255, 0));
            $msg=imagewbmp($new_img,$src);
            break;
    }
    return $msg;
}
function changsrc($src){
    $num='';
    if(stripos($src,'.png')>-1)
    {
        $num=stripos($src,'.png');
        $num=$num+4;
        $src=substr($src,0,$num);

    }
    if(stripos($src,'.jpg')>-1)
    {
        $num=stripos($src,'.jpg');
        $num=$num+4;
        $src=substr($src,0,$num);

    }
    if(stripos($src,'.jpeg')>-1)
    {
        $num=stripos($src,'.jpeg');
        $num=$num+5;
        $src=substr($src,0,$num);
    }

    return $src;
}
function rotateimg($src,$degree){
    $command = './public/cfile/rotateimg '.$src.' '.$degree;
    return $result = exec($command);
}
function htmlpic($testid,$sum,$pic1,$pic2,$pic3,$pic4,$title,$in_ser)
{
    $html='';
    $model = M('img_cuted_data');
    $title=str_replace('T', '', $title);
    $title=str_replace('A', '', $title);
    $title=str_replace('+', '', $title);
    $title=str_replace('()', '', $title);
    if($sum>0){
        $array['id'] = (int)$pic1;
       $src1 = $model->where($array)->field('src')->Find();
       $src1=usersrc($src1[src]);
        $html1='<img id="pic'.$in_ser.'1" onclick="editpic(this.id)" src="'.$src1.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
     }
    if($sum>1){
        $array['id'] = $pic2;
        $src2 = $model->where($array)->field('src')->Find();
        $src2=usersrc($src2[src]);
        $html2='<img id="pic'.$in_ser.'2" onclick="editpic(this.id)" src="'.$src2.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
    }
    if($sum>2){
        $array['id'] = $pic3;
        $src3 = $model->where($array)->field('src')->Find();
        $src3=usersrc($src3[src]);
        $html3='<img id="pic'.$in_ser.'3" onclick="editpic(this.id)" src="'.$src3.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
    }
    if($sum>3){
        $array['id'] = $pic4;
        $src4 = $model->where($array)->field('src')->Find();
        $src4=usersrc($src4[src]);
        $html4='<img id="pic'.$in_ser.'4" onclick="editpic(this.id)" src="'.$src4.'" style="margin-left:16px;margin-top:10px;width: 90px;height: 90px;">';
    }
    if($sum==1){
        $html=$html1;
    }
    if($sum==2){
        $html=$html1.$html2;
    }
    if($sum==3){
        $html=$html1.$html2.$html3;
    }
    if($sum==4){
        $html=$html1.$html2.$html3.$html4;
    }
    $sum=(int)$sum+1;
   // $inputmsg='<input id="inputpic'.$in_ser.'" type="hidden"  name="'.$testid.'"  value="'.$sum.'">';
    $title='<div class="row" id="ctbpicid'.$in_ser.'" style="margin-top:10px;text-align: center;background-color: white;"><span>题&nbsp;'.$title.'&nbsp;图</span></div>';
    $html=$html.$title;
   return $html;
}

//对于删除进行排序
function retestsernum($in_ser,$leng,$filesernum){
    $model = M('test_public_data');
    $array[filesernum]=$filesernum;
    $array[kind]='test';

    $max=$model->where($array)->max('in_ser');
    $data=$model->where($array)->select();
    $count=$model->where($array)->count();

    for($i=0;$i<$count;$i++)
    {
        if($data[$i][in_ser]>$in_ser)
        {
            $arrayid[id]=(int)$data[$i][id];
            $newin_ser['in_ser']=(int)$data[$i][in_ser]-(int)$leng;
            $model->where($arrayid)->save($newin_ser);
        }
    }
}
//单个图片配图处理
function no1testsernum($id,$picsum){
    $model1 = M('test_public_data');
    $model2 = M('img_cuted_data');

    $arrays['id']=$id;
    $ta=$model1->where($arrays)->find();

    $in_ser=$ta[in_ser];
    $filesernum=$ta[filesernum];


//    return $id;
//    return "in_ser:".$in_ser.",filesernum:".$filesernum;

    if($picsum==5){
        $pic1=(int)$ta[pic1];
        $pic2=(int)$ta[pic2];
        $pic3=(int)$ta[pic3];
        $pic4=(int)$ta[pic4];
        $srcid=(int)$ta[srcid];

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);
        $pic2arr=$model2->where("id=".$pic2)->select();
        $pic2src=$pic2arr[0][src];
        unlink($pic2src);
        $pic3arr=$model2->where("id=".$pic3)->select();
        $pic3src=$pic3arr[0][src];
        unlink($pic3src);
        $pic4arr=$model2->where("id=".$pic4)->select();
        $pic4src=$pic4arr[0][src];
        unlink($pic4src);

        $model2->delete($pic1);
        $model2->delete($pic2);
        $model2->delete($pic3);
        $model2->delete($pic4);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);

    }
    if($picsum==4){
        $pic1=(int)$ta[pic1];
        $pic2=(int)$ta[pic2];
        $pic3=(int)$ta[pic3];
        $srcid=(int)$ta[srcid];


        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);
        $pic2arr=$model2->where("id=".$pic2)->select();
        $pic2src=$pic2arr[0][src];
        unlink($pic2src);
        $pic3arr=$model2->where("id=".$pic3)->select();
        $pic3src=$pic3arr[0][src];
        unlink($pic3src);


        $model2->delete($pic1);
        $model2->delete($pic2);
        $model2->delete($pic3);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);
    }
    if($picsum==3){
        $pic1=(int)$ta[pic1];
        $pic2=(int)$ta[pic2];
        $srcid=(int)$ta[srcid];

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);
        $pic2arr=$model2->where("id=".$pic2)->select();
        $pic2src=$pic2arr[0][src];
        unlink($pic2src);


        $model2->delete($pic1);
        $model2->delete($pic2);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);
    }
    if($picsum==2){
        $pic1=(int)$ta[pic1];
        $srcid=(int)$ta[srcid];

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $pic1arr=$model2->where("id=".$pic1)->select();
        $pic1src=$pic1arr[0][src];
        unlink($pic1src);

        $model2->delete($pic1);
        $model2->delete($srcid);
        retestsernum($in_ser,1,$filesernum);
        return $model1->delete($id);
    }
    if($picsum==1)
    {
        $srcid=(int)$ta[srcid];
        retestsernum($in_ser,1,$filesernum);

        $result=$model2->where("id=".$srcid)->select();
        $src=$result[0][src];
        unlink($src);

        $model2->delete($srcid);
        return  $model1->delete($id);
    }
}
//向上向下之后排序
function updowntestsernum($in_ser,$upordown,$filesernum){
    $model = M('test_public_data');
    $array[filesernum]=$filesernum;
    $array[kind]='test';

    $max=$model->where($array)->max('in_ser');
    $data=$model->where($array)->select();
    $count=$model->where($array)->count();
    if($upordown=='up')
    {
        $in_ser=$in_ser-1;
    }
    for($i=0;$i<$count;$i++)
    {
        if($data[$i][in_ser]>$in_ser)
        {
            $arrayid[id]=(int)$data[$i][id];
            $newin_ser['in_ser']=(int)$data[$i][in_ser]+1;
            $model->where($arrayid)->save($newin_ser);
        }
    }
    return 1;
}
//插入T之后，进行相应的A的值进行修改
function newtandasernum($in_ser,$max,$tsernum,$filesernum){
    $kind='test';


}
//插入数值
function cuttitlemsg($msg)
{
    $msg=str_replace("T","",$msg);
    $msg=str_replace("A","",$msg);
    $msg=str_replace("+","",$msg);
    $msg=str_replace("()","",$msg);
    return $msg;
}
//答案图片添加
function addanswerimgto($src1,$src2){
    $command = './public/cfile/addanswerimg '.$src1.' '.$src2;
    return $result = exec($command);
}

//插入数值类型
function savetitlemsg($msg)
{
    if(strpos($msg,"(T+A)",0)>0)
    {
        return  "(T+A)";
    };

    if(strpos($msg,"(A)",0)>0)
    {
        return  "(A)";
    };

    if(strpos($msg,"(T)",0)>0)
    {
        return  "(T)";
    };
}

//橡皮擦功能
function erasesub($x,$y,$width,$height,$src,$r,$g,$b)
{
    $command = './public/cfile/erasesub '.$x.' '.$y.' '.$width.' '.$height.' '.$src.' '.$r.' '.$g.' '.$b;
    return $result = exec($command);
}

//边缘剪切
function cutsidesub($x,$y,$src,$kind)
{
    $command = './public/cfile/cutside '.$x.' '.$y.' '.$src.' '.$kind;
    return $result = exec($command);
}



//降噪函数
function publicnoisesub($src)
{
    $command = './public/cfile/noisesub '.$src;
    $result = exec($command);
}

//修正函数
function publicjustimg($src)
{
    $command = './public/cfile/justimg '.$src;
    $result = exec($command);
}

//像素在72分辨率情况下，转化成MM
function pxtommsub($pxval){
    $mmval=$pxval*0.371;
    return round($mmval,3);
}
//字符串长度,字符，单个字符长度（英文）
function fontsizesub($msg,$size){
    $sum=mb_strlen($msg);
    $i=0;
    $lenght=0;


    for($i=0;$i<$sum;$i++)
    {
        $nowmsg=mb_substr($msg,$i,1,"utf-8");
        if(preg_match("/^[a-zA-Z\s]+$/",$nowmsg))
        {
            $lenght=$lenght+1;
        }
        else
        {
            if(preg_match("/[\'.,，。:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$nowmsg))
            {
                $lenght=$lenght+1;
            }
            else
            {
                $lenght=$lenght+2;
            }

        }
    }

    return $lenght*$size;
}

function font_img_size_sub($msg,$size,$width)
{
   return fontsizesub($msg,$size)+$width;
}

function adminsaveasfile($oldsrc,$newsrc)
{
    $command = './public/cfile/saveasfile '.$oldsrc.' '.$newsrc;
    return $result = exec($command);
}
?>