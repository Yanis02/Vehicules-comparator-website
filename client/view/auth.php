<?php
class Auth{

    public function login(){
        ?>
        <div style="display:flex;justify-content:center;align-items:center;width:100%;" >
          <form method="post" action="./index.php?action=loginHandler" style="padding:10px;width: 700px; height: 500px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center" >
            <h1>Vous avez deja un compte? connectez-vous :</h1>
            <label for="username" style="margin-right:50%;">Nom utilisateur :</label>
            <input name="username" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
            <label for="password" style="margin-right:50%;">Mot de passe :</label>
            <input name="password" type="password" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
            <button type="submit" style="width:150px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Se connecter</button>
            <a href="./index.php?action=register">Vous n avez pas de compte? inscrivez-vous</a>
         </form>
        </div>
        <?php
    }
    public function register(){
        ?>
         <div style="display:flex;justify-content:center;align-items:center;width:100%;" >
          <form method="post" action="./index.php?action=handleRegister" style="padding:10px;width: 700px; height: 700px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center" >
            <h1>Veuillez remplir le formulaire suivant</h1>
            <label for="nom" style="margin-right:50%;">Nom :</label>
            <input name="nom" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
            <label for="prenom" style="margin-right:50%;">Prenom :</label>
            <input name="prenom" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
            <label for="sexe" style="margin-right:50%;">Sexe :</label>
            <select name="sexe"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
            <option value="">Sexe</option>

            <option value="Male">Male</option>
                           <option value="Femelle">Femelle</option>
            </select>
            <label for="date_naissance" style="margin-right:50%;">Date de naissance :</label>
            <input name="date_naissance" type="date" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
            <label for="username" style="margin-right:50%;">Nom utilisateur :</label>
            <input name="username" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
            <label for="password" style="margin-right:50%;">Mot de passe :</label>
            <input name="password" type="password" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
            <button style="width:150px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Inscrire</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Votre profile sera accessible une fois validé par un administrateur
      </div>
      <div class="modal-footer">
      <button type="submit" style="width:120px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Compris</button>
    </div>
    </div>
  </div>
</div>
            
         </form>
        </div>
        <?php
    }
   
}
?>