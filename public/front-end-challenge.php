<?php
/**
 * Admin functionality of the plugin.
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/admin
 */
?>

<article class="home">
    <div class="home_nav">
        <div class="nav_container">
            <div class="biz_dir_logo">
                <img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/BD_logo.png" alt="bd_logo">
            </div>
            <div class="biz_dir_btn">
                <img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/business_directory.png" alt="bd_btn">
            </div>
        </div>
    </div>
    <div class="home_background" style="background-image:url(<?php echo plugin_dir_url( __FILE__ ); ?>img/food_background.png);">
        <div class="home_hero">
            <div class="home_heading">
                <h1>Very Tasty Title About Resturants And Food</h1>
            </div>
            <div class="home_form-container">
                <form action="#" method="get" class="search-form">
                    <input type="text" name="search" placeholder="Restaurant name" class="text-field">
                    <select name="options" class="dropdown">
                        <option value="all_locations" selected>All Locations</option>
                        <option value="salt_lake_city">Salt Lake City</option>
                        <option value="provo">Provo</option>
                        <option value="ogden">Ogden</option>
                        <option value="park_city">Park City</option>
                        <option value="st_george">St. George</option>
                        <option value="lehi">Lehi</option>
                        <option value="murray">Murray</option>
                        <option value="spanish_fork">Spanish Fork</option>
                        <option value="draper">Draper</option>
                        <option value="layton">Layton</option>
                    </select>
                    <button type="submit" class="search-button">Search</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="home_all-categories">
        <div class="home_grid-containers">
            <div class="grid-container-1">
                <div class="add-btn">
                    <div class="item-icon">
                        <img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/plus-icon.png" alt="plus-icon">  
                    </div>
                    <div class="item-title add-title">
                        <p>Add a category</p>
                    </div>
                </div>
                <div class="grid-item" style="background-image:url(<?php echo plugin_dir_url( __FILE__ ); ?>img/pasta_img.png);">
                    <div class="item-heading">
                        <p class="item-title">Italian</p>
                        <p class="item-text">32 restaurants</p>
                    </div>
                </div>
                <div class="grid-item fancy-img" style="background-image:url(<?php echo plugin_dir_url( __FILE__ ); ?>img/fancy_img.png);">
                    <div class="item-heading">
                        <p class="item-title">French</p>
                        <p class="item-text">32 restaurants</p>
                    </div>
                </div>
                <div class="grid-item" style="background-image:url(<?php echo plugin_dir_url( __FILE__ ); ?>img/cake_img.png);">
                    <div class="item-heading">
                        <p class="item-title">Sweets</p>
                        <p class="item-text">32 restaurants</p>
                    </div>
                </div>
            </div>
            <div class="grid-container-2">
                <div class="grid-item tacos-img" style="background-image:url(<?php echo plugin_dir_url( __FILE__ ); ?>img/tacos_img.png);">
                    <div class="item-heading">
                        <p class="item-title">Mexican</p>
                        <p class="item-text">32 restaurants</p>
                    </div>
                </div>
                <div class="grid-item" style="background-image:url(<?php echo plugin_dir_url( __FILE__ ); ?>img/noodles_img.png);">
                    <div class="item-heading">
                        <p class="item-title">Asian</p>
                        <p class="item-text">32 restaurants</p>
                    </div>
                </div>
                <div class="grid-item candle-img" style="background-image:url(<?php echo plugin_dir_url( __FILE__ ); ?>img/candle_img.png);">
                    <div class="item-heading">
                        <p class="item-title">Coffee&Tea</p>
                        <p class="item-text">32 restaurants</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</article>

