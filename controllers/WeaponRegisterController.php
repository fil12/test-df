<?php

namespace app\controllers;

use app\models\search\WeaponRegisterSearch;
use app\models\WeaponRegister;
use app\services\WeaponService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * WeaponRegisterController implements the CRUD actions for WeaponRegister model.
 */
class WeaponRegisterController extends Controller
{

    /** @var WeaponService */
    public $weaponService;

    /**
     * @param $weaponService
     */
    public function __construct($id, $module, $config, WeaponService $weaponService)
    {
        parent::__construct($id, $module, $config);
        $this->weaponService = $weaponService;
    }


    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update'],
                            'roles' => ['rao']
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all WeaponRegister models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WeaponRegisterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WeaponRegister model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WeaponRegister model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($employeeId)
    {
        $record = $this->weaponService->createRecord($this->request, $employeeId);

        if ($this->request->isPost) {
            return $this->redirect(['employee/view', 'id' => $employeeId]);
        }

        return $this->render('create', [
            'model' => $record,
            'employee' => $this->weaponService->getEmployeeForWeapon($employeeId)
        ]);
    }

    /**
     * Updates an existing WeaponRegister model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $employeeId)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'employee' => $this->weaponService->getEmployeeForWeapon($employeeId)
        ]);
    }

    /**
     * Finds the WeaponRegister model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return WeaponRegister the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WeaponRegister::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
