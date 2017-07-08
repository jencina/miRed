<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;
    public $parent_id;
    public $size;
    public $tipo;

    public function rules()
    {
        return [
            [['tipo'], 'string'],
            [['parent_id','size'], 'integer'],
            [['imageFiles'], 'file', 'maxSize' => 10 * 1024 * 1024, 'skipOnEmpty' => false, 'maxFiles' => 4],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            
            if(!file_exists('uploads/')){
                mkdir('uploads/',0777);
            }
            
            foreach ($this->imageFiles as $file) {
                $nombre = $this->sanear_string($file->baseName) ;
                $file->name = date("Ymd_His_").$this->clean($nombre). '.' . $file->extension;
                $file->type = $this->tipo($file->type);
                $file->saveAs('uploads/' . $file->name);
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    function tipo($mime){
        $imagen = 'otros';
        if ($mime == 'application/vnd.openxmlformats-officedocument.presentationml.presentation' || $mime == 'application/vnd.ms-powerpoint') { //PPTX
            $imagen = 'ppt';
        } else if ($mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $mime == 'application/vnd.ms-excel') { //XLSX
            $imagen = 'excel';
        } else if ($mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $mime == 'application/msword') { //DOCX
            $imagen = 'word';
        } else if ($mime == 'application/pdf') { //PDF
            $imagen = 'pdf';
        } else if ($mime == 'image/jpeg' || $mime == 'image/png') { //PDF
            $imagen = 'imagen';
        }
        
        return $imagen;
        
    }
    
    function clean($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }
    
    function sanear_string($string) {
        $string =(string)trim($string);
        
       
        $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );
        $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );
        $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );
        $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );
        $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );
        $string = str_replace(
                array('ñ','ñ', 'Ñ', 'ç', 'Ç'), array('n','n', 'N', 'c', 'C'), $string
        );
        
        
        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
                array("\\", "¨", "º", "-", "~",
            "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "`", "]",
            "+", "}", "{", "¨", "´",
            ">", "< ", ";", ",", ":", " "), '', $string
        );
        
        return $string;
    }
}

?>
