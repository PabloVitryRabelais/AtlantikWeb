<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleSecteur extends Model
{
    protected $table = 'secteur sec'; 
    protected $primaryKey = 'nosecteur';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
    protected $allowedFields = ['nom'];
    public function getAllLiaisonSecteur()
    { 
        return $this->join('liaison li', 'sec.nosecteur = li.nosecteur', 'inner')
        ->join('port port_depart', 'li.noport_depart = port_depart.noport',  'inner')
        ->join('port port_arrivee', 'li.noport_arrivee = port_arrivee.noport',  'inner')
        ->select('sec.NOM as nomSecteur, li.noliaison as noLiaison, port_depart.nom as portDepart, port_arrivee.nom as portArrivee, distance')
        ->get()->getResult();
    } 

    public function getAllTarifLiaison($noliaison)
    {
        $date = date('Y-m-d');
        $condition = ['periode.datedebut >' => date('Y-m-d'), 'li.noliaison =' => $noliaison];

        return $this->join('liaison li', 'sec.nosecteur = li.nosecteur', 'inner')
        ->join('port port_depart', 'li.noport_depart = port_depart.noport',  'inner')
        ->join('port port_arrivee', 'li.noport_arrivee = port_arrivee.noport',  'inner')
        ->join('tarifer', 'li.noliaison = tarifer.noliaison',  'inner')
        ->join('periode', 'tarifer.noperiode = periode.noperiode', 'inner')
        ->join('categorie', 'tarifer.lettrecategorie = categorie.lettrecategorie', 'inner')
        ->join('type', 'tarifer.lettrecategorie = type.lettrecategorie and tarifer.notype = type.notype', 'inner')
        ->where($condition)
        ->select('sec.NOM as nomSecteur, li.noliaison as noLiaison, port_depart.nom as portDepart, port_arrivee.nom as portArrivee, tarifer.tarif as tarif, categorie.lettrecategorie as lettre, categorie.libelle as lettreLibelle, type.notype as type, type.libelle as typeLibelle, periode.datedebut as datedebut, periode.datefin as datefin')
        ->get()->getResult();
    }
}