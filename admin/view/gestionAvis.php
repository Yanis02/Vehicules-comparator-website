<?php
class GestionAvis{
    function generateDataTable($avis)
    {   
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
    
        echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">';
        echo '<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>';
        echo '<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>';
        echo '<style>
        
       
        a.page-link {
            background-color: #F41F11 !important;
            border-color: white !important;
            color: #fff !important;
        }
     </style>';
    
        echo '<script>
            $(document).ready(function() {
                $("#dataTable").DataTable();
            });
        </script>';
    
        echo '<div class="container mt-4">
             <h1>Gestion des avis vehicules</h1>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr><th scope="col">Utilisateur</th>
                <th scope="col">Vehicule</th>
                <th scope="col">Avis</th>
                <th scope="col">Status</th>
                <th scope="col">Approuver</th>
                <th scope="col">Refuser</th>
                <th scope="col">Action utilisateur</th>

                </tr></thead><tbody>';
    
        foreach ($avis as $av) {
            echo '<tr><td class="firstcol" scope="row">' . $av["utilisateur"]['nom'] ." " . $av["utilisateur"]['prenom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $av['vehicule_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $av['valeur'] . '</td>';
            echo '<td class="firstcol" scope="row">';
            if ($av['status'] == 0) {
                echo 'Non validé';
            } elseif ($av['status'] == 1) {
                echo 'Validé';
            } 
            echo '</td>';
          echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=approuverAvisVehicule&id=' . $av['avis_id'] . '"> Approuver </a></td>';
          echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=refuserAvisVehicule&id=' . $av['avis_id'] . '"> Refuser </a></td>';  
          echo '<td class="firstcol" scope="row">';

          if ($av["utilisateur"]["user_status"] == 1) {
              echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=debloquerUtilisateur&id=' . $av["utilisateur"]["id"] . '"> Débloquer utilisateur </a>';
          } else {
              echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=bloquerUtilisateur&id=' . $av["utilisateur"]["id"] . '"> Bloquer utilisateur </a>';
          }
          
          echo '</td>';
                      echo '</tr>';
        }
    
        echo '</tbody></table>
        
        
        </div>';
        
    }
    function generateDataTableMarques($avis)
    {   
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
    
        echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">';
        echo '<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>';
        echo '<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>';
        echo '<style>
        
       
        a.page-link {
            background-color: #F41F11 !important;
            border-color: white !important;
            color: #fff !important;
        }
     </style>';
    
        echo '<script>
            $(document).ready(function() {
                $("#dataTable").DataTable();
            });
        </script>';
    
        echo '<div class="container mt-4">
             <h1>Gestion des avis marques</h1>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr><th scope="col">Utilisateur</th>
                <th scope="col">Marque</th>
                <th scope="col">Avis</th>
                <th scope="col">Status</th>
                <th scope="col">Approuver</th>
                <th scope="col">Refuser</th>
                <th scope="col">Action utilisateur</th>

                </tr></thead><tbody>';
    
        foreach ($avis as $av) {
            echo '<tr><td class="firstcol" scope="row">' . $av["utilisateur"]['nom'] ." " . $av["utilisateur"]['prenom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $av['marque_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $av['valeur'] . '</td>';
            echo '<td class="firstcol" scope="row">';
            if ($av['status'] == 0) {
                echo 'Non validé';
            } elseif ($av['status'] == 1) {
                echo 'Validé';
            } 
            echo '</td>';
          echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=approuverAvisMarque&id=' . $av['avis_id'] . '"> Approuver </a></td>';
          echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=refuserAvisMarque&id=' . $av['avis_id'] . '"> Refuser </a></td>';  
          echo '<td class="firstcol" scope="row">';

          if ($av["utilisateur"]["user_status"] == 1) {
              echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=debloquerUtilisateur&id=' . $av["utilisateur"]["id"] . '"> Débloquer utilisateur </a>';
          } else {
              echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=bloquerUtilisateur&id=' . $av["utilisateur"]["id"] . '"> Bloquer utilisateur </a>';
          }
          
          echo '</td>';
                      echo '</tr>';
        }
    
        echo '</tbody></table>
        
        
        </div>';
        
    }

}
?>