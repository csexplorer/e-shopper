<?php
use yii\helpers\Html;
?>
<?php if (!empty($session['cart'])) : ?>

  <div class="table-responsive">
    <table class="table table-hover table-stripped">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Amount</th>
          <th>Price</th>
          <th><span class="glyphicon glyphicon-remove"></span></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($session['cart'] as $id => $item) : ?>
          <tr>
            <td><?= Html::img("/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 50]) ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['qty'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><span class="glyphicon glyphicon-remove text-danger del-cart-item" data-id="<?= $id ?>"></span></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="4">Total Count: </td>
          <td><?= $session['cart.qty'] ?></td>
        </tr>
        <tr>
          <td colspan="4">Total Sum: </td>
          <td><?= $session['cart.sum'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
    
<?php else : ?>
  <h2>Cart is emtpty</h2>
<?php endif; ?>