<?php

namespace Repository;

class ParticleRepository
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function fetchAll()
    {
        $query = sprintf(
            "SELECT `id`, `Particle`, `Charge` from `particles`;"
        );


        $result = $this->db->query($query);

        return $result;
    }

    public function fetchByCharge($charge){
        $query = sprintf(
            "SELECT `id`, `Particle`, `Charge` from `particles` WHERE `Charge`=%s;",
            $charge
        );


        $result = $this->db->query($query);
        $returnResult=[];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $returnResult[] = $row;
            }
        }
        return $returnResult;
    }

    public function store(array $info)
    {
        $query = sprintf(
            'INSERT INTO `particles` (
                `Particle`,
                `Charge`
              )
              VALUES (
                \'%s\',
                %s
               );',
            $info[0],$info[1]
        );

        $this->db->query($query);
    }

    public function delete($id){
        $query = sprintf(
                "DELETE FROM `particles` WHERE `id`=%s;",
                        $id
        );

        $this->db->query($query);
    }
}