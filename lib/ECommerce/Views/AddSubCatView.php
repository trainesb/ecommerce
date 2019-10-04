<?php


namespace ECommerce\Views;


use ECommerce\Site;
use ECommerce\Tables\SubCategories;

class AddSubCatView extends View {

    private $site;
    private $subCategories;

    public function __construct(Site $site) {
        $this->site = $site;
        $this->subCategories = new SubCategories($this->site);

        $this->setTitle("Add Sub-Category");

        $this->addLink("./profile.php", "Profile");
        $this->addLink("post/logout.php", "Log Out");
    }

    public function present() {
        echo "<div class='row-container'>";
        echo $this->sideNav();
        echo "<div class='col-main'>";
        echo "<h1 class='center'>Collections</h1>";
        echo $this->addSub();
        echo "</div></div>";
    }



    public function addSub() {
        return <<<HTML
<form id="add-sub-cat" name="add-sub-cat">
    <fieldset>
        <legend>Sub Category</legend>
        <p>
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" placeholder="Name">
        </p>
        <p>
            <label for="description">Description</label><br>
            <textarea id="description" name="description" placeholder="Description..."></textarea>
        </p>
        <p>
            <label for="file">Select Image to upload</label>
            <input type="file" id="file" name="file">
        <p>
            <label for="visible">Visible</label>
            <select id="visible" name="visible">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
        </p>
       	<p>
			<input type="submit" value="Upload Image" name="submit">
		</p>
    </fieldset>
</form>
HTML;
    }

}