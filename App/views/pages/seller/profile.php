<?php use App\User\User; ?>
<div class="personnal_information">
    <div class="ligne">
        <div class="colonne-3 colonne-sm-12">
            <div class="profile-names">
                <?php $identity = User::getInstance(App::getInstance()->get_Db())->getfullidentity()?>
                <input class="modify_deactived" type="text" name="_user_name" id="_user_name" value=<?=$identity->name;?> >
                <input class="modify_deactived" type="text" name="_user_lastname" id="_user_lastname" value=<?=$identity->surname;?>>
                <input class="modify_deactived" type="email" name="_user_email" id="_user_email" value=<?=$identity->mail;?>>
            </div>
        </div>
        <div class="colonne-5 colonne-sm-12">
            <div class="profile-names">
                <?php $identity = User::getInstance(App::getInstance()->get_Db())->getfullidentity()?>
                <select class="modify_deactived" id="_user_district" name="_user_district">
                    <option disabled value="Select district">Select district</option>
                    <option value="Lefkosa" <?php  echo ($identity->district == "Lefkosa" ?  "selected" :  "")?> >Lefkosa</option>
                    <option value="Girne" <?php  echo ($identity->district == "Girne" ?  "selected" :  "")?> >Girne</option>
                    <option value="Guzelyurt" <?php  echo ($identity->district == "Guzelyurt" ?  "selected" :  "")?> >Guzelyurt</option>
                    <option value="Iskele" <?php  echo ($identity->district == "Iskele" ?  "selected" :  "")?> >Iskele</option>
                    <option value="Gazimagusa" <?php  echo ($identity->district == "Gazimagusa" ?  "selected" :  "")?> >Gazimagusa</option>
                    <option value="Lefke" <?php  echo ($identity->district == "Lefke" ?  "selected" :  "")?> >Lefke</option>
                </select>
                <textarea class="modify_deactived" name="_user_address" id="_user_address"><?=$identity->address;?></textarea>
            </div>
        </div>
        <div class="colonne-4 colonne-sm-12">
            <div class="profile-names">
                <button type="button" class="btn-modify" id="btn-modify" ><i class="fa fa-pencil"></i> Modify</button>
                <button type="button" class="btn-change" id="btn-change"><i class="fa fa-check"></i> update</button>
            </div>
        </div>
    </div>
</div>