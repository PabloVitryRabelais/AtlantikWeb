<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleLiaison extends Model
{
    protected $table = 'liaison li'; 
    protected $primaryKey = 'noliaison';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
    protected $allowedFields = ['noport_depart','nosecteur','noport_arrivee','distance'];

    public function getPortsLiaison($noLiaison)
    {
        return $this->join('port port_depart', 'li.noport_depart = port_depart.noport',  'inner')
        ->join('port port_arrivee', 'li.noport_arrivee = port_arrivee.noport',  'inner')
        ->where('li.noliaison', $noLiaison)
        ->select('port_depart.nom as portDepart, port_arrivee.nom as portArrivee')
        ->get()->getResult();
    }
}