$(document).ready(function () {

    $(document).on('click', ".remove_item", function (e) {
        e.preventDefault();
        var entityId = $(this).attr('data-entity-id');
        var itemId = 'item-' + entityId;
        var route = $(this).attr('href');

        //$('#'+itemId).css("opacity", "0.5");

        bootbox.dialog({
            title: '<i class="fa fa-exclamation-triangle" style="color: brown"></i> Confirmation',
            message: 'Etez-vous sûre de supprimer ceci ?',
            className: 'my-class',
            buttons: {
                cancel: {
                    className: 'btn btn-default',
                    label: 'Fermer'
                },
                success: {
                    className: 'fa fa-trash-o btn btn-danger',
                    label: ' Supprimer',
                    callback: function () {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: route,
                            success: function (responseTxt, statusTxt, xhr) {
                                if (xhr.status == 200) {
                                    $('#' + itemId).hide();
                                    $('#madiv').load(location.href + " #madiv");
                                }
                                else {
                                    alert('erreur');
                                }
                            }
                        });
                    }
                }
            }
        });
    });


    $(document).on('click', ".refuser", function (e) {
        var entityId = $(this).attr('data-entity-id');
        var action = '#action-' + entityId; // id block d'action
        var refuser = '.refuser-' + entityId; // span qui sera afficher apres l'action
        var route = $(this).attr('href');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: route,
            success: function () {
                $(action).replaceWith($(refuser));
                $(refuser).removeClass('hidden');
                $('#madiv').load(location.href + " #madiv");
            }

        });
        return false;
    });


    $(document).on('click', ".valider", function (e) {
        var entityId = $(this).attr('data-entity-id');
        var action = '#action-' + entityId; // id block d'action
        var valider = '.valider-' + entityId; // span qui sera afficher apres l'action
        var route = $(this).attr('href');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: route,
            success: function () {
                $(action).replaceWith($(valider));
                $(valider).removeClass('hidden');
                $('#madiv').load(location.href + " #madiv");
            }

        });
        return false;
    });


    $(document).on('click', ".enable_item", function (e) {
        var entityId = $(this).attr('data-entity-id');
        var enabledItem = '#enabled-item-' + entityId;
        var disabledItem = '#disabled-item-' + entityId;
        var route = $(this).attr('href');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: route,
            success: function () {
                $(disabledItem).hide();
                $(enabledItem).fadeIn();
            }

        });
        return false;
    });

    $(document).on('click', ".disable_item", function (e) {
        var entityId = $(this).attr('data-entity-id');
        var enabledItem = '#enabled-item-' + entityId;
        var disabledItem = '#disabled-item-' + entityId;
        var route = $(this).attr('href');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: route,
            success: function () {
                $(enabledItem).hide();
                $(disabledItem).fadeIn();
            }

        });
        return false;
    });

    // formulaire ajout
    $(document).on('submit', "#form-add", function (e) {
        e.preventDefault();
        var action = $(this).attr('action');
        showLoading();
        $("#submit_button").prop("disabled", true);
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            url: action,
            success: function (data) {
                if (data.result == 0) {
                    $('.block-erreurs').replaceWith($(data["view"]));
                    $("#submit_button").prop("disabled", false);
                } else {
                    $("#submit_button").prop("disabled", false);
                    $('#madiv').load(location.href + " #madiv");
                    $("form").trigger("reset");
                }
                hideLoading();
            }

        });

        return false;

    });

    //afficher formulaire de modification
    $(document).on('click', ".edit_entity", function (e) {
        var entityId = $(this).attr('data-entity-id');
        var route = $(this).attr('href');
        $('html, body').scrollTop(0);

        $.ajax({
            type: 'get',
            dataType: 'json',
            url: route,
            success: function (msg) {
                $('#block-edit').replaceWith($(msg["view"]));
            }
        });
        return false;
    });

    // executer la modification
    $(document).on('submit', "#form-edit", function (e) {
        e.preventDefault();
        var action = $(this).attr('action');

        showLoadingEdit();

        $("#edit_submit_button").prop("disabled", true);
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            url: action,
            success: function (data) {
                if (data.result == 0) {
                    $('.block-erreurs').replaceWith($(data["view"]));
                    $("#edit_submit_button").prop("disabled", false);
                } else {
                    $("#edit_submit_button").prop("disabled", false);
                    $('#madiv').load(location.href + " #madiv");
                    $('#block-edit').hide();

                }
                hideLoadingEdit();
            }
        });

        return false;

    });

    function showLoading() {
        $(".loading").show();
    }

    function hideLoading() {
        $(".loading").hide();
    }

    function showLoadingEdit() {
        $(".loading-edit").show();
    }

    function hideLoadingEdit() {
        $(".loading-edit").hide();
    }

    $(document).on('click', ".close-div", function (e) {
        e.preventDefault();
        $('#block-edit').fadeOut();
    });


    $(document).on('change', "#recherche-form", function (e) {
        e.preventDefault();
        var parameters = $(this).serialize();
        var action = $(this).attr('action');

        $(".loading").css("display", "block");
        $('#madiv').css("opacity", "0.5");

        $.ajax({
            type: 'get',
            dataType: 'json',
            data: $(this).serialize(),
            url: action,
            success: function (msg) {
                if (msg["ok"] === undefined) {
                    alert('erreur');
                } else {
                    window.history.pushState(null, "Title", action + '?' + parameters);
                    $(".loading").hide();
                    $('#madiv').replaceWith($(msg["ok"]).find('#madiv'));
                    TableData.init();
                }
            }
        });

    });


    //******************** conge ****************************
    // ******************************************************/

    // verifier le conge
    $(document).on('change', "#typeConge", function (e) {
        e.preventDefault();
        $(".loading").css("display", "block");

        $.ajax({
            type: 'get',
            dataType: 'json',
            data: $('#form').serialize(),
            url: Routing.generate('verifier_conge'),
            success: function (msg) {
                if (msg["ok"] === undefined) {
                    alert('erreur');
                } else {
                    $(".loading").hide();
                    // on affiche le message des informations
                    $('#verification').html($(msg["ok"]));

                    var total = (msg["total"]);
                    var rest = (msg["rest"]);

                    if (rest > 0) {
                        $('#continuer').show();
                        $('#nbJours').attr('max',rest);
                    }
                    else {
                        $('#continuer').hide();
                    }

                }

            }
        });

        return false;

    });

    $(".dateDebut").prop("disabled", true);
    $(document).on('change', "#nbJours", function (e) {
        $(".dateDebut").prop("disabled", false);
    });

    $(document).on('change', "#dateDebut, #nbJours", function (e) {
        e.preventDefault();

        var nbdays_string = $("#nbJours").val();
        var startDate_string = $("#dateDebut").val();

        if (nbdays_string == null || nbdays_string == "") {
            return false;
        }
        if (startDate_string == null || startDate_string == "") {
            return false;
        }

        var nbdays = parseFloat(nbdays_string);
        var startDate = moment(startDate_string);

        var endDate = startDate.add(nbdays, 'days').format('DD-MM-YYYY');

        $("#dateFin").val(endDate);

    });

    $(document).on('click', ".demande", function (e) {
        var startDt = $("#dateDebut").val();
        var endDt = $("#dateFin").val();


        if ((new Date(startDt).getTime() >= new Date(endDt).getTime())) {
            alert('Date debut doit etre superieur à date fin');
            return false;
        }
        if (Date.parse(new Date()) > Date.parse(startDt)) {
            alert('Date debut doit etre superieur à date actulle');
            return false;
        }
        if (Date.parse(new Date()) > Date.parse(endDt)) {
            alert('Date debut doit etre superieur à date actulle');
            return false;
        }
    });

//php app/console assets:install

});