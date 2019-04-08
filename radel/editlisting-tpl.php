<?php
$id = get_current_user_id();
$time = time();
$auth = md5('rdl' . $id . $time);
$img='http://localhost/ecw/wp-content/uploads/private/linkedin.png';
print_r(wp_upload_dir());
?>
<img src="<?php echo WPORTAL__PLUGIN_URL . "/fetch.php?img=$img&id=$id&auth=$auth&time=$time" ?>">

<style>
    .radel-edit-listing-form input[type="text"],.radel-edit-listing-form select,.radel-edit-listing-form input[type="number"],.radel-edit-listing-form input[type="date"]{
        width: 350px;
        padding: 5px;
        margin-bottom: 20px;
    }    
    .radel-edit-listing-form input[type="checkbox"],   .radel-edit-listing-form input[type="radio"]{
        margin-bottom: 10px;
    }
    .radel-edit-listing-form label{
        margin: 5px;
        font-weight: bold;
    }
</style>
<div class="wrap">
    <h4 class="vanish">
        <?php
        echo $error;
        $error = '';
        ?>
    </h4>

    <form class="radel-edit-listing-form" method="post" action="">
        <!--<h3 class="addlisting-title">Add new property listing</h3>-->
        <!--<br>-->
        <input type="text" name="upload_listing" hidden value="true">
        <input type="text" name="id" hidden value="<?php echo $id; ?>">
        <input type="text" name="user_id" hidden value="<?php echo $user_id; ?>">

        <label><span class="prop_mandatory">* </span>Title</label><br>
        <input type="text" required name="title" value="<?php echo $title; ?>">

        <input type="radio" required name="listing_type" class="for-rent" value="rent" <?php echo $listing_type == 'rent' ? 'checked' : ''; ?>><label class="radio-inline">For Rent</label>
        <input type="radio" required name="listing_type" class="for-sale" value="sell" <?php echo $listing_type == 'sell' ? 'checked' : ''; ?>><label class="radio-inline">For Sell</label>
        <br>
        <label><span class="prop_mandatory">* </span>Property Type</label><br>
        <select name="property_type">
            <option disabled selected value> -- Select an option -- </option>
            <option value="apt_flat" <?php echo $property_type == 'apt_flat' ? 'selected' : ''; ?>>Apartments/Flats</option>
            <option value="independant_house" <?php echo $property_type == 'independant_house' ? 'selected' : ''; ?>>Independent Floor/House</option>
            <option value="villa_duplex" <?php echo $property_type == '' ? 'villa_duplex' : ''; ?>>Villa/Duplex</option>
            <option value="penthouse" <?php echo $property_type == 'penthouse' ? 'selected' : ''; ?>>Penthouse</option>
        </select>
        <br>
        <label><span class="prop_mandatory">* </span>BHK Type</label><br>
        <select name="bhk_type">
            <option disabled selected value> -- Select an option -- </option>
            <option value="1rk" <?php echo $bhk_type == '1rk' ? 'selected' : ''; ?>>1RK</option>
            <option value="1bhk" <?php echo $bhk_type == '1bhk' ? 'selected' : ''; ?>>1BHK</option>
            <option value="2bhk" <?php echo $bhk_type == '2bhk' ? 'selected' : ''; ?>>2BHK</option>
            <option value="3bhk" <?php echo $bhk_type == '3bhk' ? 'selected' : ''; ?>>3BHK</option>
            <option value="4+bhk" <?php echo $bhk_type == '4+bhk' ? 'selected' : ''; ?>>4+ BHK</option>
        </select><br>
        <label>Property Status</label><br>
        <select name="ready_to_move">
            <option disabled selected value> -- Select an option -- </option>
            <option <?php echo $ready_to_move == '1' ? 'selected' : ''; ?> value="1">Ready to move</option>
            <option <?php echo $ready_to_move == '0' ? 'selected' : ''; ?> value="0">Under Construction</option>
        </select><br>
        <label><span class="prop_mandatory">* </span>Built Up Area</label><br><input type="number" name="built_up_area" value="<?php echo $built_up_area; ?>"><br>
        <label><span class="prop_mandatory">* </span>No. of Bedrooms</label><br><input type="number" name="bedrooms" value="<?php echo $bedrooms; ?>"><br>
        <label><span class="prop_mandatory">* </span>Monthly Rent </label><br><input name="rent" type="number" value="<?php echo $rent; ?>"><br>
        <label><span class="prop_mandatory">* </span>Security Deposit</label><br><input name="deposit" type="number" value="<?php echo $deposit; ?>"><br>

        <input name="negotiable" type="checkbox" value="1" <?php echo $negotiable == '1' ? 'checked' : ''; ?>><label>Negotiable</label><br>

        <input name="maintenance_charges" type="checkbox" value="1" <?php echo $maintenance_charges == '1' ? 'checked' : ''; ?>><label>Including Maintenance Charges </label><br>

        <label><span class="prop_mandatory">* </span>Carpet Area</label><br> <input type="number" name="carpet_area" value="<?php echo $carpet_area; ?>"><br>
        <label><span class="prop_mandatory">* </span>No. of Balcony</label><br><input type="number" name="balconies" value="<?php echo $balconies; ?>"><br>
        <label><span class="prop_mandatory">* </span>Available From : </label><br><input name="available_from" id="prop_available_from" type="date" value="<?php echo $available_from; ?>"><br>
        <h3>Address Details</h3>
        <label><span class="prop_mandatory">* </span>Building Name / No.</label><br><input type="text" name="building_name" value="<?php echo $building_name; ?>"><br>
        <label><span class="prop_mandatory">* </span>Address </label><br><input type="text" name="address" value="<?php echo $address; ?>"><br>
        <label><span class="prop_mandatory">* </span>Pincode</label><br><input type="number" name="pincode" value="<?php echo $pincode; ?>"><br>
        <label><span class="prop_mandatory">* </span>Locality</label><br><input type="text" name="locality" value="<?php echo $locality; ?>"><br>
        <label><span class="prop_mandatory">* </span>City</label><br><input type="text" name="city" value="<?php echo $city; ?>"><br>
        <label><span class="prop_mandatory">* </span>State</label><br><input type="text" name="state" value="<?php echo $state; ?>"><br>
        <h3>Amenities</h3>
        <input type="checkbox" id="amn_parking_no" name="parking" value="1" <?php echo $parking == '1' ? 'checked' : ''; ?>><label>Parking</label><br>
        <input type="checkbox" id="amn_gym_no" name="gym" value="1" <?php echo $gym == '1' ? 'checked' : ''; ?>><label>Gym</label><br>
        <input type="checkbox" id="amn_cctv_guildelines_no" name="cctv" value="1" <?php echo $cctv == '1' ? 'checked' : ''; ?>><label>CCTV</label><br>
        <input type="checkbox" id="amn_club_house_no" name="clubhouse" value="1" <?php echo $clubhouse == '1' ? 'checked' : ''; ?>><label>Club House</label><br>
        <input type="checkbox" id="amn_indoor_games_no" name="indoor_games" value="1" <?php echo $indoor_games == '1' ? 'checked' : ''; ?>><label>Indoor Games</label><br>
        <input type="checkbox" id="amn_kids_area_no" name="kids_area" value="1" <?php echo $kids_area == '1' ? 'checked' : ''; ?>><label>Kids Area</label><br>
        <input type="checkbox" id="amn_lift_no" name="lift" value="1" <?php echo $lift == '1' ? 'checked' : ''; ?>><label>Lift</label><br>
        <input type="checkbox" id="amn_swimming_no" name="swimming_pool" value="1" <?php echo $swimming_pool == '1' ? 'checked' : ''; ?>><label>Swimming</label><br>
        <input type="checkbox" id="amn_water_harvesting_no" name="water_harvesting" value="1" <?php echo $water_harvesting == '1' ? 'checked' : ''; ?>><label>Water Harvesting</label><br>
        <input type="checkbox" id="amn_power_backup_no" name="power_backup" value="1" <?php echo $power_backup == '1' ? 'checked' : ''; ?>><label>Power Backup</label><br>
        <input type="checkbox" id="amn_water_sewage_no" name="water_sewage" value="1" <?php echo $water_sewage == '1' ? 'checked' : ''; ?>><label>Water Sewage</label><br>
        <input type="checkbox" id="amn_party_hall_no" name="party_hall" value="1" <?php echo $party_hall == '1' ? 'checked' : ''; ?>><label>Party Hall</label><br>
        <h3>Additional Information</h3>
        <h4>*Facing</h4>
        <input type="radio" id="prop_north" name="facing" value="north" <?php echo $facing == 'north' ? 'checked' : ''; ?>><label for="prop_north">North</label><br>
        <input type="radio" id="prop_south" name="facing" value="south" <?php echo $facing == 'south' ? 'checked' : ''; ?>><label for="prop_south">South</label><br>
        <input type="radio" id="prop_east" name="facing" value="east" <?php echo $facing == 'east' ? 'checked' : ''; ?>><label for="prop_east">East</label><br>
        <input type="radio" id="prop_west" name="facing" value="west" <?php echo $facing == 'west' ? 'checked' : ''; ?>><label for="prop_west">West</label><br>
        <input type="radio" id="prop_northeast" name="facing" value="north_east" <?php echo $facing == 'north_east' ? 'checked' : ''; ?>><label for="prop_northeast">North-East</label><br>
        <input type="radio" id="prop_northwest" name="facing" value="north_west" <?php echo $facing == 'north_west' ? 'checked' : ''; ?>><label for="prop_northwest">North-West </label><br>
        <input type="radio" id="prop_southeast" name="facing" value="south_east" <?php echo $facing == 'south_east' ? 'checked' : ''; ?>><label for="prop_southeast">South East</label><br>
        <input type="radio" id="prop_southwest" name="facing" value="south_west" <?php echo $facing == 'south_west' ? 'checked' : ''; ?>><label for="prop_southwest">South West</label>
        <h4>*Preferred Tennats</h4>
        <input type="checkbox" value="1" id="family" name="preferred_family" <?php echo $preferred_family == '1' ? 'checked' : ''; ?>><label for="family">Family</label><br>
        <input type="checkbox" value="1" id="bachelor" name="preferred_bachelor" <?php echo $preferred_bachelor == '1' ? 'checked' : ''; ?>><label for="bachelor">Bachelor</label><br>
        <input type="checkbox" value="1" id="commercial" name="preferred_commercial" <?php echo $preferred_commercial == '1' ? 'checked' : ''; ?>><label for="commercial">Commercial</label><br>
        <h4>Property Feature</h4>
        <input type="radio" id="prop_unfurnished" name="furnished" value="none" <?php echo $furnished == 'none' ? 'checked' : ''; ?>><label for="prop_unfurnished">Unfurnished</label><br>
        <input type="radio" id="prop_semifurnished" name="furnished" value="semi" <?php echo $furnished == 'semi' ? 'checked' : ''; ?>><label for="prop_semifurnished">Semi Furnished</label><br> 
        <input type="radio" id="prop_fullyfurnished" name="furnished" value="full" <?php echo $furnished == 'full' ? 'checked' : ''; ?>><label for="prop_fullyfurnished">Fully Furnished</label><br>
        <h4>Extras</h4>
        <input type="checkbox" id="store_room" name="store_room" value="1" <?php echo $store_room == '1' ? 'checked' : ''; ?>><label for="store_room">Has store room.</label><br>
        <input type="checkbox" id="prayer_room" name="prayer_room" value="1" <?php echo $prayer_room == '1' ? 'checked' : ''; ?>><label for="prayer_room">Has prayer room </label><br>
        <label>Floor no.</label><br><input type="number" name="floor_number" value="<?php echo $floor_number; ?>"><br>
        <label>Total Floors</label><br><input type="number" name="total_floors" value="<?php echo $total_floors; ?>"><br>
        <!--<h3><label class="addlisting-subtitles" for="file">Choose Images to Upload</label></h3><br>-->
        <!--<input type="file" id="file" name="featured_image" multiple><br><br>-->

        <label>Featured Image</label><br>
        <img id="featured-image-preview" src="<?php echo $featured_image == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $featured_image; ?>" style="max-width: 350px;max-height: 250px;"><br>
        <button type="button" onclick="select_image('featured-image');">Select Featured Image</button><br>
        <input type="text" id="featured-image" name="featured_image" value="<?php echo $featured_image; ?>" hidden><br>

        <label>Additional Images</label><br>

        <!--    Image 1    -->
        <img id="image-1-preview" src="<?php echo $image_1 == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $image_1; ?>" style="max-width: 150px;max-height: 150px;"><br>
        <button type="button" onclick="select_image('image-1');">Select Image</button><br>
        <input type="text" id="image-1" name="image_1" value="<?php echo $image_1; ?>" hidden><br>

        <!--    Image 2    -->
        <img id="image-2-preview" src="<?php echo $image_2 == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $image_2; ?>" style="max-width: 150px;max-height: 150px;"><br>
        <button type="button" onclick="select_image('image-2');">Select Image</button><br>
        <input type="text" id="image-2" name="image_2" value="<?php echo $image_2; ?>" hidden><br>

        <!--    Image 3    -->
        <img id="image-3-preview" src="<?php echo $image_3 == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $image_3; ?>" style="max-width: 150px;max-height: 150px;"><br>
        <button type="button" onclick="select_image('image-3');">Select Image</button><br>
        <input type="text" id="image-3" name="image_3" value="<?php echo $image_3; ?>" hidden><br>

        <!--    Image 4    -->
        <img id="image-4-preview" src="<?php echo $image_4 == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $image_4; ?>" style="max-width: 150px;max-height: 150px;"><br>
        <button type="button" onclick="select_image('image-4');">Select Image</button><br>
        <input type="text" id="image-4" name="image_4" value="<?php echo $image_4; ?>" hidden><br>

        <!--    Image 5    -->
        <img id="image-5-preview" src="<?php echo $image_5 == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $image_5; ?>" style="max-width: 150px;max-height: 150px;"><br>
        <button type="button" onclick="select_image('image-5');">Select Image</button><br>
        <input type="text" id="image-5" name="image_5" value="<?php echo $image_5; ?>" hidden><br>

        <input type="submit" value="Submit">
    </form>

</div>
<script>
    function select_image(image_index) {
        media_r_uploader = wp.media({
            frame: "select",
//            frame: "post",
//            state: "insert",
            multiple: false
        });
        media_r_uploader.open();

//        open_media_uploader_image();
        jQuery(document).ready(function ($) {
            media_r_uploader.on("select", function () {
                var json = media_r_uploader.state().get("selection").first().toJSON();
                console.log(json);
                var image_url = json.url;
                var image_caption = json.caption;
                var image_title = json.title;
                console.log(image_url);
                media = {
                    url: image_url,
                    caption: image_caption,
                    title: image_title
                };
                $('#' + image_index).val(media.url);
                $('#' + image_index + '-preview').attr('src', media.url);
            });

        });
    }
</script>