<?php


namespace ECommerce\Controllers;

use ECommerce\Site;
use ECommerce\Tables\ProductImages;
use ECommerce\Tables\Products;

class ProductController extends Controller {

    private $products;
    private $productImgs;
    private $files;
    private $post;

    public function __construct(Site $site, $post, $files) {
        parent::__construct($site);

        $this->post = $post;
        $this->files = $files;
        $this->products = new Products($site);
        $this->productImgs = new ProductImages($site);

        if($post) {
            if($this->products->add($post)) {

                $img = "";
                if(!empty($files) && $this->uploadImg()) {
                    $img = "src/img/products/" . basename($this->files["file"]["name"]);
                }

                if($this->productImgs->add($post["sku"], $img)) {
                    $this->result = json_encode(["ok" => true]);
                } else {
                    $this->result = json_encode(["ok" => false, "message" => "Failed to add Category!"]);
                }

            } else {
                $this->result = json_encode(["ok" => false]);
            }
        } else {
            $this->result = json_encode(["ok" => false]);
        }
    }

    public function uploadImg() {
        $target_dir = dirname(__FILE__)."/../../../src/img/products/";
        $target_file = $target_dir . basename($this->files["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image or fake
        if(!$this->validateImg()) {
            $this->result = json_encode(["ok" => false, "message" => "File isn't an img!"]);
            return false;
        }

        // Check if file already exists
        if(file_exists($target_file)) {
            $this->result = json_encode(["ok" => false, "message" => "File already exists!"]);
            return false;
        }

        // Check file size
        if($this->files["file"]["size"] > 5000000) {
            $this->result = json_encode(["ok" => false, "message" => "File is to large!"]);
            return false;
        }

        //Allow certain file types
        $allowedTypes = array("jpg", "png", "jpeg", "gif");
        if(!in_array($imageFileType, $allowedTypes)) {
            $this->result = json_encode(["ok" => false, "message" => "Only JPG, JPEG, PNG & GIF allowed!"]);
            return false;
        }

        // Try to upload file
        if(!move_uploaded_file($this->files["file"]["tmp_name"], $target_file)) {
            $this->result = json_encode(["ok" => false, "message" => "Error during file upload!"]);
            return false;
        }
        return true;
    }

    public function validateImg() {

        if(isset($this->post)) {
            $check = getimagesize($this->files["file"]["tmp_name"]);
            if($check !== false) {
                return true;
            }
        }
        return false;
    }
}
