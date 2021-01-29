<?php


class Form extends Model
{

  public function insert($data)
  {
    $this->query(
      'INSERT INTO kansou (family_name,name,email,impression,next_buy) VALUES(:family_name,:name,:email,:impression,:next_buy)');
    
    $this->bind(':family_name',$data['family_name']);
    $this->bind(':name',$data['name']);
    $this->bind(':email',$data['email']);
    $this->bind(':impression',$data['impression']);
    $this->bind(':next_buy',$data['next_buy']);

    if($this->execute()){
      return true;
    }else {
      return false;
    }
  }
}