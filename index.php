<form method="POST" action="./check.php">
    <h1>PDF明細書フォーム</h1>
    <p>&#12306;：<input type="text" name="post_number" size="30"></p>
    <p>住所：<input type="text" name="address" size="30"></p>
    <p>氏名：<input type="text" name="name" size="30"></p>
    <p>購入明細</p>
    <table>
        <thead>
            <tr>
                <th>商品名</th>
                <th>単価</th>
                <th>数量</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 1; $i < 6; $i++){ ?>
            <tr>
                <td><input type="text" name="<?php echo "product_name_".$i ?>"></td>
                <td><input type="text" name="<?php echo "product_price_".$i ?>"></td>
                <td><input type="text" name="<?php echo "product_num_".$i ?>"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <p><input type="submit" name="submit" value="確認画面"></p>
</form>