<?php

/**
 * This is the model class for table "issue".
 *
 * The followings are the available columns in table 'issue':
 * @property string $id
 * @property string $project_id
 * @property integer $tracker_id
 * @property integer $status_id
 * @property integer $priority_id
 * @property string $assigned_to_id
 * @property string $subject
 * @property string $description
 * @property integer $done_ratio
 * @property string $due_date
 * @property string $author_id
 * @property string $created_date
 * @property string $updated_date
 */
class Issue extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'issue';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_id, tracker_id, status_id, priority_id, subject, description, author_id, created_date', 'required'),
            array('tracker_id, status_id, priority_id, done_ratio', 'numerical', 'integerOnly' => true),
            array('project_id, assigned_to_id, author_id', 'length', 'max' => 11),
            array('subject', 'length', 'max' => 50),
            array('due_date, updated_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, project_id, tracker_id, status_id, priority_id, assigned_to_id, subject, description, done_ratio, due_date, author_id, created_date, updated_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'files' => array(self::HAS_MANY, 'IssueFile', 'issue_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'assigned' => array(self::BELONGS_TO, 'User', 'assigned_to_id'),
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'project_id' => 'Проект',
            'tracker_id' => 'Трекер',
            'status_id' => 'Статус',
            'priority_id' => 'Приоритет',
            'assigned_to_id' => 'Исполнитель',
            'subject' => 'Заголовок',
            'description' => 'Описание',
            'done_ratio' => 'Готовность, %',
            'due_date' => 'Дата окончания',
            'author_id' => 'Автор',
            'created_date' => 'Дата создания',
            'updated_date' => 'Дата обновления',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('project_id', $this->project_id, true);
        $criteria->compare('tracker_id', $this->tracker_id);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('priority_id', $this->priority_id);
        $criteria->compare('assigned_to_id', $this->assigned_to_id, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('done_ratio', $this->done_ratio);
        $criteria->compare('due_date', $this->due_date, true);
        $criteria->compare('author_id', $this->author_id, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_date', $this->updated_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Issue the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}