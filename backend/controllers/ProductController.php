<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\Type;
use common\models\Image;
use common\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied by default
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $typesAll = Type::find()->all();
        $typesOld = $model->types;
        $imagesAll = Image::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($_POST['Product']['types']);

            $model->save();

            // Types
            if (!empty($_POST['Product']['types'])) {
                $types = $_POST['Product']['types'];

                foreach ($types as $type) {
                    $model->link('types', Type::findOne($type));
                }
            }

            // Images
            if (!empty($_POST['Product']['images'])) {
                $types = $_POST['Product']['images'];

                foreach ($images as $image) {
                    $model->link('images', Image::findOne($image));
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'types' => $typesAll,
            'images' => $imagesAll,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $typesAll = Type::find()->all();
        $typesOld = $model->types;
        $imagesAll = Image::find()->all();
        $imagesOld = $model->images;

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($_POST['Product']['types']);

            $model->save();

            // Types
            if (!empty($_POST['Product']['types'])) {
                $types = $_POST['Product']['types'];

                // delet all previous types:
                foreach ($typesOld as $type) {
                    $model->unlinkAll('types', true);
                }

                // setup new types
                foreach ($types as $type) {
                    $model->link('types', Type::findOne($type));
                }
            }

            // Image
            if (!empty($_POST['Product']['images'])) {
                $images = $_POST['Product']['images'];

                // delet all previous images:
                foreach ($imagesOld as $image) {
                    $model->unlinkAll('images', true);
                }

                // setup ne images
                foreach ($images as $image) {
                    $model->link('images', Image::findOne($image));
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'types' => $typesAll,
            'images' => $imagesAll,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $typesOld = $model->types;
        $imagesOld = $model->images;

        // delet all types relation:
        foreach ($typesOld as $type) {
            $model->unlinkAll('types', true);
        }

        // delet all images relation:
        foreach ($imagesOld as $image) {
            $model->unlinkAll('images', true);
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Product the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
