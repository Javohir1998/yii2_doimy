<?php
namespace backend\controllers;

use common\models\User;
use common\rbac\models\Role;
use frontend\models\SignupForm;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
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
                        'actions' => ['login', 'error', 'signup'],
                        'allow' => true,
                    ],
                    [
                    'controllers' => ['user', 'site'],
                    'actions' => [
                        'index', 'chatdelete ', 'signup'
                    ],
                    'allow' => true,
                    'roles' => ['User'],
                ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Ro\'yxatdan o\'tganingiz uchun tashakkur.');
            $user = new User();
            $role = new Role();
            $password=($_POST['SignupForm']["password"]);
            $username=($_POST['SignupForm']["username"]);

            $user->username = $username;
            try {
                $user->auth_key = Yii::$app->security->generateRandomString();
            } catch (Exception $e) {
            }
            try {
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
            } catch (Exception $e) {
            }
            $user->status=10;
            $user->rule = 'User';
            $user->verification_token=Yii::$app->user->identity;
            if ($user->save()){
                $role->user_id = $user->getId();
                $role->item_name = 'User';
                $role->save();
            }
            return $this->redirect(['/site/login']);
        }else{
            return $this->render('signup', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
