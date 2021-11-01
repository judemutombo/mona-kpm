
<div class="tables">
    <div class="connect_sign">
        <ul class="nav  onglets" id="myTab">
            <li class="nav-item">
                <a class="nav-link active" href="#log_in">Log in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#sign_in">Register</a>
            </li>
        </ul>
        <div class="tab-content">
            <div  class="tab-pane fade show active" id="log_in" >
                <form class="formulaire">
                    <input type="text" placeholder=" E-mail or member ID " class="champs" id="log_champs">
                    <p class="log_mail_error_message" style="color: red; display:none">Invalid address mail</p>
                    <input type="password" placeholder=" Password" class="champs" id="log_pass">
                    <p class="log_pass_error_message" style="color: red; display:none">Invalid password</p>
                    <p class="log_sys_error_message" style="color: red; display:none"></p>
                    <button class="log_button" id="log_button" type="button">Log in</button>
                </form>
            </div>
            <div  class="tab-pane fade" id="sign_in">
                <form class="formulaire">
                    <input type="text" placeholder=" E-mail  " class="champs" id="register_mail">
                    <p class="reg_mail_error_message" style="color: red; display:none">Invalid address mail</p>
                    <input type="password" placeholder=" Password" class="champs" id="register_pass">
                    <p class="reg_pass_error_message" style="color: red; display:none">Password can't contain any special character, and should have more than 4 characters</p>
                    <button class="log_button" id="Register_button" type="button">Register</button>
                </form>
            </div>
        </div>
    </div>
    
</div>