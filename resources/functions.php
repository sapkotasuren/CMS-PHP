<?php
/**
 * Created by PhpStorm.
 * User: suren
 * Date: 24/02/2018
 * Time: 11:26
 */

if ($connection) {
    echo "is connected from functions.php";
} else {
    echo "not connected";
}


function redirect($location)
{
    header("Location: $location");
}

function query($sql)
{
    //if you want to use the connection inside the function make it global..
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result)
{
    global $connection;

    if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }

}

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}


function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

//get products

function get_products()
{

    $query = query("SELECT * FROM products");
    confirm($query);
    while ($row = fetch_array($query)) {
        //heredoc
        $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                           <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right">	&#8364;{$row['product_price']}</h4>
                                <h4><a href="item.php?{$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>test</p>
                                <a class="btn btn-primary" target="_blank"
                                   href="#">View
                                    Tutorial</a>
                            </div>

                        </div>
                    </div>
DELIMETER;
        echo $product;
    }
}


function get_categories()
{
    $query = query("SELECT * FROM categories");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category = <<<DELIMETER
<a href="category.php?id={$row['cat_id']}"class="list-group-item">{$row['cat_title']}</a>
DELIMETER;
        echo $category;
    }

}
