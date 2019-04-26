<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */

    public $files;
    public $file;
    public $id;
    public $maxSize = 104857600;
    public $tooBig = 'Файл не должен превышать 100Мб';

    public function rules()
    {
        return [
            [['files'], 'file', 'checkExtensionByMimeType' => false, 'maxFiles' => 10, 'maxSize' => $this->maxSize, 'tooBig' => $this->tooBig],
//            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif, doc, docx, txt, pdf, xls, xlsx', 'maxFiles' => 10],
        ];
    }

    public function upload($id)
    {
        if ($this->validate()) {

            foreach ($this->files as $file) {
                $filename =  strtolower(md5(uniqid($this->files->baseName)) . '.' . $this->files->extension);
                $file->saveAs(Yii::getAlias('@web') . 'files/' . $filename . '.' . $file->extension);


                $inFile = new File();
                $inFile->file = $filename . '.' . $file->extension;
                $inFile->save();

                $report = new FileInReport();
                $report->bug_id = $id;
                $report->file_id = $inFile->id;
                $report->save();

            }
            //$report->save();
            //var_dump($this->files);die;

            Yii::$app->session->setFlash('success', "Files are added successfully!");
            return true;
        } else {
            return false;
        }
    }

}