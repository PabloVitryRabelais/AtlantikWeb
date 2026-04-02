<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleSecteur;
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
        if ($noSecteur === null) {
            $modSecteur = new ModeleSecteur();
            $data["LesSecteurs"] = $modSecteur->findAll();
            $data["TitrePage"] = "Affichage des traversées par secteurs";
            return view('Templates/Header')
                .view('Visiteur/vue_VisuTraversees', $data)
                .view('Templates/Footer'); 
        } else
        {
            $modSecteur = new ModeleSecteur();
            $data["LesSecteurs"] = $modSecteur->findAll();
            $data["TitrePage"] = "Affichage des traversées par secteurs";
            $data["Periode"]
            return view('Templates/Header')
                .view('Visiteur/vue_VisuTraversees', $data)
                .view('Templates/Footer'); 
        }
    }
}