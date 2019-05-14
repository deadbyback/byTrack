<?php

namespace frontend\models;

use common\models\BugReport;
use common\models\File;
use common\models\FileInReport;
use Exception;
use Throwable;
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
        ];
    }


    /**
     * @param $id
     * @return bool
     * @throws Throwable
     */
    public function upload($id)
    {
        if (!$this->validate()) {
            return false;
        }
        $report = BugReport::findOne($id);

        foreach ($this->files as $file) {
            $filename = strtolower(md5_file($file->tempName));
            $file->saveAs(Yii::getAlias('@web') . 'files/' . $filename . '.' . $file->extension);

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {

                $inFile = new File();
                $inFile->filename = $file->baseName . '.' . $file->extension;
                $inFile->filepath = $filename . '.' . $file->extension;
                $inFile->save();
                $report->link('files', $inFile);

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        Yii::$app->session->setFlash('success', "Files are added successfully!");
        return true;
    }

}