<?php


namespace ECommerce\Views;

use ECommerce\Site;

class View {

    private $title = "";
    private $links = [];    //Links to add to the nav bar
    private $protectRedirect = null;

    public function protect(Site $site, $user) {
        if($user->isStaff()) {
            return true;
        }

        $this->protectRedirect = $site->getRoot() . "/";
        return false;
    }

    public function getProtectRedirect() {
        return $this->protectRedirect;
    }

    public function setTitle($title) { $this->title = $title; }

    public function addLink($href, $text) { $this->links[] = ["href" => $href, "text" => $text]; }

    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>$this->title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="dist/main.js"></script>
HTML;
    }

    public function nav($site) {
        $html = <<<HTML
<nav>
    <ul class="left">
        <li><a href="./">Business Name (Header)</a></li>
    </ul>
HTML;

        if(count($this->links) > 0) {
            $html .= '<ul class="right">';
            foreach($this->links as $link) {
                $html .= '<li><a href="' .
                    $link['href'] . '">' .
                    $link['text'] . '</a></li>';
            }
            $html .= '</ul>';
        }

        $html .= '</nav>';
        return $html;
    }

    public function sideNav() {
        return <<<HTML
<div class="sideNav">
    <p><a href=".\staff.php">Staff</a></p>
    
    <p class="products"><a href="">Products</a></p>
    <ul class="sub" hidden>
        <li><p><a href=".\products.php">All Products</a></p></li>
        <li><p><a href=".\add-product.php">Add Product</a></p></li>
    </ul>
    
    <p class="collections"><a href="">Categories</a></p>
    <ul class="sub" hidden>
        <li><p><a href=".\categories.php">All Categories</a></p></li>
        <li><p><a href=".\add-cat.php">Add Category</a></p></li>
    </ul>
    
    <p class="users"><a>Users</a></p>
    <ul class="sub" hidden>
        <li><p><a href=".\users.php">All Users</a></p></li>
        <li><p><a href=".\add-user.php">Add User</a></p></li>
    </ul>
</div>
HTML;
    }

    public function footer() {
        return <<<HTML
<footer><p>Copyright © 2019 (Business Name). All Rights Reserved.</p></footer>
HTML;
    }
}
