<?php
class gestionContact{
    public function contactDetails($contact)
    {
            echo '<div style="width: 100%; margin: 10px auto; display: flex;flex-direction:column ; align-items: center;gap:10px;">';
            echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
            echo '</div>';
            echo '                          <h1>Gestion de contact  </h1>
            ';
            echo '<div style="width: 80%; margin: 10px auto; display: flex;flex-direction:column;gap:20px">';
            ?>

              <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
              <h3>Nom du développeur :  </h3>
              <input id="nomDev" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $contact[0]['nomDev'] ?>"  >
            </div>
            <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
            <h3>Addresse mail :  </h3>
              <input id="mail" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $contact[0]['mail'] ?>"  >
            </div>
            <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
            <h3>Lien Facebook :  </h3>
              <input id="facebook" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $contact[0]['facebook'] ?>"  >
            </div>
            <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
            <h3>Numéro de téléphone :  </h3>
              <input id="numero" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $contact[0]['numero'] ?>"  >
            </div>
            
            
            
            <div id="imgContainer" style="display:none">
    
            
    
         </div>
            <button id="btn_vehicule" onclick="updatecontact()" type="button" class="btn btn-primary" style="width:150px;border:none;background-color:#F41F11">Modifier</button>
    
           
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            </div>
            
            <script>
             
            function updatecontact(idcontact){
                var nomDevInput=$('#nomDev');
                var mailInput=$('#mail');
                var facebookInput=$('#facebook');
                var numeroInput=$('#numero');
                var btn=$('#btn_vehicule');
                if (btn.text()=== 'Modifier') {
                    btn.text('Submit');
                    nomDevInput.prop('disabled', false).css('border', '1px solid #F41F11');
                    mailInput.prop('disabled', false).css('border', '1px solid #F41F11');
                    facebookInput.prop('disabled', false).css('border', '1px solid #F41F11');
                    numeroInput.prop('disabled', false).css('border', '1px solid #F41F11');

    
                    //imageContainer.css("display", "block");
    
                } else {
                    nomDevInput.prop('disabled', true).css('border', 'none');
                    mailInput.prop('disabled', true).css('border', 'none');
                    facebookInput.prop('disabled', true).css('border', 'none');
                    numeroInput.prop('disabled', true).css('border', 'none');

    
                    nomDev=nomDevInput.val();
                    mail=mailInput.val();
                    facebook=facebookInput.val();
                    numero=numeroInput.val();

                    //console.log(idcontact,title,description,details);
                    $.ajax({
                type: "POST",
                url: "./model/contact.php",
                data: {
                    nomDev:nomDev,
                    mail:mail,
                    facebook:facebook,
                    numero:numero
                       },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    console.log("updated");
                },
                error: function (xhr, status, error) {
                    console.log("failed");
                    console.error("AJAX Error:", status, error);
                    console.log(xhr.responseText);
                }
            });
                   btn.text('Modifier');
    
                    
                }
            }
           
            </script>
            
            <?php
    
    }
}
?>