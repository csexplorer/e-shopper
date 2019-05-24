<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="container">
  <div class="row">
      <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
      <?php endif; ?>

      <?php if (Yii::$app->session->hasFlash('fail')) : ?>
        <div class="alert alert-danger"><?= Yii::$app->session->getFlash('fail') ?></div>
      <?php endif; ?>
  </div>
</div>

<div class="container" style="border: 1px solid #ccc; margin-bottom: 50px; padding-bottom: 15px;">
  <?php if (!empty($session['cart'])) : ?>
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">Your cart</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-stripped">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Price</th>
                <th>Total Price</th>
                <th><span class="glyphicon glyphicon-remove"></span></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($session['cart'] as $id => $item) : ?>
                <tr>
                  <td><?= Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]) ?></td>
                  <td><a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                  <td><?= $item['qty'] ?></td>
                  <td>$<?= $item['price'] ?></td>
                  <td>$<?= $item['qty'] * $item['price'] ?></td>
                  <td><span class="glyphicon glyphicon-remove text-danger del-cart-item" data-id="<?= $id ?>"></span></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5" align="right">Total Count : </td>
                <td><?= $session['cart.qty'] ?></td>
              </tr>
              <tr>
                <td colspan="5" align="right">Total Sum  : </td>
                <td>$<?= $session['cart.sum'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <hr>

        <h2 class="text-center">Order Form</h2>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($order, 'name')->textInput() ?>
        <?= $form->field($order, 'email')->textInput() ?>
        <?= $form->field($order, 'phone')->textInput() ?>
        <?= $form->field($order, 'address')->textInput() ?>

        <?= Html::submitButton('Submit', ['class' => 'btn btn-success btn-block']) ?>

        <?php $form = ActiveForm::end(); ?>
      </div>
    </div>
      
  <?php else : ?>
    <h2>Cart is emtpty</h2>
  <?php endif; ?>
</div>
