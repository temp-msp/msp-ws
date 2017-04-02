<?php 
Class User extends CI_Model
{
 function login($username, $password)
 {
  

    $this->db->select ('*'); 
    $this->db->from ( 'user u' );
    $this->db->where ( 'u.id_user', $username);
    $this->db->where('u.password', $password);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 function ubahPassword($data)
 {
    $sql = "UPDATE user SET password='".md5($data['pass'])."' WHERE id_user='".$data['user']."'";
    $res = $this->db->query($sql);

    return $res;
 }
}
?>