<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;

/**
 * Description of CategoryController
 *
 * @author csexplorer
 */
class CategoryController extends AppController {
    
    public function actionIndex() {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER');
        return $this->render('index', ['hits' => $hits]);
    }
    
    public function actionView($id) {
//        $products = Product::find()->where(['category_id' => $id])->all();
        $category = Category::findOne($id);
        
        if (empty($category)) {
            throw new \yii\web\HttpException(404, 'Such category does not exist');
        }

        $query = Product::find()->where(['category_id' => $id]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description);
        
        return $this->render('view', [
            'products' => $products,
            'pages' => $pages,
            'category' => $category
        ]);
    }
    
    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        
        $this->setMeta('E-SHOPPER | Search: ' . $q);

        if (!$q) {
            return $this->render('search', compact('q'));
        }
        
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('search', [
            'products' => $products,
            'pages' => $pages,
            'q' => $q
        ]);
    }
}
