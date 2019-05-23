<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;

/**
 * Description of ProductController
 *
 * @author csexplorer
 */
class ProductController extends AppController {
    
    public function actionView($id) {
        $product = Product::findOne($id);
        
        if (empty($product)) {
            throw new \yii\web\HttpException(404, 'Such product does not exist');
        }
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description);
        
        return $this->render('view', compact('product', 'hits'));
    }
}
