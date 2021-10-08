<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $logo
 * @property string|null $url
 * @property int|null $order
 * @property int|null $status
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order', 'status','maxwidth'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            ['logo', 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'svg'], 'maxSize' => 1024 * 1024 * 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'logo' => Yii::t('app', 'Logo'),
            'url' => Yii::t('app', 'Url'),
            'order' => Yii::t('app', 'Order'),
            'status' => Yii::t('app', 'Status'),
            'maxwidth' => Yii::t('app', 'MaxWidth'),
        ];
    }

    public function upload($image)
    {
        if ($image) {
            $dir = Yii::getAlias('@frontend')."/web/uploads/";

            $image_name = time();
            $image_name .= '.'.$image->extension;

            if ($image->saveAs($dir.$image_name)) {
                $this->logo = $image_name;
            }
        }

        return true;
    }

}
