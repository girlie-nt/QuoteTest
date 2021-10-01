<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shout_model extends CI_Model
{
    public function read(){
       $query = $this->db->query("select * from `quotes`");
       return $query->result_array();
   }
    public function get_shout($author_name){
        $parameters = $this->input->get();
        $author_name = str_replace("-", " ", $author_name);
        $this->db->select('quote');
        $this->db->from('quotes');
        $this->db->where('author',$author_name);
        if(!empty($parameters['limit'])){
            if($parameters['limit'] <=10)
                $this->db->limit($parameters['limit']);
            else
            return "Quotes are limited!";
        }
        $query = $this->db->get();
        return $query->result_array();
    }
   public function insert($data){
       
       $this->author    = $data['author']; // please read the below note
       $this->quote  = $data['quote'];
       if($this->db->insert('quotes',$this))
       {    
           return 'Shout is inserted successfully';
       }
         else
       {
           return "Error has occured";
       }
   }
   public function update($id,$data){
   
      $this->author    = $data['author']; // please read the below note
       $this->quote  = $data['quote'];
       $result = $this->db->update('quotes',$this,array('id' => $id));
       if($result)
       {
           return "Shout is updated successfully";
       }
       else
       {
           return "Error has occurred";
       }
   }
   public function delete($id){
   
       $result = $this->db->query("delete from `quotes` where id = $id");
       if($result)
       {
           return "Shout is deleted successfully";
       }
       else
       {
           return "Error has occurred";
       }
   }
}
?>