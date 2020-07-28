<?php

namespace app\controllers;


use app\models\form\UsersForm;
use app\models\search\UsersSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index',
            [
            ]);
    }

    /**
     * @return string
     */
    public function actionUsers()
    {

        $searchModel = new UsersSearch();
        $searchModel->load(Yii::$app->request->get());
        $dataProvider = $searchModel->search();

        return $this->render('users',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,

            ]);
    }


    /**
     * @param null $id
     */
    public function actionDeletedUser($id = null)
    {
        if (empty($id))
            $this->redirect(['admin/users']);

        $formModel = new UsersForm();
        $formModel->id = intval($id);
        $formModel->deleteById();

        $this->redirect(['admin/users']);

    }


    /**
     * @param null $id
     */
    public function actionGit()
    {
        if (Yii::$app->user->getId() != 1)
            return false;

        function execPrint($command)
        {
            $result = shell_exec($command);
               // var_dump($r);
            var_dump($result);
        }


        // execPrint('git pull https://Miller0:MrMillerG580@github.com/Miller0/basePacketFrameworkYii.git master');
        execPrint('cd');
         //execPrint('ls');
       // execPrint('npm update');
        return 1;
    }

}