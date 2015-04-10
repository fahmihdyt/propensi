<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    
    <title>Login - SIMANPRO PT JAL</title>
    <link rel="shortcut icon" href="http://localhost/propensi/views/layouts/semi-logo.png" />
    <link href="<?php echo Yii::$app->params['base']?>css/sb-admin-2.css" rel="stylesheet">
    
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="line" style="top: 0px; height: 50px;"></div>
    
    <center><img class="img-logo-login" src="http://localhost/propensi/views/layouts/logo.png"></center>
    
    <div class="login-box" style="margin-top: 10px; padding-bottom: 3px;">
    	<?= $content ?>
    </div>
  

    <footer class="line">
        <p class="pull-left">&copy; PT Jaya Anugrah Lestari <?= date('Y') ?></p>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
