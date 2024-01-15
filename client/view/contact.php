<?php
class ContactView{
    public function contactDetails($contact)
    {
            echo '<div style="width: 100%; margin: 10px auto; display: flex;flex-direction:column ; align-items: center;gap:10px;">';
            echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
            echo '</div>';
            echo '                          <h1>Contactez-nous  </h1>
            ';
            echo '<div style="width: 80%; margin: 10px auto; display: flex;flex-direction:column;gap:20px">';
            ?>
    <div style="display:flex;justify-content:center;">
        <div style="width:90%;height:5px;background-color:#F41F11;margin-top:50px;"></div></div>
              <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
              <h3>Nom du développeur :  </h3>
              <input id="nomDev" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $contact[0]['nomDev'] ?>"  >
            </div>
            <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
            <h3>Addresse mail :  </h3>
              <a style="color:black;text-decoration:none" href="mailto:<?php echo $contact[0]['mail']  ?>"><?php echo $contact[0]['mail'] ?></a>
            </div>
            <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
            <h3>Lien Facebook :  </h3>
            <a style="color:black;text-decoration:none" href="<?php echo $contact[0]['facebook']  ?>"><?php echo $contact[0]['facebook'] ?></a>
            </div>
            <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
            <h3>Numéro de téléphone :  </h3>
              <input id="numero" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $contact[0]['numero'] ?>"  >
            </div>
            
            
            
    
            
    
         </div>
    
           
            
            </div>
            
           
            <?php
    
    }
}
?>