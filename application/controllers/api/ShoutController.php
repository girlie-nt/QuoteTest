<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/RestController.php';

class ShoutController extends RestController
{
       public function __construct() {
               parent::__construct();
               $this->load->model('shout_model');
       }    
       public function shout_get($name){
        //    $r = $this->shout_model->read();
            $r = $this->shout_model->get_shout($name);
            $this->response($r); 
       }
       public function shoutUC_get($name){
            $r = $this->shout_model->get_shout($name);
            if(is_array($r)){
                $shouted = array();
                foreach($r as $res){
                    $shouted[] = strtoupper(rtrim($res['quote'],".")).'!';
                }
                $this->response($shouted);
            }else
                $this->response($r); 
       }

       public function shout_put(){
           $id = $this->uri->segment(3);
           $data = array('author' => $this->input->get('author'),
           'quote' => $this->input->get('quote')
           );
            $r = $this->shout_model->update($id,$data);
               $this->response($r); 
       }
       public function shout_post(){
           $data = array('id'=> '',
            'author' => $this->input->post('author'),
           'quote' => $this->input->post('quote')
           );
           $r = $this->shout_model->insert($data);
           $this->response($data); 
       }
       public function shout_delete(){
           $id = $this->uri->segment(3);
           $r = $this->shout_model->delete($id);
           $this->response($r); 
       }
    
}
?>