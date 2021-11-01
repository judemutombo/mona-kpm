<?php
if(!isset($_SESSION['temp_check']))
{
    Header("Location: ../home");
}
?>
<div class="tables">
    <div class="connect_sign">
        <p class="register_legend">Additional informations</p>
        <form class="register_form2">
            <input type="text" placeholder="country" value="KKTC" name="country" disabled class="champs" >
            <input type="text" placeholder="Please enter your first name" name="register_first_name" class="champs" id="name_register">
            <p class="name_register_error" style="display: none;color:red">Your first name can't contain any character</p>
            <input type="text" placeholder="Please enter your last name" name="register_last_name" class="champs" id="lName_register">
            <p class="lname_register_error" style="display: none;color:red">Your last name can't contain any character</p>
            <span class="indic">+90</span><input type="tel" placeholder="phone number" name="register_phone" class="champs_phone" id="phone_register">
            <p class="phone_register_error" style="display: none;color:red">your phone number shouldn't contain any alphabetic or special character, and should have 10 digits</p>
            <textarea class="register_address" placeholder="Please enter your address" id="address_register"></textarea>
            <select class="champs" required id="district_register">
                <option value="" disabled selected hidden>Select your district...</option>
                <option>Lefkosa</option>
                <option>Kyrenia</option>
                <option>Lefke</option>
                <option>Guzelyurt</option>
                <option>Iskele</option>
                <option>Gazimagusa</option>
            </select>
            <button class="log_button" type="button" id="agree_register_button">Agree and Register</button>
        </form>
    </div>
</div>