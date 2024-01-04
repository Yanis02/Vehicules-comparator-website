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
<script>
    $(document).ready(function () {
        
     var compData=sessionStorage.getItem('compResults');
     var compResults=JSON.parse(compData);
     if(compResults!=null){
      var text=$("<h1>").text("Votre derniere comparaison :");  
     $('#textContainer').append(text); 
    displayTable(compResults);
    compResults.forEach(element => {
                displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
            });}
            
    var storedData = sessionStorage.getItem('data');
    var result = JSON.parse(storedData);
    
    })

     function displayCard(imageSrc, cardTitle, buttonText,id) {
   

    var card = $('<div>').addClass('card').css('width', '18rem');

    var cardImage = $('<img>').addClass('card-img-top').attr('src', imageSrc).attr('alt', 'Card Image');

    var cardBody = $('<div>').addClass('card-body');

    var cardTitleElement = $('<h5>').addClass('card-title').text(cardTitle);

    var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=detailVehicule&idVehicule=${id}`).text(buttonText).css('background-color', '#F41F11');

    cardBody.append(cardTitleElement, button);

    card.append(cardImage, cardBody);

    // Append the new card to #cardContainer
    $('#cardContainer').append(card);
   }
 function displayTable(data){
         var $table = $("table"); 
         $table.find("tbody").empty(); 
         var $thead = $table.find("thead");
         $thead.empty();
         var headerRow = '<tr><th scope="col">Features</th>';
         data.forEach(element => {
            headerRow += '<th>' + element.vehicule_name + '</th>';  
         });
         headerRow += '</tr>';
         $thead.append(headerRow);
         var $tbody = $table.find("tbody");
         data[0].characteristics.forEach(feature => {
            var featureRow = '<tr><th class="firstcol" scope="row">' + feature.nom + '</th>';
            data.forEach(element => {
                let values=[];
               values.push(element.characteristics_values[feature.id]);
               for (let index = 0; index < values.length; index++) {
                    featureRow += '<td>' + values[index] + '</td>';
                }        
            

            });
            featureRow += '</tr>';
            $tbody.append(featureRow);
         });
        
        }
*/