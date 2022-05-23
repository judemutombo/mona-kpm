
// Affiche un popup d'information et l'usager doit cliquer sur OK pour le refermer
// source : http://christianelagace.com
// Paramètre : le texte du message qui sera affiché dans le popup
// Retourne une référence à la boîte de dialogue
function afficherPopupInformation(message) {
    // crée la division qui sera convertie en popup
    $('body').append('<div id="popupinformation" title="Information"></div>');
    $("#popupinformation").html(message);
    // transforme la division en popup
    var popup = $("#popupinformation").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        close: function (event, ui){
            $(".glass").hide();
        },
        buttons: [
            {
                text: "OK",
                "class": 'ui-state-information',
                click: function () {
                    $(this).dialog("close");
                    $('#popupinformation').remove();
                }
            }
        ]
    });
    // ajouter le style à la barre de titre
    // note : on n'utilise pas .dialogClass dans la définition de la boîte de dialogue car mettrait tout le fond en couleur
    $("#popupinformation").prev().addClass('ui-state-information');


    return popup;

}
// Affiche un popup d'avertissement et l'usager doit cliquer sur OK pour le refermer
// source : http://christianelagace.com
// Paramètre : le texte du message qui sera affiché dans le popup
// Retourne une référence à la boîte de dialogue
function afficherPopupAvertissement(message) {
    // crée la division qui sera convertie en popup
    $('body').append('<div id="popupavertissement" title="Avertissement"></div>');
    $("#popupavertissement").html(message);
    // transforme la division en popup
    var popup = $("#popupavertissement").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        close: function (event, ui){
            $(".glass").hide();
        },
        buttons: [
            {
                text: "OK",
                "class": 'ui-state-warning',
                click: function () {
                    $(this).dialog("close");
                    $(".glass").hide();
                    $('#popupavertissement').remove();
                }
            }
        ]
    });
    $("#popupavertissement").prev().addClass('ui-state-warning');
    return popup;
}
// Affiche un popup d'erreur et l'usager doit cliquer sur OK pour le refermer
// source : http://christianelagace.com
// Paramètre : le texte du message qui sera affiché dans le popup
// Retourne une référence à la boîte de dialogue
function afficherPopupErreur(message) {
    // crée la division qui sera convertie en popup
    $('body').append('<div id="popuperreur" title="Error"></div>');
    $("#popuperreur").html(message);
    // transforme la division en popup
    var popup = $("#popuperreur").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        buttons: [
            {
                text: "OK",
                "class": 'ui-state-error',
                click: function () {
                    $(this).dialog("close");
                    $('#popuperreur').remove();
                }
            }
        ]
    });
    $("#popuperreur").prev().addClass('ui-state-error');
    return popup;
}
// Affiche un popup d'information qui se refermera automatiquement après 3 secondes
// source : http://christianelagace.com
// Paramètre : le texte du message qui sera affiché dans le popup
// Retourne une référence à la boîte de dialogue
function afficherPopupInformationTroisSecondes(message) {
    // crée la division qui sera convertie en popup
    $('body').append('<div id="popuptroissecondes" title="Information"></div>');
    $("#popuptroissecondes").html(message);
    // transforme la division en popup
    var popup = $("#popuptroissecondes").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        hide: "fade",
        open: function (event, ui) {
            setTimeout(function () {
                $("#popuptroissecondes").dialog('close');
                $("#popuptroissecondes").remove();
            }, 3000);
        }
    });
    $("#popuptroissecondes").prev().addClass('ui-state-information');
    return popup;
}
// Crée un popup qui se s'affichera et se refermera automatiquement sur le hover d'un élément HTML.
// source : http://christianelagace.com
// Paramètres : sélecteur pour retrouver l'élément qui servira à faire afficher le popup
//              titre du popup
//              message du popup
// Retourne une référence à la boîte de dialogue
// Utilisation : definirPopupHover('.iconeaide', 'Aide', 'Texte à afficher');
function definirPopupHover(selecteur, titre, message) {
    // crée la division qui sera convertie en popup si n'existait pas déjà
    if ($("#popuphover").length == 0) {
        $('body').append('<div id="popuphover" title="Information"></div>');
    }
    $("#popuphover").html(message);
    // transforme la division en popup
    var popup = $("#popuphover").dialog({
        autoOpen: false,
        width: 320,
        dialogClass: 'dialogstyleperso',
        hide: "fade",
    });
    $("#popuphover").prev().addClass('ui-state-neutral');
    $(selecteur).hover(function (event) {
        // positionner le coin supérieur gauche du popup sur le coin inférieur droit de l'élément sur lequel on a passé la souris
        $("#popuphover").dialog('option',  'position', { my: "left top", at: "right bottom", of: event.target });
        $("#popuphover").dialog('open');
    }, function () {
        $("#popuphover").dialog('close');
    })
    return popup;
}
// Affiche un popup pour indiquer que le travail progesse.
// Devra être effacé en appelant effacerPopup().
// source : http://christianelagace.com
// Paramètres : le texte apparaissant dans la barre de titre. Par défaut : "Travail en cours"
//              le texte du message qui sera affiché dans le popup. Par défaut : "Un instant S.V.P."
// Retourne une référence à la boîte de dialogue
// Utilisation : var popupAttente = afficherPopupAttente();
function afficherPopupAttente(titre='Travail en cours', message='Un instant S.V.P.') {
    // crée la division qui sera convertie en popup
    $('body').append('<div id="popupattente" title="' + titre + '"></div>');
    $("#popupattente").html(message);
    // transforme la division en popup
    var popup = $("#popupattente").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        hide: "fade"
    });
    $("#popupattente").prev().addClass('ui-state-information');
    return popup;
}
// Efface un popup.
// source : http://christianelagace.com
// Paramètre : référence au popup créé à l'aide de .dialog()
function effacerPopup(popup) {
    $(popup).dialog("close");
    $(".glass").hide();
    $('#popupattente').remove();
}
// À partir d'un lien <a href>, affiche un popup de confirmation et l'usager doit cliquer sur oui ou sur non.
// Le oui redirige vers la page spécifiée dans l'attribut href du lien
// alors que le non referme la boîte de dialogue sans rien modifier.
// source : http://christianelagace.com
// Paramètres : question : le texte de la question qui sera affichée dans le popup
//              lien (optionnel) : référence au lien qui cause l'affichage du popup
//                                 On y lira l'attribut href pour savoir quelle page afficher sur un oui.
//                                 Si non spécifié ou si le lien n'a pas d'attribut href, réaffichera la page actuelle.
// Retourne une référence à la boîte de dialogue
// Utilisation : afficherPopupConfirmationLien('Désirez-vous vraiment supprimer cet item ?', this);
function afficherPopupConfirmationLien(question, lien,code,date,extra) {
    // crée la division qui sera convertie en popup
    $('body').append('<div id="popupconfirmation" title="Confirmation"></div>');
    $("#popupconfirmation").html(question);
    // transforme la division en popup
    var popup = $("#popupconfirmation").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        hide: "fade",
        close: function (event, ui){
            $(".glass").hide();
        },
        buttons: [
            {
                text: "Yes",
                class: "ui-state-question",
                click: function () {
                    let table = new Array();
                    $.ajax({
                        url:"App/Pont/verif.php",
                        type:"GET",
                        dataType:"JSON",
                        data:{"url":window.location.href,"code":code,"date":date,"extra":extra},
                        success:function (data) {
                            table = data;
                            if(table[0]){
                                $.ajax({
                                    url:"App/Pont/book.php",
                                    type: "POST",
                                    data:{"code":code,"date":date,"extra":extra},
                                    dataType: "JSON",
                                    success:function (data) {
                                        table = data;
                                        if(table[0])
                                        {
                                            $(".glass").show();
                                            afficherPopupInformation("Your appointment has been recorded,you will receive a message on whatsapp for more information and follow-up.\n Thank you for choosing Beauty locs.");
                                            $.ajax({
                                                url:"App/Pont/event.php",
                                                type:"GET",
                                                dataType:"JSON",
                                                success:function (data) {
                                                    sampleEvents = data;
                                                    $calendar.setEvents(sampleEvents);
                                                    console.log(data);
                                                    console.log(sampleEvents);
                                                }
                                            })
                                        }else{
                                            $(".glass").show();
                                            afficherPopupErreur(table[1]);
                                        }
                                    }
                                })
                            }else{
                                window.open("login","_self");
                            }
                        }
                    })
                    $(this).dialog("close");
                    $("#popupconfirmation").remove();
                    $(".glass").hide();
                }
            },
            {
                text: "No",
                class: "ui-state-question",
                click: function () {
                    $(this).dialog("close");
                    $("#popupconfirmation").remove();
                    $(".glass").hide();
                }
            }
        ]
    });
    $("#popupconfirmation").prev().addClass('ui-state-question');
    return popup;
}

function CancelOrder(question) {
    // crée la division qui sera convertie en popup
    $('body').append('<div id="popupconfirmation" title="Confirmation"></div>');
    $("#popupconfirmation").html(question);
    // transforme la division en popup
    var popup = $("#popupconfirmation").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        hide: "fade",
        close: function (event, ui){
            $(".glass").hide();
        },
        buttons: [
            {
                text: "Yes",
                class: "ui-state-question",
                click: function () {
                    $(this).dialog("close");
                    $("#popupconfirmation").remove();
                    $(".glass").hide();
                }
            },
            {
                text: "No",
                class: "ui-state-question",
                click: function () {
                    $(this).dialog("close");
                    $("#popupconfirmation").remove();
                    $(".glass").hide();
                }
            }
        ]
    });
    $("#popupconfirmation").prev().addClass('ui-state-question');
    return popup;
}

function deleteProduct(question,position,code,callback){
    $('body').append('<div id="popupconfirmation" title="Confirmation"></div>');
    $("#popupconfirmation").html(question);
    // transforme la division en popup
    table = new Array();
    var popup = $("#popupconfirmation").dialog({
        autoOpen: true,
        width: 320,
        dialogClass: 'dialogstyleperso',
        hide: "fade",
        close: function (event, ui){
            $(".glass").hide();
        },
        buttons: [
            {
                text: "Yes",
                class: "ui-state-question",
                click: function () {
                    $.ajax({
                        url:"App/pont/pont_suppProduit.php",
                        type:"POST",
                        data:{"code":code},
                        success:function(data){
                            table = data;
                            if(table[0])
                            {
                                afficherPopupInformation("Deleted successfully")
                            }
                            else{
                                afficherPopupErreur(table[1]);
                            }
                            callback()
            
                        },
                        dataType:"json"
                    })
                    $(this).dialog("close");
                    $("#popupconfirmation").remove();
                    $(".glass").hide();
                }
            },
            {
                text: "No",
                class: "ui-state-question",
                click: function () {
                    $(this).dialog("close");
                    $("#popupconfirmation").remove();
                    $(".glass").hide();
                }
            }
        ]
    });
    $("#popupconfirmation").prev().addClass('ui-state-question');
    return popup;
}
