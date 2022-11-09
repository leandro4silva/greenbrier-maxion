<?php

session_start();

include_once("connection.php");
include_once("url.php");

$files = $_FILES;
$data = $_POST;


if (!empty($data)) {
    if ($data["type"] === 'create') {
        $cod_prod = $data["cod_prod"];
        $name = $data["name"];
        $price = $data["price"];
        $measure = $data["measure"];

        $query = "INSERT INTO products (cod_prod, name, price, measure) VALUES (:cod_prod, :name, :price, :measure)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":cod_prod", $cod_prod);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":measure", $measure);

        try {
            $stmt->execute();
            $_SESSION["msg"] = "Produto criado com sucesso";
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }

        header("Location:" . $BASE_URL . "../product.php");

    } else if ($data["type"] === "update") {
        $cod_prod = $data["cod_prod"];
        $name = $data["name"];
        $price = $data["price"];
        $measure = $data["measure"];
        $id = $data["id"];

        $query = "UPDATE products 
                      SET cod_prod= :cod_prod, name = :name, price = :price, measure = :measure 
                      WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":cod_prod", $cod_prod);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":measure", $measure);
        $stmt->bindParam(":id", $id);

        try {
            $stmt->execute();
            $_SESSION["msg"] = "Produto atualizado com sucesso";
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }

        header("Location:" . $BASE_URL . "../product.php");

    } else if ($data["type"] === 'delete') {
        $id = $data["id"];

        $query = "DELETE FROM products WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        try {
            $stmt->execute();
            $_SESSION["msg"] = "Produto deletado com sucesso";
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }

        header("Location:" . $BASE_URL . "../product.php");

    } else if ($data["type"] === 'upload_file') {
        $file = $files["file"]["tmp_name"];
        $name = $files["file"]["name"];

        $ext = explode(".", $name);

        $extension = end($ext);

        if ($extension != "csv") {
            $_SESSION["msg"] = "Arquivo invalido";
            header("Location:" . $BASE_URL . "../index.php");
        } else {
            $query = "TRUNCATE TABLE sales";

            $stmt = $conn->prepare($query);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                $error = $e->getMessage();
                echo "Error: $error";
            }

            $sales = fopen($file, 'r');

            while (($row = fgetcsv($sales, 1000, ",")) !== FALSE) {
                $prod_id = utf8_encode($row[0]);
                $date_sale = utf8_encode($row[1]);
                $amount = utf8_encode($row[2]);
                $total_sale = utf8_encode($row[3]);

                $query = "INSERT INTO sales (prod_id, date_sale, amount, total_sale) VALUES (:prod_id, :date_sale, :amount, :total_sale)";
                $stmt = $conn->prepare($query);

                $stmt->bindParam(":prod_id", $prod_id);
                $stmt->bindParam(":date_sale", $date_sale);
                $stmt->bindParam(":amount", $amount);
                $stmt->bindParam(":total_sale", $total_sale);

                try {
                    $stmt->execute();
                } catch (PDOException $e) {
                    $error = $e->getMessage();
                    echo "Error: $error";
                }
            }

            $query = "SELECT products.name, sales.total_sale, sales.date_sale, sales.amount  FROM sales INNER JOIN products ON products.id = sales.prod_id";

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $sales = $stmt->fetchAll();

            $_SESSION["sales"] = $sales;
            header("Location:" . $BASE_URL . "../index.php");
        }
    }else if ($data["type"] === 'search') {
        $name = $data["name"];
        
        $query = 'SELECT * FROM products WHERE name LIKE "%":name"%"';

        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(":name", $name);
        
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }
        
        $products = $stmt->fetchAll();
        
        $_SESSION['filter'] = $products;

        header("Location:" . $BASE_URL . "../product.php");
    }
} else {
    $id;
    $search;

    if (!empty($_GET)) {
        $id = $_GET["id"];

        if (!empty($_GET["type"] === "search")) {
            $search = $_GET["name"];
        }
    }

    if (!empty($id)) {
        $query = "SELECT * FROM products WHERE id=:id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $product = $stmt->fetch();

    } else {

        $query = 'SELECT * FROM products ';

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $products = $stmt->fetchAll();

        $_SESSION['products'] = $products;
    }
}

$conn = null;

?>