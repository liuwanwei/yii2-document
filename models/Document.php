<?php

namespace bs\yii\document\models;

use Yii;
use bs\yii\document\utils\FileConversion;

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $category
 * @property string $title
 * @property string $content
 * @property string $createdAt
 * @property string $updatedAt
 */
class Document extends \yii\db\ActiveRecord
{
    const TYPE_PLAIN_TEXT   = 0;
    const TYPE_RICH_TEXT    = 1;
    const TYPE_MARKDOWN     = 2;
    const TYPE_NAMES = [
        '0' => '普通',
        '1' => '富文本',
        '2' => 'Markdown',
    ];

    const CATEGORY_NAMES = [
        '0' => '默认',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'category'], 'integer'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => '部类',
            'type' => '类型',
            'title' => '标题',
            'content' => '内容',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }

    public function getTypeName(){
        $map = self::TYPE_NAMES;
        if (isset($map[$this->type])) {
            return $map[$this->type];
        }else{
            return '';
        }
    }

    public function getCategoryName(){
        $map = self::CATEGORY_NAMES;
        if (isset($map[$this->category])) {
            return $map[$this->category];
        }else{
            return '';
        }
    }

    public function saveDocument(){

        if ($this->type == self::TYPE_RICH_TEXT) {
            $content = $this->content;
            $fileConversion = new FileConversion();
            $this->content = $fileConversion->convertFile($content);
        }        

        return parent::save();
    }

    public function getViewContent(){
        if ($this->type === self::TYPE_MARKDOWN) {
            $parseDown = new \Parsedown();
            return $parseDown->text($this->content);
        }else{
            return $this->content;
        }
    }
}
