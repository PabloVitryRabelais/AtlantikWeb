<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleSecteur;
use App\Models\ModelePeriode;
use App\Models\ModeleTraversee;
use App\Models\ModeleLiaison;
use App\Models\ModeleAdministrateur;
helper(['assets']);

class Visiteur extends BaseController
{
    public function acceuil()
    {
        $data['TitrePage'] = "Acceuil";
        return view('Templates/Header')
        .view('Visiteur/vue_Acceuil', $data)
        .view('Templates/Footer');
    }

    public function creerCompte()
    {
        helper(['form']);
        $data['TitrePage'] = 'Creer un compte';

        if (!$this->request->is('post')) 
        {
            return view('Templates/Header')
            .view('Visiteur/vue_CreerCompte', $data)
            .view('Templates/Footer');
        }

        $reglesValidation = [
            'txtNom' => 'required|alpha|max_length[30]',
            'txtPrenom' => 'required|alpha|max_length[30]',
            'txtAdresse' => 'required|string|max_length[30]',
            'txtCodePostal' => 'required|numeric|max_length[8]',
            'txtVille' => 'required|string|max_length[30]',
            'txtTelFixe' => 'permit_empty|regex_match[^0[67]\.\d{2}(\.\d{2}){3}$]',
            'txtTelMobile' => 'permit_empty|regex_match[^0[67]\.\d{2}(\.\d{2}){3}$]',
            'txtMel' => 'required|max_length[254]|valid_email',
            'txtMDP' => 'required|string|max_length[30]',
            'txtConfMDP' => 'required|string|matches[txtMDP]',
        ];

        if (!$this->validate($reglesValidation)) {
            $data['TitrePage'] = "Saisie formulaire incorrecte";
            helper('form');
            return view('Templates/Header')
            .view('Visiteur/vue_CreerCompte', $data)
            .view('Templates/Footer');
        }
        $donneesAInserer = array(
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'codepostal' => $this->request->getPost('txtCodePostal'),
            'ville' => $this->request->getPost('txtVille'),
            'telephonefixe' => $this->request->getPost('txtTelFixe'),
            'telephonemobile' => $this->request->getPost('txtTelMobile'),
            'mel' => $this->request->getPost('txtMel'),
            'motdepasse' => $this->request->getPost('txtMDP'),
        );

        $modClient = new ModeleClient(); 
        $data['compteAjoute'] = $modClient->insert($donneesAInserer, true);
        return view('Templates/Header')
            .view('Visiteur/vue_RapportAjouterCompte', $data)
            .view('Templates/Footer');
    }

    public function seConnecter()
    {
        helper(['form']);
        $session = session();

        $data['TitrePage'] = 'Se connecter';
        if (!$this->request->is('post')) {
            return view('Templates/Header', $data) 
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');

        }
        $reglesValidation = [ 
            'txtID' => 'required',
            'txtMDP' => 'required',
        ];

        if (!$this->validate($reglesValidation)) {
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter') 
            . view('Templates/Footer');
        }

        $Identifiant = $this->request->getPost('txtID');
        $MdP = $this->request->getPost('txtMDP');
        $modClient = new ModeleClient(); 
        $condition = ['mel'=>$Identifiant,'motdepasse'=>$MdP];
        $utilisateurRetourne = $modClient->where($condition)->first();

        if ($utilisateurRetourne != null) {
            $session->set('identifiant', $utilisateurRetourne->MEL);
            $session->set('profil', 'client');
            $data['TitrePage'] = 'Acceuil';
            echo view('Templates/Header')
            . view('Visiteur/vue_Acceuil', $data)
            . view('Templates/Footer');
        } else {
            $modAdmin = new ModeleAdministrateur(); 
            $condition = ['identifiant'=>$Identifiant,'motdepasse'=>$MdP];
            $utilisateurRetourne = $modAdmin->where($condition)->first();
            if ($utilisateurRetourne != null) 
            {
                $session->set('identifiant', $utilisateurRetourne->IDENTIFIANT);
                $session->set('profil', 'Admin');
                $data['TitrePage'] = 'Acceuil';
                echo view('Templates/Header')
                . view('Visiteur/vue_Acceuil', $data)
                . view('Templates/Footer');
            } else 
            {
                $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
                return view('Templates/Header')
                . view('Visiteur/vue_SeConnecter', $data)
                . view('Templates/Footer');
            }
        }
    }

    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('Atlantik');
    }

    public function LiaisonSecteur($noLiaison = null)
    {
        if ($noLiaison === null)
        {
            $modSecteur = new ModeleSecteur();
            $data['liaisonsParSecteur'] = $modSecteur->getAllLiaisonSecteur();
            $data['TitrePage'] = "Affichage des Liaisons par Secteurs";
            return view('Templates/Header')
            .view('Visiteur/vue_LiaisonParSecteur', $data)
            .view('Templates/Footer'); 
        } else 
        {
            $modSecteur = new ModeleSecteur();
            $data['tarifParLiaison'] = $modSecteur->getAllTarifLiaison($noLiaison);
            $data['TitrePage'] = "Affichage des Tarifs pour Liaison n°".$noLiaison;
            return view('Templates/Header')
            .view('Visiteur/vue_TarrifParLiaison', $data)
            .view('Templates/Footer'); 
        }
    }

    public function VisualiserTraversees($noSecteur = null)
    {
        $modTraversee = new ModeleTraversee();
        $modSecteur = new ModeleSecteur();
        $modPeriode = new ModelePeriode();
        $data["TitrePage"] = "Affichage des traversées par secteurs";
        $data["LesDates"] = $modTraversee->where('dateheuredepart >', date('Y-m-d-h'))->findAll();
        $data["LesSecteurs"] = $modSecteur->findAll();
        helper(['form']);
        if (!isset($_POST['btnAfficher']))
        {
            if ($noSecteur === null) {
                return view('Templates/Header')
                    .view('Visiteur/vue_VisuTraversees', $data)
                    .view('Templates/Footer'); 
            } else
            {
                $data["LesLiaisons"] = $modSecteur->getAllLiaisonsParSecteur($noSecteur);
                return view('Templates/Header')
                    .view('Visiteur/vue_VisuTraversees', $data)
                    .view('Templates/Footer'); 
            }
        } else {
            $modLiaison = new ModeleLiaison();
            $data['TitrePorts'] = $modLiaison->getPortsLiaison($this->request->getPost('cmbLiaisons'));
            $data['TitrePeriode'] = $this->request->getPost('cmbPeriode');
            $data['LesTraversees'] = $modTraversee->getAllTraverseeLiaisons($this->request->getPost('cmbLiaisons'), $this->request->getPost('cmbPeriode'));
            $data['PlacesReservees'] = $modTraversee->getAllPlacesReservee($this->request->getPost('cmbLiaisons'), $this->request->getPost('cmbPeriode'));
            if ($noSecteur === null) {
                return view('Templates/Header')
                    .view('Visiteur/vue_VisuTraversees', $data)
                    .view('Templates/Footer'); 
            } else
            {
                $data["LesLiaisons"] = $modSecteur->getAllLiaisonsParSecteur($noSecteur);
                return view('Templates/Header')
                    .view('Visiteur/vue_VisuTraversees', $data)
                    .view('Templates/Footer'); 
            }
        }
    }
}