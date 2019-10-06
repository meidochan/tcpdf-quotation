<?php 
    $post_number = $_POST["post_number"];
    $address = $_POST["address"];
    $name = $_POST["name"];
    
    $products = array();
    for($i = 1; $i < 6; $i++){
        $products[$i]["product_name"] = $_POST["product_name_".$i];
        $products[$i]["product_price"] = $_POST["product_price_".$i];
        $products[$i]["product_num"] = $_POST["product_num_".$i];
    }

    // var_dump($products);

    
?>
<form method="POST" action="./create_pdf.php">
<h1>PDF明細書フォーム</h1>
    <p>&#12306;：<?php echo $post_number ?></p>
    <p>住所：<?php echo $address ?></p>
    <p>氏名：<?php echo $name ?></p>
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
            <?php foreach($products as $product){ ?>
            <tr>
                <td><?php echo $product["product_name"]; ?></td>
                <td><?php echo $product["product_price"]; ?></td>
                <td><?php echo $product["product_num"]; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <p><input type="submit" name="submit" value="pdf出力"></p>
    <input type="hidden" name="post_number" value="<?php echo $post_number; ?>">
    <input type="hidden" name="address" value="<?php echo $address; ?>">
    <input type="hidden" name="name" value="<?php echo $name; ?>">

    <?php for($i = 1; $i < 6; $i++){ ?>
        <input type="hidden" name="<?php echo "product_name_".$i ?>" value="<?=htmlspecialchars($products[$i]["product_name"], ENT_COMPAT | ENT_HTML401, 'UTF-8')?>">
        <input type="hidden" name="<?php echo "product_price_".$i ?>" value="<?=htmlspecialchars($products[$i]["product_price"], ENT_COMPAT | ENT_HTML401, 'UTF-8')?>">
        <input type="hidden" name="<?php echo "product_num_".$i ?>" value="<?=htmlspecialchars($products[$i]["product_num"], ENT_COMPAT | ENT_HTML401, 'UTF-8')?>">
    <?php } ?>
    
</form>