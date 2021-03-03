<?php

namespace backend\helpers;

use Yii;
use yii\db\Exception;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utility {

    public static function getFilePathToSave($filePath, $type) {
        if (is_file($filePath)) {
            $config = Yii::$app->params['upload'][$type]['basePath'];
            $file = explode($config, $filePath);
            return $config . $file[1];
        }
        return '';
    }

    public static function getBasePathUpload($type) {
        return Yii::$app->params['upload']['basePath'] . Yii::$app->params['upload'][$type]['basePath'];
    }

    public static function generatePath($extension = 'jpg') {
        $now = strtotime('now') . rand(0, 999);
        $fileName = self::generateUniqueFileName($extension);

        $childFolder = date('Y') . '/' . date('m') . '/' . date('d') . "/" . $now . "/" . $fileName;

        return $childFolder;
    }

    public static function generateFilePath($extension = 'jpg') {
        $now = strtotime('now') . rand(0, 999);
        $fileName = self::generateUniqueFileName($extension);

        $uniqueFileName = trim($fileName, '.mp3');
        $childFolder = self::generateStructurePath($uniqueFileName) . "/" . $fileName;

        return $childFolder;
    }

    public static function generateUniqueFileName($ext) {
        return sprintf('%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                // 16 bits for "time_mid"
                mt_rand(0, 0xffff)
            ) . '.' . strtolower($ext);
    }

    /**
     * Gen slug
     *
     * @param $text
     * @return string|string[]|null
     */
    public static function slugify($text, $model)
    {
        do {
            // replace non letter or digits by -
            $text = preg_replace('~[^\pL\d]+~u', '-', $text);

            // transliterate
            // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);

            // trim
            $text = trim($text, '-');

            // remove duplicate -
            $text = preg_replace('~-+~', '-', $text);

            // lowercase
            $text = strtolower($text);

            $object = $model->findAll(['slug' => $text]);

            if($object) {
                $con = 1;
            } else {
                $con = 0;
            }
        } while ($con);

        return $text;
    }

    public static function createSlug($string, $model) {

        $hasSign = array(
            'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ', '&agrave;', '&aacute;', '&acirc;', '&atilde;',
            'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', '&egrave;', '&eacute;', '&ecirc;',
            'ì', 'í', 'ị', 'ỉ', 'ĩ', '&igrave;', '&iacute;', '&icirc;',
            'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', '&ograve;', '&oacute;', '&ocirc;', '&otilde;',
            'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ', '&ugrave;', '&uacute;',
            'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', '&yacute;',
            'đ', '&eth;',
            'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;',
            'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ', '&Egrave;', '&Eacute;', '&Ecirc;',
            'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ', '&Igrave;', '&Iacute;', '&Icirc;',
            'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;',
            'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ', '&Ugrave;', '&Uacute;',
            'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ', '&Yacute;',
            'Đ', '&ETH;',
        );
        $noSign = array(
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'y', 'y', 'y', 'y', 'y', 'y',
            'd', 'd',
            'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A',
            'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E',
            'I', 'I', 'I', 'I', 'I', 'I', 'I', 'I',
            'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O',
            'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U',
            'Y', 'Y', 'Y', 'Y', 'Y', 'Y',
            'D', 'D'
        );
        $table = array();
        foreach ($hasSign as $k => $temp) {
            $table[$temp] = $noSign[$k];
        }
        $table = array_merge($table, array('/' => '-', ' ' => '-'));
        $con = 0;
        do {
            // -- Remove duplicated spaces
            $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);

            $slug = strtolower(strtr($string, $table));
            if($con){
                $slug = $slug . rand(1);
            }

            $object = $model->findAll(['AND', 'slug' => $slug, ['<>', 'id', $model->id]]);
            if($object) {
                $con = 1;
            } else {
                $con = 0;
            }
        } while ($con);

        // -- Returns the slug
        return $slug;


    }

    public static function putObject($bucketName, $orgPath, $newPath, $multipart = true, $itemType = 'video')
    {
        $filePath = Yii::getAlias('@uploadFolder') . DIRECTORY_SEPARATOR . $newPath;
        if (!mkdir(dirname($filePath), 0777, true)) {
//            die('Failed to create folders...');
        }
        $status = copy($orgPath, $filePath);
        //unlink($orgPath);
        return array(
            'errorCode' => self::SUCCESS,
            'message' => Yii::t('wap', 'Thành công'),
        );
    }

    public static function generateStructurePath($uniqueFileName){
        //$uiq = uniqid(1,true);
        //$fileName = hash('sha1',$uiq);
        $mash = 255;
        $hashCode = crc32($uniqueFileName);//md5(serialize($fileName));
        $firstDir = $hashCode & $mash;
        $firstDir = vsprintf("%02x",$firstDir);
        $secondDir = ($hashCode >> 8) & $mash;
        $secondDir= vsprintf("%02x",$secondDir);
        $thirdDir = ($hashCode >> 4) & $mash;
        $thirdDir = vsprintf("%02x",$thirdDir);
        return $firstDir."/".$secondDir."/".$thirdDir;
    }

    public static function uploadImage($dataImage) {
        if ($dataImage['blob']) {

            $data = $dataImage['blob'];
            // var_dump($data); die;
            // $file = base64_decode($data);
            // $id = $_POST['id'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $rand = Yii::$app->security->generateRandomString(8);
            $cropType = $dataImage['cropType'];
            // var_dump($type); die;

            if ($cropType === 'large') {
                $filename = "large_" . $dataImage['id'] . "_" . $rand . "." . $dataImage['ext'];
                try {
                    file_put_contents('uploads/media1/images/landing/large/' . $filename, $data);
                    return 'uploads/media1/images/landing/large/' . $filename;
                } catch (Exception $e) {
                    print_r('Caught exception: ',  $e->getMessage(), "\n");
                }
            }

            if ($cropType === 'thumb') {
                $filename = "thumb_" . $dataImage['id'] . "_" . $rand . "." . $dataImage['ext'];
                try {
                    file_put_contents('uploads/media1/images/landing/thumb/' . $filename, $data);
                    return 'uploads/media1/images/landing/thumb/' . $filename;
                } catch (Exception $e) {
                    print_r('Caught exception: ',  $e->getMessage(), "\n");
                }
            }

            // file_put_contents('/uploads/image.png', $file);
        }
    }

    public static function getFileUrl($uploadFolder, $path) {
        return DIRECTORY_SEPARATOR . $uploadFolder . $path;
    }

}
