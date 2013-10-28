<?php

class TestController extends \Controller
{
	public $layout='column2';
	private $_model;

	public function filters() {
		
	}

	public function accessRules() {
		
	}

	public function actionView() {
		//$post=$this->loadModel();
		//$comment=$this->newComment($post);
            echo "BLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
		
                $this->render('view',array(
			'model'=> [1,2],
			'comment' => 'component',
		));
                
	}

	public function actionCreate() {
            $model=$this->loadModel();
            
            echo "create Action";
            
            $_gets = $this->getActionParams();
            echo "<pre>";
            var_dump( $_gets );
            echo "</rpe>";
            
            $dataProvider = ['blaaa', 'ddddd'];
            
            
            // include view default index
            $this->render('index',array(
                        'dataProvider' => $dataProvider,
			'model'=> [1,2],
			'comment' => 'component',
		));
            
            
            //if(!$_GET['q']) 
                //throw new \CHttpException(404,'The requested page does not exist.');
	}

	public function actionUpdate() {

	}

	public function actionDelete() {
            echo "action delete";
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            
            $dataProvider = ['blaaa', 'ddddd'];
            
            $this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
            
	}

	
	
	public function actionSuggestTags() {
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
//		if($this->_model===null)
//		{
//			if(isset($_GET['id']))
//			{
//				if(Yii::app()->user->isGuest)
//					$condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
//				else
//					$condition='';
//				$this->_model=Post::model()->findByPk($_GET['id'], $condition);
//			}
//			if($this->_model===null)
//				throw new CHttpException(404,'The requested page does not exist.');
//		}
//		return $this->_model;
	}

	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($post)
	{
//		$comment=new Comment;
//		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
//		{
//			echo CActiveForm::validate($comment);
//			Yii::app()->end();
//		}
//		if(isset($_POST['Comment']))
//		{
//			$comment->attributes=$_POST['Comment'];
//			if($post->addComment($comment))
//			{
//				if($comment->status==Comment::STATUS_PENDING)
//					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
//				$this->refresh();
//			}
//		}
//		return $comment;
	}
}
