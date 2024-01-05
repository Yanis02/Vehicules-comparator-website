<?php
require_once("commun.php");

class Comparateur{
    ##for marques page
public function comparaison($marques)
    {
      ?>
      <div id="container" style="display:flex;flex-direction:column;align-items-center;width:100%;">
      <h1 style="margin-top:50px;text-align:center">Comparez vos vehicules</h1>
      <form id="comparisonForm" style="margin-top:50px;margin-left:5%;width: 90%;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:50px;">
          <div style="width:100%; display: flex; flex-direction: row; height:fit-content; justify-content: space-around; align-items: center;" class="comparaison_container">
              <?php for ($i = 0; $i < 4; $i++) : ?>
                  <div id="container_<?php echo $i; ?>" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center">
                      <!-- Marque Dropdown 54-->
                      <select name="marque_<?php echo $i; ?>" id="marque_<?php echo $i; ?>" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateModeles(this, <?php echo $i; ?>)">
                          <option value="">Marque</option>
                          <?php foreach ($marques as $marque) : ?>
                              <option value='<?php echo $marque['id']; ?>'><?php echo $marque['nom']; ?></option>
                          <?php endforeach; ?>
                      </select>
  
                      <!-- Modele Dropdown -->
                      <select name="modele_<?php echo $i; ?>" id="modele_<?php echo $i; ?>" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateVersions(this, <?php echo $i; ?>)" disabled>
                          <option value="">Modele</option>
                      </select>
  
                      <!-- Version Dropdown -->
                      <select name="version_<?php echo $i; ?>" id="version_<?php echo $i; ?>" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateAnnee(this, <?php echo $i; ?>)" disabled>
                          <option value="">Version</option>
                      </select>
                      <!-- Annee Dropdown -->
                      <select name="annee_<?php echo $i; ?>" id="annee_<?php echo $i; ?>" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                          <option value="">Annee</option>
                      </select>
                  </div>
              <?php endfor; ?>
          </div>
          <button type="button" onclick="submitForm()" style="width:250px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Comparer</button>
         </form>
         <div class="d-flex justify-content-around mt-5 " id="textContainer"></div>
        <div class="d-flex justify-content-around mt-5 " id="cardContainer"></div>
       <div class="d-flex justify-content-center mt-5" id="table_container" >
       <table class="table table-bordered table-sm w-50">
       <thead>
                  <tr id="lineOne" >                   
                  </tr>
              </thead>
              <tbody id="tbody">
             </tbody>
      </table>
     </div>
      </div>
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
  
      $('#cardContainer').append(card);
     }
  
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
      function submitForm() {
           let cpt = 0;
      
       let data=[];
        for (let index = 0; index < 4; index++) {
          
          if (isReady(index)) {
              let res={marque:"",modele:"",version:"",id:""};
              res.marque=$(`#marque_${index}`).val();
              res.modele=$(`#modele_${index}`).val();
              res.version=$(`#version_${index}`).val();
              res.id=$(`#annee_${index}`).val();
              data.push(res);
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
         for (let i = 0; i < data.length; i++) {
            for (let j = i+1; j < data.length; j++) {
               if(i!=j){
                  $.ajax({
                          type: "POST",
                          url: "./model/comparaison.php", 
                          data: {
                              idVehicule1: data[i].id,
                              idVehicule2: data[j].id
                          },
                          success: function (response) {
                              console.log(response);
                              
                          },
                          error: function (xhr, status, error) {
                              console.error("AJAX Error:", status, error);
                             
                          }
                      });
               }
              
            }        
         }
         result=[];
         var promises = data.map(element => {
       return new Promise((resolve, reject) => {
          $.ajax({
              type: "POST",
              url: "./model/vehiculeCaracteristique.php",
              data: {
                  idMarque: element.marque,
                  idModele: element.modele,
                  idVersion: element.version,
                  idVehicule: element.id
              },
              dataType: "json",
              success: function (response) {
                  console.log(response);
                  result.push(response);
                  resolve(); 
              },
              error: function (xhr, status, error) {
                  console.log("failed");
                  console.error("AJAX Error:", status, error);
                  reject(); 
              }
          });
       });
       });
  
        Promise.all(promises)
          .then(() => {
          console.log("result", result);
          if (result.length > 1) {
              $('#cardContainer').empty();
              console.log(result);
              sessionStorage.setItem("compResults",JSON.stringify(result));
              result.forEach(element => {
                  displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
              });
              displayTable(result);
          }
       })
       .catch(() => {
          console.log("One or more AJAX requests failed");
       });
       } else {
          alert("Please enter at least 2 vehicles.");
       }
          }     
      </script>
      <?php
   }
public function popularComps($comp){
    $commun=new Commun();
    ?>
    <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;gap:10px;margin-top:50px;">
    <h1>Les comparaisons les plus populaires</h1>
    <div id="carouselExample2" class="carousel slide">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($comp); $i++) :?>
                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                        <div style="display:flex; justify-content:space-around; align-items:center;">
                           
             <div style="display:flex;justify-content:space-evenly;align-items:center;border:solid 2px #F41F11;border-radius:10px;width:800px;height:350px;">
             <?php
                  
                  $commun->card("./img/vehicules/". $comp[$i][0][0]["image_paths"][0]["chemin"],$comp[$i][0][0]["vehicule_name"]);
              ?>
              <div style="display:flex;flex-direction:column;justify-content:space-between;align-items:center">
              <h3>VS</h3>
              <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=popularComp&idVehicule_1=<?php echo $comp[$i][0][0]["vehicule_id"];?>&idVehicule_2=<?php echo $comp[$i][1][0]["vehicule_id"];?>">Voir comparaison</a>
              </div>
              <?php
              
              
              $commun->card("./img/vehicules/".$comp[$i][1][0]["image_paths"][0]["chemin"],$comp[$i][1][0]["vehicule_name"]);

             ?>
            </div>
            
                            
                           
                        </div>
                    </div>
                <?php endfor; ?>
                </div>
               <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23F41F11\' viewBox=\'0 0 8 8\'%3E%3Cpath d=\'M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z\'/%3E%3C/svg%3E') !important;"
 >                </span>
                 <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample2" data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23F41F11\' viewBox=\'0 0 8 8\'%3E%3Cpath d=\'M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z\'/%3E%3C/svg%3E') !important;"

 >                </span>
                <span class="visually-hidden">Next</span>
             </button>
          </div>
         
         
         
         
   </div>
    <?php
}
public function comparaisonV($marques,$idVehicule,$idMarque,$idModele,$idVersion)
 {
   ?>
   <div style="display:flex;flex-direction:column;align-items-center;width:100%;">
   <h1 style="margin-top:50px;text-align:center">Comparez ce vehicule</h1>
   <form id="comparisonForm" style="margin-top:50px;margin-left:5%;width: 90%;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:50px;">
       <div style="width:100%; display: flex; flex-direction: row; height:fit-content; justify-content: space-around; align-items: center;" class="comparaison_container">
       <div id="container_0" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center;display:none;">
                   <!-- Marque Dropdown 54-->
                   <select name="marque_0" id="marque_0" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled >
                       <option value="<?php echo $idMarque ?>">Marque</option>
                       
                   </select>

                   <!-- Modele Dropdown -->
                   <select name="modele_0" id="modele_0" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;"  disabled>
                       <option value="<?php echo $idModele ?>">Modele</option>
                   </select>

                   <!-- Version Dropdown -->
                   <select name="version_0" id="version_0" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;"  disabled>
                       <option value="<?php echo $idVersion?>">Version</option>
                   </select>
                   <!-- Annee Dropdown -->
                   <select name="annee_0" id="annee_0" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                       <option value="<?php echo $idVehicule ?>">Annee</option>
                   </select>
               </div>    
       <?php for ($i = 1; $i < 4; $i++) : ?>
               <div id="container_<?php echo $i; ?>" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center">
                   <!-- Marque Dropdown 54-->
                   <select name="marque_<?php echo $i; ?>" id="marque_<?php echo $i; ?>" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateModeles(this, <?php echo $i; ?>)">
                       <option value="">Marque</option>
                       <?php foreach ($marques as $marque) : ?>
                           <option value='<?php echo $marque['id']; ?>'><?php echo $marque['nom']; ?></option>
                       <?php endforeach; ?>
                   </select>

                   <!-- Modele Dropdown -->
                   <select name="modele_<?php echo $i; ?>" id="modele_<?php echo $i; ?>" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateVersions(this, <?php echo $i; ?>)" disabled>
                       <option value="">Modele</option>
                   </select>

                   <!-- Version Dropdown -->
                   <select name="version_<?php echo $i; ?>" id="version_<?php echo $i; ?>" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateAnnee(this, <?php echo $i; ?>)" disabled>
                       <option value="">Version</option>
                   </select>
                   <!-- Annee Dropdown -->
                   <select name="annee_<?php echo $i; ?>" id="annee_<?php echo $i; ?>" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                       <option value="">Annee</option>
                   </select>
               </div>
           <?php endfor; ?>
       </div>
       <button type="button" onclick="submitForm()" style="width:250px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Comparer</button>
      </form>
      <div class="d-flex justify-content-around mt-5 " id="textContainer"></div>

     <div class="d-flex justify-content-around mt-5 " id="cardContainer"></div>
    <div class="d-flex justify-content-center mt-5" id="table_container" >
    <table class="table table-bordered table-sm w-50">
    <thead>
               <tr id="lineOne" >                   
               </tr>
           </thead>
           <tbody id="tbody">
          </tbody>
   </table>
  </div>
   </div>
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
   })

   function displayCard(imageSrc, cardTitle, buttonText,id) {
  

   var card = $('<div>').addClass('card').css('width', '18rem');

   var cardImage = $('<img>').addClass('card-img-top').attr('src', imageSrc).attr('alt', 'Card Image');

   var cardBody = $('<div>').addClass('card-body');

   var cardTitleElement = $('<h5>').addClass('card-title').text(cardTitle);

   var button = $('<a>',{style:"border:none"}).addClass('btn btn-primary').attr('href', `./index.php?action=detailVehicule&idVehicule=${id}`).text(buttonText).css('background-color', '#F41F11');

   cardBody.append(cardTitleElement, button);

   card.append(cardImage, cardBody);

   // Append the new card to #cardContainer
   $('#cardContainer').append(card);
   }

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
       function displayTable(data){
        var $table = $("table"); 
        $table.find("#tbody").empty(); 
        var $thead = $table.find("thead");
        $thead.empty();
        var headerRow = '<tr ><th scope="col">Features</th>';
        data.forEach(element => {
           headerRow += '<th>' + element.vehicule_name + '</th>';  
        });
        headerRow += '</tr>';
        $thead.append(headerRow);
        var $tbody = $table.find("#tbody");
        data[0].characteristics.forEach(feature => {
           var featureRow = '<tr><th  scope="row">' + feature.nom + '</th>';
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
   function submitForm() {
        let cpt = 0;
   
    let data=[];
     for (let index = 0; index < 4; index++) {
       
       if (isReady(index)) {
           let res={marque:"",modele:"",version:"",id:""};
           res.marque=$(`#marque_${index}`).val();
           res.modele=$(`#modele_${index}`).val();
           res.version=$(`#version_${index}`).val();
           res.id=$(`#annee_${index}`).val();
           data.push(res);
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
      for (let i = 0; i < data.length; i++) {
          for (let j = i+1; j < data.length; j++) {
             if(i!=j){
                $.ajax({
                        type: "POST",
                        url: "./model/comparaison.php", 
                        data: {
                            idVehicule1: data[i].id,
                            idVehicule2: data[j].id
                        },
                        success: function (response) {
                            console.log(response);
                            
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                           
                        }
                    });
             }
            
          }        
       }
      result=[];
      var promises = data.map(element => {
    return new Promise((resolve, reject) => {
       $.ajax({
           type: "POST",
           url: "./model/vehiculeCaracteristique.php",
           data: {
               idMarque: element.marque,
               idModele: element.modele,
               idVersion: element.version,
               idVehicule: element.id
           },
           dataType: "json",
           success: function (response) {
               console.log(response);
               result.push(response);
               resolve(); 
           },
           error: function (xhr, status, error) {
               console.log("failed");
               console.error("AJAX Error:", status, error);
               reject(); 
           }
       });
    });
    });

     Promise.all(promises)
       .then(() => {
       console.log("result", result);
       if (result.length > 1) {
           $('#cardContainer').empty();
           console.log(result);
           sessionStorage.setItem("compResults",JSON.stringify(result));

           result.forEach(element => {
               displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
           });
           displayTable(result);
       }
    })
    .catch(() => {
       console.log("One or more AJAX requests failed");
    });
    } else {
       alert("Veuillez selectionner au moin un vehicule.");
    }
       }     
   </script>
   <?php
}
public function comparaisonPage($marques){
    ?>
 <div style="display:flex;flex-direction:column;align-items-center;width:100%;">
 <h1 style="margin-top:50px;text-align:center">Comparez vos vehicules</h1>
 <form  method="post" action="./index.php?action=comparateur" id="comparisonForm" style="margin-top:50px;margin-left:5%;width: 90%;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:50px;">
    <div style="width:100%; display: flex; flex-direction: row; height:fit-content; justify-content: space-around; align-items: center;" class="comparaison_container">
        <?php for ($i = 0; $i < 4; $i++) : ?>
            <div id="container_<?php echo $i; ?>" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center">
                <!-- Marque Dropdown 54-->
                <select name="marque_<?php echo $i; ?>" id="marque_<?php echo $i; ?>" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateModeles(this, <?php echo $i; ?>)">
                    <option value="">Marque</option>
                    <?php foreach ($marques as $marque) : ?>
                        <option value='<?php echo $marque['id']; ?>'><?php echo $marque['nom']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Modele Dropdown -->
                <select name="modele_<?php echo $i; ?>" id="modele_<?php echo $i; ?>" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateVersions(this, <?php echo $i; ?>)" disabled>
                    <option value="">Modele</option>
                </select>

                <!-- Version Dropdown -->
                <select name="version_<?php echo $i; ?>" id="version_<?php echo $i; ?>" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateAnnee(this, <?php echo $i; ?>)" disabled>
                    <option value="">Version</option>
                </select>
                <!-- Annee Dropdown -->
                <select name="annee_<?php echo $i; ?>" id="annee_<?php echo $i; ?>" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                    <option value="">Annee</option>
                </select>
            </div>
        <?php endfor; ?>
    </div>
    <button type="button" onclick="submitForm()"    style="width:250px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Comparer</button>
 </form>
  <div class="d-flex justify-content-around mt-5 " id="cardContainer"></div>
 <div class="d-flex justify-content-center mt-5" id="table_container" >
 <table class="table table-bordered table-sm w-50">
 <thead>
            <tr id="lineOne">                   
            </tr>
        </thead>
        <tbody id="tbody">
       </tbody>
 </table>
 </div>
 </div>

 <script>


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
        let res={marque:"",modele:"",version:"",id:""};
        res.marque=$(`#marque_${index}`).val();
        res.modele=$(`#modele_${index}`).val();
        res.version=$(`#version_${index}`).val();
        res.id=$(`#annee_${index}`).val();
        data.push(res);
        cpt++;
    } else if (isSelected(index)) {
        alert("Please fill in all fields.");
        return;
    }
 }

 if (cpt >= 2) {
    //
    console.log("passed");
   console.log(data);
   for (let i = 0; i < data.length; i++) {
      for (let j = i+1; j < data.length; j++) {
         if(i!=j){
            $.ajax({
                    type: "POST",
                    url: "./model/comparaison.php", 
                    data: {
                        idVehicule1: data[i].id,
                        idVehicule2: data[j].id
                    },
                    success: function (response) {
                        console.log(response);
                        
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                       
                    }
                });
         }
        
      }        
   }
   result=[];
   var promises = data.map(element => {
 return new Promise((resolve, reject) => {
    $.ajax({
        type: "POST",
        url: "./model/vehiculeCaracteristique.php",
        data: {
            idMarque: element.marque,
            idModele: element.modele,
            idVersion: element.version,
            idVehicule: element.id
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            result.push(response);
            resolve(); 
        },
        error: function (xhr, status, error) {
            console.log("failed");
            console.error("AJAX Error:", status, error);
            reject(); 
        }
    });
 });
 });

  Promise.all(promises)
    .then(() => {
    console.log("result", result);
    if (result.length > 1) {
        $('#cardContainer').empty();
        console.log(result);
        sessionStorage.setItem('compResults', JSON.stringify(result));
        $('#comparisonForm').submit();
    }
 })
 .catch(() => {
    console.log("One or more AJAX requests failed");
 });
 } else {
    alert("Please enter at least 2 vehicles.");
 }
    }        
 </script> 
 <?php
}
private function displayTable($data) {
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr><th scope="col">Features</th>';

    foreach ($data as $element) {
        echo '<th>' . $element[0]['vehicule_name'] . '</th>';
    }

    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($data[0][0]['characteristics'] as $feature) {
        echo '<tr><th class="firstcol" scope="row">' . $feature['nom'] . '</th>';

        foreach ($data as $element) {
            $values = [];
            $values[] = $element[0]['characteristics_values'][$feature['id']];

            foreach ($values as $value) {
                echo '<td>' . $value . '</td>';
            }
        }

        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}
public function displayComp($comp){
    $commun=new Commun();

    $commun->separator();
 ?>
   <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;gap:10px;margin-top:50px;">

    <div class="d-flex justify-content-around mt-5 "><h1>Comparaison</h1></div>
     <div class="d-flex flex-row justify-content-around w-50 mt-5 ">
       <?php
       foreach ($comp as $cmp) {
           ##print_r($cmp[0]);
           $commun->displayCard("./img/vehicules/". $cmp[0]["image_paths"][0]["chemin"],$cmp[0]["vehicule_name"],"Voir Details",$cmp[0]["vehicule_id"]);
       }
       ?>
     </div>
    <div class="d-flex justify-content-center mt-5" >
    <?php
    
     $this->displayTable($comp);
    ?>
  </div>
 </div>


  

 <?php
}

}


?>