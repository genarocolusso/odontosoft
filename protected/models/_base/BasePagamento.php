<?php

/**
 * This is the model base class for the table "pagamento".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Pagamento".
 *
 * Columns in table "pagamento" available as properties of the model,
 * followed by relations of table "pagamento" available as properties of the model.
 *
 * @property integer $id_pagamento
 * @property integer $id_consulta
 * @property string $valor
 * @property integer $id_tipo_pagamento
 * @property integer $id_status
 * @property string $data_criacao
 *
 * @property Consulta $idConsulta
 * @property TipoPagamento $idTipoPagamento
 * @property Status $idStatus
 * @property Parcela[] $parcelas
 */
abstract class BasePagamento extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'pagamento';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Pagamento|Pagamentos', $n);
	}

	public static function representingColumn() {
		return 'valor';
	}

	public function rules() {
		return array(
			array('id_consulta, valor, id_tipo_pagamento, id_status, data_criacao', 'required'),
			array('id_consulta, id_tipo_pagamento, id_status', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>5),
			array('id_pagamento, id_consulta, valor, id_tipo_pagamento, id_status, data_criacao', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idConsulta' => array(self::BELONGS_TO, 'Consulta', 'id_consulta'),
			'idTipoPagamento' => array(self::BELONGS_TO, 'TipoPagamento', 'id_tipo_pagamento'),
			'idStatus' => array(self::BELONGS_TO, 'Status', 'id_status'),
			'parcelas' => array(self::HAS_MANY, 'Parcela', 'id_pagamento'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id_pagamento' => Yii::t('app', 'Id Pagamento'),
			'id_consulta' => null,
			'valor' => Yii::t('app', 'Valor'),
			'id_tipo_pagamento' => null,
			'id_status' => null,
			'data_criacao' => Yii::t('app', 'Data Criacao'),
			'idConsulta' => null,
			'idTipoPagamento' => null,
			'idStatus' => null,
			'parcelas' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id_pagamento', $this->id_pagamento);
		$criteria->compare('id_consulta', $this->id_consulta);
		$criteria->compare('valor', $this->valor, true);
		$criteria->compare('id_tipo_pagamento', $this->id_tipo_pagamento);
		$criteria->compare('id_status', $this->id_status);
		$criteria->compare('data_criacao', $this->data_criacao, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}