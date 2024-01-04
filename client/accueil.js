$(document).ready(function () {
    function updateModeles(element, containerIndex) {
        var container = $("#container_" + containerIndex);
        var marqueId = $(element).val();
        console.log(marqueId);
        
        var modeleDropdown = container.find('.modeleDropdown');
        
        $.ajax({
            type: "POST",
            url: "./model/modele.php",
            data: { marqueId: marqueId },
            dataType: "json",
            success: function (data) {
                console.log("success");
                modeleDropdown.empty();
                modeleDropdown.append('<option value="">Modele</option>');
                $.each(data, function (index, modele) {
                    modeleDropdown.append($("<option>").attr("value", modele.id).text(modele.nom));
                });
                modeleDropdown.prop("disabled", false);
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
            }
        });
    }

    function updateVersions(element, containerIndex) {
        var container = $("#container_" + containerIndex);
        var modeleId = $(element).val();
        console.log(modeleId);

        var versionDropdown = container.find('.versionDropdown');
        
        $.ajax({
            type: "POST",
            url: "./model/version.php",
            data: { modeleId: modeleId },
            dataType: "json",
            success: function (data) {
                versionDropdown.empty();
                versionDropdown.append('<option value="">Version</option>');
                $.each(data, function (index, version) {
                    versionDropdown.append($("<option>").attr("value", version.id).text(version.nom));
                });
                versionDropdown.prop("disabled", false);
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
            }
        });
    }
    function updateAnnee(element, containerIndex) {
        var container = $("#container_" + containerIndex);
        var modeleId = $(element).val();
        console.log(modeleId);

        var versionDropdown = container.find('.anneeDropdown');
        
        $.ajax({
            type: "POST",
            url: "./model/vehicule.php",
            data: { versionId: modeleId },
            dataType: "json",
            success: function (data) {
                versionDropdown.empty();
                versionDropdown.append('<option value="">Annee</option>');
                $.each(data, function (index, version) {
                    versionDropdown.append($("<option>").attr("value", version.id).text(version.annee));
                });
                versionDropdown.prop("disabled", false);
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
            }
        });
    }
    function isSelected(num){
        const marque=$(`#marque_${num}`);
        if(marque.val()) return true;
        else return false;
    }
    function isReady(num){
     const marque=$(`#marque_${num}`);
     const modele=$(`#modele_${num}`);
     const version=$(`#version_${num}`);
     const annee=$(`#annee_${num}`);
     if(marque.val() && modele.val() && version.val() && annee.val()  ) return true;
     else return false;
    }
    function submitForm() {
let cpt = 0;
let data=[];
for (let index = 0; index < 4; index++) {
    if (isReady(index)) {
        data.push($(`#version_${index}`).val());
        cpt++;
    } else if (isSelected(index)) {
        alert("Please fill in all fields.");
        return;
    }
}

if (cpt >= 2) {
    //$('#comparisonForm').submit();
    console.log("passed");
   console.log(data);
} else {
    alert("Please enter at least 2 vehicles.");
}
}

    
});

/*
*/