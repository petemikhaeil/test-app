<?php

namespace Controller;

use Slim\Http\Request;
use Repository;

class ParticleController{

   public function __construct($logger, $db, $renderer)
   {
       $this->logger=$logger;
       $this->db=$db;
       $this->renderer=$renderer;
   }

    public function select($request, $response)
   {
       $this->logger->info("Slim-Skeleton '/' route");

       return $this->renderer->render($response, 'select.phtml');
   }

   public function post_select($request, $response)
   {
       $this->logger->info("Slim-Skeleton '/' route");

       $select = $request->getParam('select_orig');
       $particleRepository = new Repository\ParticleRepository($this->db);
       $results = $particleRepository->fetchByCharge($select);

       return $this->renderer->render($response, 'select.phtml', ['results'=>$results] + ['select' => $select]);
   }

   public function inserting($request, $response){
       $this->logger->info("Slim-Skeleton '/' route");

       return $this->renderer->render($response, 'particle2.phtml');
   }

   public function post_inserting($request, $response){
       $this->logger->info("Slim-Skeleton '/' route");

       $particle = $request->getParam('particle1');
       $charge = $request->getParam('charge1');
       $info=array($particle, $charge);
       $particleRepository = new Repository\ParticleRepository($this->db);
       $particleRepository->store($info);

       return $this->renderer->render($response, 'particle2.phtml', ['particle' => $particle] + ['charge' => $charge]);
   }

   public function deleting($request, $response){
       $this->logger->info("Slim-Skeleton '/' route");

       $particleRepository = new Repository\ParticleRepository($this->db);
       $results = $particleRepository->fetchAll();

       return $this->renderer->render($response, 'delete.phtml', ['results'=>$results]);
   }

   public function post_deleting($request, $response){
       $this->logger->info("Slim-Skeleton '/' route");

       $delete = $request-> getParam('delete_orig');
       $particleRepository = new Repository\ParticleRepository($this->db);
       $particleRepository->delete($delete);
       $results = $particleRepository->fetchAll();

       return $this->renderer->render($response, 'delete.phtml', ['results'=>$results] + ['delete_id'=>$delete]);
   }
}