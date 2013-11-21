<?php

/**
 * CDetectedModel class file.
 *
 */

class CDetectedModel extends \CModel
{
        /**
	 * @var CDbConnection the default database connection for all active record classes.
	 * By default, this is the 'db' application component.
	 * @see getDbConnection
	 */
	public static $db;

	private static $_models=array();			// class name => model

	private $_md;								// meta data
	private $_new=false;						// whether this instance is new or not
	private $_attributes=array();				// attribute name => attribute value
	private $_related=array();					// attribute name => related objects
	private $_c;								// query criteria (used by finder only)
	private $_pk;								// old primary key value
	private $_alias='t';						// the table alias being used for query


	/**
	 * Constructor.
	 * @param string $scenario scenario name. See {@link CModel::scenario} for more details about this parameter.
	 */
	public function __construct($scenario='insert')
	{
		if($scenario===null) // internally used by populateRecord() and model()
			return;

		$this->setScenario($scenario);
		$this->setIsNewRecord(true);
		$this->_attributes=$this->getMetaData()->attributeDefaults;

		$this->init();

		$this->attachBehaviors($this->behaviors());
		$this->afterConstruct();
	}

	/**
	 * Initializes this model.
	 * This method is invoked when an AR instance is newly created and has
	 * its {@link scenario} set.
	 * You may override this method to provide code that is needed to initialize the model (e.g. setting
	 * initial property values.)
	 */
	public function init()
	{
	}

	/**
	 * Sets the parameters about query caching.
	 * This is a shortcut method to {@link CDbConnection::cache()}.
	 * It changes the query caching parameter of the {@link dbConnection} instance.
	 * @param integer $duration the number of seconds that query results may remain valid in cache.
	 * If this is 0, the caching will be disabled.
	 * @param CCacheDependency $dependency the dependency that will be used when saving the query results into cache.
	 * @param integer $queryCount number of SQL queries that need to be cached after calling this method. Defaults to 1,
	 * meaning that the next SQL query will be cached.
	 * @return CActiveRecord the active record instance itself.
	 * @since 1.1.7
	 */
	public function cache($duration, $dependency=null, $queryCount=1)
	{
		$this->getDbConnection()->cache($duration, $dependency, $queryCount);
		return $this;
	}

	/**
	 * PHP sleep magic method.
	 * This method ensures that the model meta data reference is set to null.
	 * @return array
	 */
	public function __sleep()
	{
		$this->_md=null;
		return array_keys((array)$this);
	}

        
        /**
	 * PHP getter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @return mixed property value
	 * @see getAttribute
	 */
	public function __get($name)
	{
		if(isset($this->_attributes[$name]))
			return $this->_attributes[$name];
		elseif(isset($this->getMetaData()->columns[$name]))
			return null;
		elseif(isset($this->_related[$name]))
			return $this->_related[$name];
		elseif(isset($this->getMetaData()->relations[$name]))
			return $this->getRelated($name);
		else
			return parent::__get($name);
	}

	/**
	 * PHP setter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set($name,$value)
	{
		if($this->setAttribute($name,$value)===false)
		{
			if(isset($this->getMetaData()->relations[$name]))
				$this->_related[$name]=$value;
			else
				parent::__set($name,$value);
		}
	}

	/**
	 * Checks if a property value is null.
	 * This method overrides the parent implementation by checking
	 * if the named attribute is null or not.
	 * @param string $name the property name or the event name
	 * @return boolean whether the property value is null
	 */
	public function __isset($name)
	{
		if(isset($this->_attributes[$name]))
			return true;
		elseif(isset($this->getMetaData()->columns[$name]))
			return false;
		elseif(isset($this->_related[$name]))
			return true;
		elseif(isset($this->getMetaData()->relations[$name]))
			return $this->getRelated($name)!==null;
		else
			return parent::__isset($name);
	}

	/**
	 * Sets a component property to be null.
	 * This method overrides the parent implementation by clearing
	 * the specified attribute value.
	 * @param string $name the property name or the event name
	 */
	public function __unset($name)
	{
		if(isset($this->getMetaData()->columns[$name]))
			unset($this->_attributes[$name]);
		elseif(isset($this->getMetaData()->relations[$name]))
			unset($this->_related[$name]);
		else
			parent::__unset($name);
	}

	/**
	 * Calls the named method which is not a class method.
	 * Do not call this method. This is a PHP magic method that we override
	 * to implement the named scope feature.
	 * @param string $name the method name
	 * @param array $parameters method parameters
	 * @return mixed the method return value
	 */
	public function __call($name,$parameters)
	{
		if(isset($this->getMetaData()->relations[$name]))
		{
			if(empty($parameters))
				return $this->getRelated($name,false);
			else
				return $this->getRelated($name,false,$parameters[0]);
		}

		$scopes=$this->scopes();
		if(isset($scopes[$name]))
		{
			$this->getDbCriteria()->mergeWith($scopes[$name]);
			return $this;
		}

		return parent::__call($name,$parameters);
	}
        
        /**
	 * Returns the list of all attribute names of the model.
	 * This would return all column names of the table associated with this AR class.
	 * @return array list of attribute names.
	 */
	public function attributeNames()
	{
		return array_keys($this->getMetaData()->columns);
	}
        
        /**
	 * Returns the text label for the specified attribute.
	 * This method overrides the parent implementation by supporting
	 * returning the label defined in relational object.
	 * In particular, if the attribute name is in the form of "post.author.name",
	 * then this method will derive the label from the "author" relation's "name" attribute.
	 * @param string $attribute the attribute name
	 * @return string the attribute label
	 * @see generateAttributeLabel
	 * @since 1.1.4
	 */
	public function getAttributeLabel($attribute)
	{
		$labels=$this->attributeLabels();
		if(isset($labels[$attribute]))
			return $labels[$attribute];
		elseif(strpos($attribute,'.')!==false)
		{
			$segs=explode('.',$attribute);
			$name=array_pop($segs);
			$model=$this;
			foreach($segs as $seg)
			{
				$relations=$model->getMetaData()->relations;
				if(isset($relations[$seg]))
					$model=CActiveRecord::model($relations[$seg]->className);
				else
					break;
			}
			return $model->getAttributeLabel($name);
		}
		else
			return $this->generateAttributeLabel($attribute);
	}

	/**
	 * Returns the database connection used by active record.
	 * By default, the "db" application component is used as the database connection.
	 * You may override this method if you want to use a different database connection.
	 * @return CDbConnection the database connection used by active record.
	 */
	public function getDbConnection()
	{
		if(self::$db!==null)
			return self::$db;
		else
		{
			self::$db=\init::app()->getDb();
			if(self::$db instanceof CDbConnection)
				return self::$db;
			else
				throw new CDbException(\init::t('yii','Active Record requires a "db" CDbConnection application component.'));
		}
	}

        /**
	 * Checks whether this AR has the named attribute
	 * @param string $name attribute name
	 * @return boolean whether this AR has the named attribute (table column).
	 */
	public function hasAttribute($name)
	{
		return isset($this->getMetaData()->columns[$name]);
	}

	/**
	 * Returns the named attribute value.
	 * If this is a new record and the attribute is not set before,
	 * the default column value will be returned.
	 * If this record is the result of a query and the attribute is not loaded,
	 * null will be returned.
	 * You may also use $this->AttributeName to obtain the attribute value.
	 * @param string $name the attribute name
	 * @return mixed the attribute value. Null if the attribute is not set or does not exist.
	 * @see hasAttribute
	 */
	public function getAttribute($name)
	{
		if(property_exists($this,$name))
			return $this->$name;
		elseif(isset($this->_attributes[$name]))
			return $this->_attributes[$name];
	}

	/**
	 * Sets the named attribute value.
	 * You may also use $this->AttributeName to set the attribute value.
	 * @param string $name the attribute name
	 * @param mixed $value the attribute value.
	 * @return boolean whether the attribute exists and the assignment is conducted successfully
	 * @see hasAttribute
	 */
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		elseif(isset($this->getMetaData()->columns[$name]))
			$this->_attributes[$name]=$value;
		else
			return false;
		return true;
	}

        
        /**
	 * Returns all column attribute values.
	 * Note, related objects are not returned.
	 * @param mixed $names names of attributes whose value needs to be returned.
	 * If this is true (default), then all attribute values will be returned, including
	 * those that are not loaded from DB (null will be returned for those attributes).
	 * If this is null, all attributes except those that are not loaded from DB will be returned.
	 * @return array attribute values indexed by attribute names.
	 */
	public function getAttributes($names=true)
	{
		$attributes=$this->_attributes;
		foreach($this->getMetaData()->columns as $name=>$column)
		{
			if(property_exists($this,$name))
				$attributes[$name]=$this->$name;
			elseif($names===true && !isset($attributes[$name]))
				$attributes[$name]=null;
		}
		if(is_array($names))
		{
			$attrs=array();
			foreach($names as $name)
			{
				if(property_exists($this,$name))
					$attrs[$name]=$this->$name;
				else
					$attrs[$name]=isset($attributes[$name])?$attributes[$name]:null;
			}
			return $attrs;
		}
		else
			return $attributes;
	}

	/**
	 * Saves the current record.
	 *
	 * The record is inserted as a row into the database table if its {@link isNewRecord}
	 * property is true (usually the case when the record is created using the 'new'
	 * operator). Otherwise, it will be used to update the corresponding row in the table
	 * (usually the case if the record is obtained using one of those 'find' methods.)
	 *
	 * Validation will be performed before saving the record. If the validation fails,
	 * the record will not be saved. You can call {@link getErrors()} to retrieve the
	 * validation errors.
	 *
	 * If the record is saved via insertion, its {@link isNewRecord} property will be
	 * set false, and its {@link scenario} property will be set to be 'update'.
	 * And if its primary key is auto-incremental and is not set before insertion,
	 * the primary key will be populated with the automatically generated key value.
	 *
	 * @param boolean $runValidation whether to perform validation before saving the record.
	 * If the validation fails, the record will not be saved to database.
	 * @param array $attributes list of attributes that need to be saved. Defaults to null,
	 * meaning all attributes that are loaded from DB will be saved.
	 * @return boolean whether the saving succeeds
	 */
	public function save($runValidation=true,$attributes=null)
	{
                
		if(!$runValidation || $this->validate($attributes))
                        return $this->getIsNewRecord() ? $this->insert($attributes) : $this->update($attributes);
		else
			return false;
                
	}

        /**
	 * Inserts a row into the table based on this active record attributes.
	 * If the table's primary key is auto-incremental and is null before insertion,
	 * it will be populated with the actual value after insertion.
	 * Note, validation is not performed in this method. You may call {@link validate} to perform the validation.
	 * After the record is inserted to DB successfully, its {@link isNewRecord} property will be set false,
	 * and its {@link scenario} property will be set to be 'update'.
	 * @param array $attributes list of attributes that need to be saved. Defaults to null,
	 * meaning all attributes that are loaded from DB will be saved.
	 * @return boolean whether the attributes are valid and the record is inserted successfully.
	 * @throws CDbException if the record is not new
	 */
	public function insert($attributes=null)
	{
		if(!$this->getIsNewRecord())
			throw new CDbException(\init::t('yii','The active record cannot be inserted to database because it is not new.'));
		/*
                if($this->beforeSave())
		{
			\init::trace(get_class($this).'.insert()','system.db.ar.CActiveRecord');
			$builder=$this->getCommandBuilder();
			$table=$this->getMetaData()->tableSchema;
			$command=$builder->createInsertCommand($table,$this->getAttributes($attributes));
			if($command->execute())
			{
				$primaryKey=$table->primaryKey;
				if($table->sequenceName!==null)
				{
					if(is_string($primaryKey) && $this->$primaryKey===null)
						$this->$primaryKey=$builder->getLastInsertID($table);
					elseif(is_array($primaryKey))
					{
						foreach($primaryKey as $pk)
						{
							if($this->$pk===null)
							{
								$this->$pk=$builder->getLastInsertID($table);
								break;
							}
						}
					}
				}
				$this->_pk=$this->getPrimaryKey();
				$this->afterSave();
				$this->setIsNewRecord(false);
				$this->setScenario('update');
				return true;
			}
		}
                */
                
		return false;
	}

	/**
	 * Updates the row represented by this active record.
	 * All loaded attributes will be saved to the database.
	 * Note, validation is not performed in this method. You may call {@link validate} to perform the validation.
	 * @param array $attributes list of attributes that need to be saved. Defaults to null,
	 * meaning all attributes that are loaded from DB will be saved.
	 * @return boolean whether the update is successful
	 * @throws CDbException if the record is new
	 */
	public function update($attributes=null)
	{
		if($this->getIsNewRecord())
			throw new CDbException(\init::t('yii','The active record cannot be updated because it is new.'));
		/*
                if($this->beforeSave())
		{
			\init::trace(get_class($this).'.update()','system.db.ar.CActiveRecord');
			if($this->_pk===null)
				$this->_pk=$this->getPrimaryKey();
			$this->updateByPk($this->getOldPrimaryKey(),$this->getAttributes($attributes));
			$this->_pk=$this->getPrimaryKey();
			$this->afterSave();
			return true;
		}
		else */
			return false;
	}

	/**
	 * Saves a selected list of attributes.
	 * Unlike {@link save}, this method only saves the specified attributes
	 * of an existing row dataset and does NOT call either {@link beforeSave} or {@link afterSave}.
	 * Also note that this method does neither attribute filtering nor validation.
	 * So do not use this method with untrusted data (such as user posted data).
	 * You may consider the following alternative if you want to do so:
	 * <pre>
	 * $postRecord=Post::model()->findByPk($postID);
	 * $postRecord->attributes=$_POST['post'];
	 * $postRecord->save();
	 * </pre>
	 * @param array $attributes attributes to be updated. Each element represents an attribute name
	 * or an attribute value indexed by its name. If the latter, the record's
	 * attribute will be changed accordingly before saving.
	 * @return boolean whether the update is successful
	 * @throws CException if the record is new or any database error
	 */
	public function saveAttributes($attributes)
	{
		if(!$this->getIsNewRecord())
		{
			\init::trace(get_class($this).'.saveAttributes()','system.db.ar.CActiveRecord');
			$values=array();
			foreach($attributes as $name=>$value)
			{
				if(is_integer($name))
					$values[$value]=$this->$value;
				else
					$values[$name]=$this->$name=$value;
			}
			if($this->_pk===null)
				$this->_pk=$this->getPrimaryKey();
			if($this->updateByPk($this->getOldPrimaryKey(),$values)>0)
			{
				$this->_pk=$this->getPrimaryKey();
				return true;
			}
			else
				return false;
		}
		else
			throw new CDbException(\init::t('yii','The active record cannot be updated because it is new.'));
	}

        /**
	 * Deletes the row corresponding to this active record.
	 * @return boolean whether the deletion is successful.
	 * @throws CException if the record is new
	 */
	public function delete()
	{
		if(!$this->getIsNewRecord())
		{
			Yii::trace(get_class($this).'.delete()','system.db.ar.CActiveRecord');
			if($this->beforeDelete())
			{
				$result=$this->deleteByPk($this->getPrimaryKey())>0;
				$this->afterDelete();
				return $result;
			}
			else
				return false;
		}
		else
			throw new CDbException(\init::t('yii','The active record cannot be deleted because it is new.'));
	}

	/**
	 * Repopulates this active record with the latest data.
	 * @return boolean whether the row still exists in the database. If true, the latest data will be populated to this active record.
	 */
	public function refresh()
	{
		\init::trace(get_class($this).'.refresh()','system.db.ar.CActiveRecord');
		if(($record=$this->findByPk($this->getPrimaryKey()))!==null)
		{
			$this->_attributes=array();
			$this->_related=array();
			foreach($this->getMetaData()->columns as $name=>$column)
			{
				if(property_exists($this,$name))
					$this->$name=$record->$name;
				else
					$this->_attributes[$name]=$record->$name;
			}
			return true;
		}
		else
			return false;
	}
        
        /**
	 * Returns if the current record is new.
	 * @return boolean whether the record is new and should be inserted when calling {@link save}.
	 * This property is automatically set in constructor and {@link populateRecord}.
	 * Defaults to false, but it will be set to true if the instance is created using
	 * the new operator.
	 */
	public function getIsNewRecord()
	{
		return $this->_new;
	}

	/**
	 * Sets if the record is new.
	 * @param boolean $value whether the record is new and should be inserted when calling {@link save}.
	 * @see getIsNewRecord
	 */
	public function setIsNewRecord($value)
	{
		$this->_new=$value;
	}

}