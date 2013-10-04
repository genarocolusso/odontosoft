<?php

/**
 * This is the model base class for the table "pessoa".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Pessoa".
 *
 * Columns in table "pessoa" available as properties of the model,
 * followed by relations of table "pessoa" available as properties of the model.
 *
 * @property integer $id_pessoa
 * @property string $id_usuario
 * @property string $nome
 * @property string $data_nascimento
 * @property integer $sexo
 * @property string $cpf
 * @property string $rg
 * @property string $email
 *
 * @property Cliente[] $clientes
 * @property Dentista[] $dentistas
 * @property Endereco[] $enderecos
 * @property UsergroupsUser $idUsuario
 * @property Recepcionista[] $recepcionistas
 * @property Telefone[] $telefones
 */
abstract class BasePessoa extends GxActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'pessoa';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Pessoa|Pessoas', $n);
    }

    public static function representingColumn() {
        return 'nome';
    }

    public function rules() {
        return array(
            array('nome, data_nascimento, sexo, cpf, email', 'required'),
            array('sexo', 'numerical', 'integerOnly' => true),
            array('id_usuario', 'length', 'max' => 20),
            array('nome, email', 'length', 'max' => 120),
            array('email', 'email'),
            //array('email', 'unique'),
            array('data_nascimento', 'date'),
            array('cpf', 'length', 'max' => 14),
            //array('cpf', 'unique'),
            array('cpf', 'ext.validator.cpf'),
            array('rg', 'length', 'max' => 10),
            array('rg', 'length', 'min' => 9),
            array('id_usuario, rg', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id_pessoa, id_usuario, nome, data_nascimento, sexo, cpf, rg, email', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'clientes' => array(self::HAS_MANY, 'Cliente', 'id_pessoa'),
            'dentistas' => array(self::HAS_MANY, 'Dentista', 'id_pessoa'),
            'enderecos' => array(self::HAS_MANY, 'Endereco', 'id_pessoa'),
            'idUsuario' => array(self::BELONGS_TO, 'UsergroupsUser', 'id_usuario'),
            'recepcionistas' => array(self::HAS_MANY, 'Recepcionista', 'id_pessoa'),
            'telefones' => array(self::HAS_MANY, 'Telefone', 'id_pessoa'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id_pessoa' => Yii::t('app', 'Id Pessoa'),
            'id_usuario' => null,
            'nome' => Yii::t('app', 'Nome'),
            'data_nascimento' => Yii::t('app', 'Data Nascimento'),
            'sexo' => Yii::t('app', 'Sexo'),
            'cpf' => Yii::t('app', 'CPF'),
            'rg' => Yii::t('app', 'RG'),
            'email' => Yii::t('app', 'Email'),
            'clientes' => null,
            'dentistas' => null,
            'enderecos' => null,
            'idUsuario' => null,
            'recepcionistas' => null,
            'telefones' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_pessoa', $this->id_pessoa);
        $criteria->compare('id_usuario', $this->id_usuario);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('data_nascimento', $this->data_nascimento, true);
        $criteria->compare('sexo', $this->sexo);
        $criteria->compare('cpf', $this->cpf, true);
        $criteria->compare('rg', $this->rg, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}