<?php
include 'koneksi1.php';
    session_start();
    $koneksi = mysqli_connect("localhost","root","","cakestore");

    if(isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'product_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"] [$count] = $item_array;

                echo '<script>alert("Produk berhasil dimasukan keranjang")</script>';
                echo '<script>window.location = "cart_view.php"</script>';

            }else{
                echo '<script>alert("Produk Sudah ada di keranjang")</script>';
                echo '<script>window.location = "cart_view.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'product_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"] [0] = $item_array;

            echo '<script>alert("Produk berhasil dimasukan keranjang")</script>';
            echo '<script>window.location = "cart_view.php"</script>';
        }
    }
    if (isset($_GET["action"])){
        if ($_GET["action"] == delete){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value['product_id'] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Produk telah dihapus...!")</script>';
                    echo '<script>window.location = "cart_view.php"</script>';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>
    <link rel="stylesheet" href="css/table copy.css">
</head>

<body>
    <div class="container" style="width: 65%;">
    <a href="index.php" class="btn btn-info">Lanjutkan belanja</a>

    <div style="clear: both;"></div>
    <h3 class="tittle2">shopping cart details</h3>
    <div class="table-responsive">
        <table class="table table-bordered" >
            <tr>
                <th width="30%">Nama Kue</th>
                <th width="10%">Qty</th>
                <th width="13%">Harga</th>
                <th width="10%">Total</th>
                <th width="17%">Aksi</th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value){
                        ?>
                        <tr>
                            <td><?=$value["product_name"]?></td>
                            <td><?=$value["item_quantity"]?></td>
                            <td><?=$value["product_price"]?></td>
                            <td>
                                Rp <?php echo number_format($value["item_quantity"] * $value ["product_price"], 2);?></td>
                            <td><a href="cart_view.php?action=delete&id=<?php echo $value["product_id"]?>"><span
                                class="text-danger">Hapus</span></a></td>
                        </tr>
                        <?php
                        $total = $total +($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right">Grand total</td>
                            <th align="right">Rp<?php echo number_format($total,2)?></th>
                            <td></td>
                        </tr>
                        <?php
                    }
                    ?>
        </table>
    </div>
    </div>
</body>

</html>