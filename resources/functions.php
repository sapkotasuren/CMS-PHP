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

function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
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


function get_products_in_cat_page()
{
    $query = query("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " ");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
        echo $category;
    }
}

function get_products_in_shop_page()
{
    $query = query("SELECT * FROM products");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
        echo $category;
    }
}

function login_user()
{
    if (isset($_POST['submit'])) {
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);
        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password= '{$password}'");
        confirm($query);
        if (mysqli_num_rows($query) == 0) {
            //set message to session
            set_message("Your username or password is wrong");
            redirect("login.php");
        } else {
            set_message("Welcome to Admin Panel {$username}");
            redirect("admin");
        }
    }
}


function send_message()
{
    if (isset($_POST['submit'])) {
        $to = "sanjogsurendra@gmail.com";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $headers = "From:{$name} {$email}";

        $result = mail($to, $subject, $message, $headers);

        if (!$result) {
            set_message("sorry your message hasn't been sent ");
            redirect("contact.php");
        } else {
            set_message("your message has been sent");
            redirect("contact.php");
        }


    }
}





