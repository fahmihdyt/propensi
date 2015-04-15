<?php

namespace app\controllers;

use Yii;
use app\models\Barismilestone;
use app\models\BarismilestoneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BarismilestoneController implements the CRUD actions for Barismilestone model.
 */
class HomeController extends Controller
{
   public function actionIndex(){
   		return $this->render('home');
   }
}
