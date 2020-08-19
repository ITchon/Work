<?php

class Model extends CI_Model
{


  public function CheckSession()        
  {
    if ($this->agent->is_mobile())
    {
      $id =  $this->session->userdata('su_id');
      $query = $this->db->query("SELECT * from sys_users WHERE su_id = $id AND enable != 0 "); 
      $result = $query->result()[0];
      if( $result->mobile==0){
      echo "<script>alert('No Moblie Permission')</script>";
      redirect('login','refresh');   
      exit;
      }
    }
      if($this->session->userdata('su_id')=="") {
        echo "<script>alert('Please Login')</script>";
        redirect('login','refresh');
     return FALSE;
     
      }else{    return TRUE;    }
  }
    public function load_menu()
  { 
    if($this->session->userdata('sug_id')!=3){
         $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'),$this->session->userdata('su_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
          $menu['submenu'] = $this->model->showsubmenu($this->session->userdata('su_id'));
         $this->load->view('header');
        $this->load->view('menu',$menu);
    }else{
        $menu['menu'] = $this->model->showmenu_user($this->session->userdata('sug_id'),$this->session->userdata('su_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
        $menu['mg']= $this->model->givemeid($url);
        $menu['submenu'] = $this->model->showsubmenu($this->session->userdata('su_id'));

         $this->load->view('header');
        $this->load->view('menu_user',$menu);
    }

      
  }
   function showmenu($sug_id,$su_id){
    $sql =  'SELECT DISTINCT smg.name AS g_name, smg.icon_menu, sm.mg_id, smg.mg_id AS mg, smg.order_no ,smg.link
    FROM sys_menus AS sm 
    inner JOIN sys_menu_groups AS smg ON smg.mg_id = sm.mg_id 
    inner join sys_permission_groups as spg ON spg.mg_id = sm.mg_id
    inner join sys_users_groups_permissions as sugp ON sugp.spg_id = spg.spg_id
    where sug_id = '.$sug_id.' 
    ORDER BY smg.order_no ASC';    
    $query = $this->db->query($sql); 
    $result = $query->result();
    return $result;
 }
 function showmenu_user($sug_id,$su_id){
  $sql =  'SELECT DISTINCT smg.name AS g_name, smg.icon_menu, sm.mg_id, smg.mg_id AS mg, smg.order_no ,smg.link,sp.sp_id,sup.su_id
  FROM sys_menus AS sm 
  inner JOIN sys_menu_groups AS smg ON smg.mg_id = sm.mg_id 
  inner join sys_permission_groups as spg ON spg.mg_id = sm.mg_id
  inner join sys_users_groups_permissions as sugp ON sugp.spg_id = spg.spg_id
  inner join sys_permissions as sp on sp.controller = smg.link
  inner join sys_users_permissions as sup on sup.sp_id = sp.sp_id
  where sug_id = '.$sug_id.' and sup.su_id = '.$su_id.'
  ORDER BY smg.order_no ASC';    
  $query = $this->db->query($sql); 
  $result = $query->result();
  return $result;
}

 function showsubmenu($id){
    $sql =  "SELECT  sm.name,sm.mg_id,sm.method from sys_menus as sm
    inner join sys_permissions as sp on sp.controller = sm.link
    inner join sys_users_permissions as sup on sup.sp_id = sp.sp_id
    WHERE order_no !=0 AND sm.enable != 0 AND sp.enable != 0 ANd sup.su_id = $id ORDER BY sm.order_no ASC"; 
    $query = $this->db->query($sql); 
    $result = $query->result(); 
    return $result;   
 }


 function givemeid($para){
  $sql ="SELECT *  FROM sys_menus 
  WHERE link='$para'  ";
    $query = $this->db->query($sql);  
   $data = $query->result(); 
   return $data;
 }

  public function sub_part($id,$bm,$origin)
  { 
    $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where m_id = '.$id.'  AND sub_part.delete_flag != 0 and b_id = '.$bm.' AND origin='.$origin.'';
    $query = $this->db->query($sql); 
    if($query){
      $result= $query->result();
      return $result;
    }else{
      return false;
    }
      
  }
  public function sub_bom($id,$bm)
  { 
    $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where m_id = '.$id.'  AND sub_part.delete_flag != 0 and b_id = '.$bm.'';
    $query = $this->db->query($sql); 
    if($query){
      $result= $query->result();
      return $result;
    }else{
      return false;
    }
      
  }
 

      public function get_user()
      {
        $sql =  'SELECT su.su_id,su.password,su.username, su.firstname ,su.lastname, su.gender,su.email,su.enable,su.delete_flag, sug.name as name,su.mobile
        FROM
        sys_users  AS su 
        INNER JOIN sys_user_groups AS sug ON sug.sug_id = su.sug_id where su.delete_flag != 0 AND sug.sug_id != "1"';
        $query = $this->db->query($sql); 
        $result =  $query->result();
        return $result;
      }
  public function get_part_drawing_byid($d_id)
  {
    $sql =  "SELECT * from part_drawing  as pd
        left join part as p on p.p_id = pd.p_id
        where pd.d_id = $d_id";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  public function get_part()
  {
    $sql =  "SELECT * from part  where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  public function get_nopart($p_id)
  {
      $p_id =  implode(',',$p_id);
    $sql =  "SELECT * from part where delete_flag != 0 AND p_id NOT IN ($p_id)";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function get_dcn()
  {
    $sql =  "SELECT * from dcn  where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function get_partdrawing()
  {
    $sql =  "SELECT d.d_id,p.p_id,pd.p_id as pd_pid,pd.d_id as pd_did,d.d_no,d.d_name,c.cus_id,c.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
          from drawing as d
            left join part_drawing as pd on pd.d_id = d.d_id
            left join customers as c on c.cus_id = d.cus_id
            left join dcn as dc on dc.dcn_id = d.dcn_id
            left join part as p on p.p_id = pd.p_id
          where d.delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  public function get_pid_bypd($d_id)
  {
    $sql =  "SELECT pd.p_id from part_drawing  as pd
        where pd.d_id = $d_id";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  public function get_customers()
  {
    $sql =  "SELECT * from customers where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  public function get_type_drawing()
  {
    $sql =  "SELECT * from type_file where tf_group = 1 and delete_flag != 0 OR tf_group = 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function get_drawing()
  {
    $sql =  "SELECT * from drawing  where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  public function get_drawing_byid($d_id)
  {
    $sql =  "SELECT * from drawing where d_id = $d_id";
       $query = $this->db->query($sql);
      $result =  $query->result()[0];
    return $result;
  }


  public function get_sub_by($id)
  {
    $sql =  "SELECT * from sub_part  where sub_id = $id AND delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }
  public function get_drawing_by($search,$sort)
  {
      $sql =  "SELECT d.d_id, d.d_no,d.d_name,cus.cus_id,cus.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no
      ,p.p_id,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
      from drawing as d
      inner join dcn as dc on dc.dcn_id = d.dcn_id
      left join part as p on p.d_id = d.d_id 
      inner join customers as cus on cus.cus_id = d.cus_id 
      where d.delete_flag != 0 AND $sort LIKE '%{$search}%'";
      $query = $this->db->query($sql); 
      $result =  $query->result();
      return $result;
  }
  public function get_drawing_ver($id)
  {
     $sql =  "SELECT d.d_id, d.d_no,d.d_name,d.cus_id,cus.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.path_file, d.file_name, d.version
     , p.p_no,p.p_id,'v_id',dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
            from drawing as d
            left join part_drawing as pd on pd.d_id = d.d_id
            left join dcn as dc on dc.dcn_id = d.dcn_id
            left join part as p on p.p_id = pd.p_id 
            left join customers as cus on cus.cus_id = d.cus_id 
            where d.delete_flag != 0 AND d.d_id = $id
            UNION
                SELECT v.d_id, v.d_no,v.d_name,v.cus_id,cus.cus_name, v.dcn_id, dc.dcn_no, v.enable, v.path_file, v.file_name, v.version
                , p.p_no,p.p_id, v.v_id,dc.file_name as dcn_file,dc.path_file as dcn_path,v.file_code,dc.file_code as dcn_code
         from version as v
         left join part_drawing as pd on pd.d_id = v.d_id
         left join dcn as dc on dc.dcn_id = v.dcn_id
         left join part as p on p.p_id = pd.d_id 
         left join customers as cus on cus.cus_id = v.cus_id 
         where v.delete_flag != 0 AND v.d_id = $id
         ORDER by version DESC ";
      $query = $this->db->query($sql); 
      $result =  $query->result();
      return $result;
  }


  public function get_dcn_by($search,$sort)
  {
     $sql =  "SELECT d.d_id, d.d_no,d.d_name,cus.cus_id,cus.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no 
     ,p.p_id,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
          from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          inner join part as p on p.d_id = d.d_id 
          inner join customers as cus on cus.cus_id = d.cus_id 
          where d.delete_flag != 0 AND $sort LIKE '%{$search}%'";
      $query = $this->db->query($sql); 
      $result =  $query->result();
      return $result;
  }



  public function get_part_by($search,$sort)
  {
     $sql =  "SELECT d.d_id, d.d_no,d.d_name,cus.cus_id,cus.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no 
     ,p.p_id,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
          from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          inner join part as p on p.d_id = d.d_id 
          inner join customers as cus on cus.cus_id = d.cus_id 
          where d.delete_flag != 0 AND $sort LIKE '%{$search}%'";
      $query = $this->db->query($sql); 
      $result =  $query->result();
      return $result;
  }
  

  public function hook_bom($bm)
  {
    $sql =  'SELECT * FROM bom where b_id = '.$bm.'   AND delete_flag != 0';
    $query = $this->db->query($sql); 
    if($query ){
      return $query->result(); 
    }
    else{
      return false;
    }
  }


  public function CheckPermission($para){
        
        $get_url = trim($this->router->fetch_class().'/'.$this->router->fetch_method());
        if($this->session->userdata('sug_id') == 1) {
          
        }else{
       $sqlChkPerm = "SELECT sp.name,sp.controller
        FROM
        sys_users_permissions AS sup
        INNER JOIN sys_permissions AS sp ON sp.sp_id = sup.sp_id
        LEFT JOIN sys_permission_groups AS spg ON sp.spg_id = spg.spg_id
        WHERE
        sp.enable='1' AND spg.enable='1' AND sup.su_id='{$para}' AND sp.controller='{$get_url}';";
        
        $excChkPerm = $this->db->query($sqlChkPerm);
        $numChkPerm = $excChkPerm->num_rows();
        
        if($numChkPerm == 0) {
            
            echo '<script language="javascript">';
            echo 'alert("Permission not found.");';
            echo 'history.go(-1);';
            echo '</script>';
            exit();
            
        }
        }
 

  }
  public function CheckPermissionGroup($para){
    if($this->session->userdata('sug_id') == 1) {
        
        }else{
             $get_url = trim($this->router->fetch_class().'/'.$this->router->fetch_method());
    $sqlSelPerm = "SELECT
  p.sp_id,
  p.name,
    p.controller
  FROM
  sys_users_groups_permissions AS ugp
  LEFT JOIN sys_permission_groups AS pg ON pg.spg_id = ugp.spg_id
  inner JOIN sys_permissions AS p ON p.spg_id = pg.spg_id
  WHERE pg.enable='1' AND p.enable='1' AND ugp.sug_id='$para' AND p.controller='{$get_url}';";
    $excChkPerm = $this->db->query($sqlSelPerm);
    $numChkPerm = $excChkPerm->num_rows();
    if($numChkPerm == 0) {
    
    echo '<script language="javascript">';
    echo 'alert("Permission '.$get_url.' not found.");';
    echo 'history.go(-1);';
    echo '</script>';
    exit();
    
        }
   
    }
 }

  public function getuser($user,$pass) {  
    $pass = base64_encode(trim($pass));
    $sql ="SELECT u.su_id as su_id , u.enable as u_enable ,ug.enable as sug_enable ,u.username as username,u.password as password, ug.sug_id ,u.firstname,u.lastname
    FROM sys_users as u
    inner join sys_user_groups ug on u.sug_id = ug.sug_id
    
    WHERE username='$user' and password='$pass' ";
  $query = $this->db->query($sql);  

    if($query->num_rows()!=0) {
        $result = $query->result_array();
     return $result[0];  
    }
    else{       
        return false;
    }

} 

 function insert($fname,$lname,$username,$password,$gender,$email,$sug_id)
 {

$password = base64_encode(trim($password));
  $num= $this->db->query("SELECT * FROM sys_users where username = '$username'"); 
  $chk= $num->result();

 if($chk==null){
    $sql1 ="INSERT INTO sys_users (sug_id, username, password, firstname, lastname, gender, email, enable, date_created, date_updated,delete_flag) VALUES ( '$sug_id', '$username', '$password', '$fname', '$lname', '$gender', '$email', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1' )";
  $query= $this->db->query($sql1); 
  if($query){
      return true;
  }else{
    return 3;
  }
 }
 return false;

   
 }



 function insert_bom($bm)
 {
  $sql ="INSERT INTO bom (b_master,unit,date_created,delete_flag) VALUES ($bm,'pcs',CURRENT_TIMESTAMP,1);";
    $query = $this->db->query($sql);  
    $insert_id = $this->db->insert_id($query );
   if($query){
    return  $insert_id;
   }
   else{
     return false;
   }  
 }

 function insert_sub_part($bm,$m,$p,$origin)
 {
  $sql ="INSERT INTO sub_part (b_id,m_id,p_id,origin,unit,date_created,delete_flag) VALUES ($bm,$m,$p,$origin,'pcs',CURRENT_TIMESTAMP,1);";
  $query = $this->db->query($sql);  
  $insert_id = $this->db->insert_id($query);
  if($query){
    return  $insert_id;
  }
  else{
    return false;
  }  
}


 function insert_part($p_no,$p_name,$d_id,$master )
 {

$num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
  $chk= $num->num_rows();

 if($chk < 1){
    $sql ="INSERT INTO part (p_no,p_name,d_id,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name', '$d_id'
  ,'1',CURRENT_TIMESTAMP,'1');";
  $sql1 ="INSERT INTO sub_part (m_id,p_id) VALUES ( '$master','$p_no' );";
    $query = $this->db->query($sql);  
  if($query){
    $query = $this->db->query($sql1);  
      return true;
  }
 }else{
    return false;
 }
 }

 function insert_part1($p_no,$p_name,$d_id)
 {
    $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
  $chk= $num->num_rows();

 if($chk < 1){
    $sql ="INSERT INTO part (p_no,p_name,d_id,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name','1',CURRENT_TIMESTAMP,'1');";
    $query = $this->db->query($sql);  
  if($query){
      return true;
  }
 }else{
    return false;
 }
 }

 function insert_newpart($p_no,$p_name)
 {
    $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
  $chk= $num->num_rows();

 if($chk < 1){
    $sql ="INSERT INTO part (p_no,p_name,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name','1',CURRENT_TIMESTAMP,'1');";
    $query = $this->db->query($sql);  
    $last_id = $this->db->insert_id();
  if($query){
      return $last_id;
  }else{
    return false;
 }

 }
}

 function check_newpart($p_no,$p_name)
 {
    $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
  $chk= $num->num_rows();
 if($chk < 1){
  return true;
 }else{
   return false;
 }
}


 function insert_part_drawing($p_id,$d_id)
 {
  $num= $this->db->query("SELECT * FROM part_drawing where d_id = '$d_id' AND p_id = '$p_id'"); 
  $chk= $num->num_rows();
  if($chk < 1){
    $sql ="INSERT INTO part_drawing (d_id,p_id,date_created) VALUES ( '$d_id','$p_id',CURRENT_TIMESTAMP);";
    $query = $this->db->query($sql);  
    $last_id = $this->db->insert_id();
  if($query){
      return $last_id;
  }else{
    return false;
 }
}
}

 function insert_group($gname)
 {
  $num= $this->db->query("SELECT * FROM sys_user_groups where name = '$gname'"); 
  $chk= $num->num_rows();
 if($chk!=1){
  $sql ="INSERT INTO sys_user_groups (name,enable,date_created,delete_flag) VALUES ( '$gname', '1', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return 3;
   }
  }
  return false;
 }

 function insert_drawing($d_no,$d_name, $dcn_id,$cus_id, $tf_id, $file,$c,$pos)
 {
    
  $sql ="INSERT INTO drawing (d_no,d_name,enable, dcn_id,cus_id, date_created,delete_flag,tf_id,file_name,file_code,version,pos) VALUES 
  ( '$d_no','$d_name','1', '$dcn_id','$cus_id', CURRENT_TIMESTAMP,  '1','$tf_id','$file','$c','00','$pos');";
    $query = $this->db->query($sql);  
    $last_id = $this->db->insert_id();
  if($query){
      return $last_id;
  }else{
    return false;
 }
 }
 


 function select_version($d_id)
 {
  $sql ="SELECT * FROM drawing WHERE d_id = $d_id ;";
  $query = $this->db->query($sql);
  $data = $query->result()[0];

  $d_id =  $data->d_id;
  $d_name =  $data->d_name;
  $pos =  $data->pos;
  $cus_id =  $data->cus_id;
  $tf_id =  $data->tf_id;
  $version =  $data->version;
  $file_name =  $data->file_name;
  $path_file =  $data->path_file;
  $d_no =  $data->d_no;
  $dcn_id =  $data->dcn_id;
  $file_code =  $data->file_code;
  $path_file = quotemeta($path_file);

  $gg ="INSERT INTO version (d_id,d_name, d_no, cus_id, dcn_id, enable, date_created, delete_flag,
  path_file, file_name,file_code, version,tf_id,pos) VALUES ( '$d_id','$d_name', '$d_no','$cus_id', 
  '$dcn_id', '0', CURRENT_TIMESTAMP, '1', '$path_file', '$file_name','$file_code', '$version','$tf_id','$pos');";
  $query = $this->db->query($gg); 
if($query){
     return true;
   }
   else{
     return false;
   }

 }

 function update_version($d_id,$d_name,$cus_id, $d_no, $dcn_id, $version, $file, $path_file,$c,$tf_id,$pos)
 {
  $v = $version+1;
$path_file = quotemeta($path_file);
  $sql ="UPDATE drawing SET d_no = '$d_no' ,d_name ='$d_name',cus_id = '$cus_id', date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id', version = '$v', path_file = '$path_file', file_name = '$file', file_code = '$c',enable = 1 ,tf_id = '$tf_id',pos = '$pos' WHERE d_id = '$d_id'";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }



 function save_edit_drawing($d_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c,$tf_id,$pos)
 {
$path_file = quotemeta($path_file);
  $sql ="UPDATE drawing SET d_no = '$d_no' ,d_name = '$d_name', date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id',cus_id = '$cus_id',
  path_file = '$path_file', file_name = '$file', file_code = '$c',enable = 1 ,tf_id = '$tf_id',pos = '$pos'
  WHERE d_id = '$d_id'";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }

   function save_edit_drawing_v($v_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c,$tf_id)
 {
$path_file = quotemeta($path_file);
  $sql ="UPDATE version SET d_no = '$d_no' ,d_name = '$d_name', date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id',cus_id = '$cus_id',
  path_file = '$path_file', file_name = '$file', file_code = '$c',enable = 1 ,tf_id = '$tf_id'
  WHERE v_id = '$v_id'";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }


 function insert_permission($gname, $controller, $spg_id)
 {
  $sql ="INSERT INTO sys_permissions (spg_id,name,controller,enable,date_created,delete_flag) VALUES ( '$spg_id', '$gname', '$controller', '1', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }

 function insert_permissiongroup($gname)
 {
  $sql ="INSERT INTO sys_permission_groups (name,enable,date_created,delete_flag) VALUES ( '$gname', '1', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }

 function insert_type($type_name,$fol_name)
 {
  $sql ="INSERT INTO type_file (tf_name,tf_fol,delete_flag,tf_group) VALUES ( '$type_name', '$fol_name', '1','1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }
 public function save_edit_tf($tf_id, $tf_name,$tf_fol)
  {
     $sql1 ="UPDATE type_file SET tf_name = '$tf_name',tf_fol = '$tf_fol', date_updated = CURRENT_TIMESTAMP WHERE tf_id = '$tf_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }
  public function delete_type($id) {
    $sql ="UPDATE type_file SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE tf_id = '$id'";
    $query = $this->db->query($sql);
       if ($query) { 
          return true; 
       } 
       else{
      return false;
    }
    }
 public function mobile($key){
  $query = $this->db->query("SELECT * from sys_users WHERE su_id = $key "); 
  $result = $query->result()[0];
  if( $result->mobile==0){
  $sqlEdt = "UPDATE sys_users SET mobile='1' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  }
  else{
    $sqlEdt = "UPDATE sys_users SET mobile='0' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
  }

  if ($exc_user){
    
    return TRUE;    
    
  }else{    return FALSE;   }
  
}


 public function enableUser($key){
  $query = $this->db->query("SELECT * from sys_users WHERE su_id = $key "); 
  $result = $query->result()[0];
  if( $result->enable==0){
  $sqlEdt = "UPDATE sys_users SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  }
  else{
    $sqlEdt = "UPDATE sys_users SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
  }

  if ($exc_user){
    
    return TRUE;    
    
  }else{    return FALSE;   }
  
}







 public function enableGroup($key=''){

  $sqlEdt = "UPDATE sys_user_groups SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function disableGroup($key=''){

  $sqlEdt = "UPDATE sys_user_groups SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function enablePermission($key=''){

  $sqlEdt = "UPDATE sys_permissions SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function disablePermission($key=''){

  $sqlEdt = "UPDATE sys_permissions SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function enablePermission_Group($key=''){

  $sqlEdt = "UPDATE sys_permission_groups SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE spg_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function disablePermission_Group($key=''){

  $sqlEdt = "UPDATE sys_permission_groups SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE spg_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function enableDcn($key=''){

  $sqlEdt = "UPDATE dcn SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE dcn_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function disableDcn($key=''){

  $sqlEdt = "UPDATE dcn SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE dcn_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function enableDrawing($key){
  $query = $this->db->query("SELECT * from drawing WHERE d_id = $key "); 
  $result = $query->result()[0];
  if( $result->enable==0){
  $sqlEdt = "UPDATE drawing SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  }
  else{
    $sqlEdt = "UPDATE drawing SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
  }

  if ($exc_user){
    
    return TRUE;    
    
  }else{    return FALSE;   }
  
}





public function disableDrawing($key=''){

  $sqlEdt = "UPDATE drawing SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function enableDrawing_v($key=''){

  $sqlEdt = "UPDATE version SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE v_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function disableDrawing_v($key=''){

  $sqlEdt = "UPDATE version SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE v_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function enablePart($key=''){

  $sqlEdt = "UPDATE part SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function disablePart($key=''){

  $sqlEdt = "UPDATE part SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}





 public function delete_user($id) {
   $sql ="UPDATE sys_users SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE su_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

    public function delete_group($id) {
   $sql ="UPDATE sys_user_groups SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE sug_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_permission($id) {
   $sql ="UPDATE sys_permissions SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE sp_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_permissiongroup($id) {
   $sql ="UPDATE sys_permission_groups SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE spg_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
     else{
     return false;  
   }
   }


   
   public function delete_bom($id) {
   $sql ="UPDATE bom SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE b_id = '$id'";
   $query = $this->db->query($sql);
   $query = $this->db->query("UPDATE sub_part SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE b_id = '$id'");
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }
   public function delete_sub($id) {
   $sql ="UPDATE sub_part SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE sub_id = '$id'";
   $query = $this->db->query($sql);
   if ($query) { 
    return true; 
    } 
    else{
    return false;
    }
  }
   public function update_sub_id($sub_id) {
   $sql ="UPDATE sub_part SET origin = $sub_id WHERE sub_id =$sub_id";
   $query = $this->db->query($sql);
   if ($query) { 
    return true; 
    } 
    else{
    return false;
    }
   }

   public function delete_drawing($id) {
   $sql ="UPDATE drawing SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE d_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_drawing_v($id) {
   $sql ="UPDATE version SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE v_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }


   public function delete_dcn($id) {
   $sql ="UPDATE DCN SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE dcn_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }


   public function delete_part($id) {
   $sql ="UPDATE part SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE p_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }
   public function updated_profile_data($fname,$lname,$gender,$email,$su_id)
  {
     $sql1 ="UPDATE sys_users SET 
                      firstname      = '$fname',
                      lastname       = '$lname',
                      gender         = '$gender',
                      email          = '$email',
                      enable         = '1',
                      date_updated   = CURRENT_TIMESTAMP,
                      delete_flag    = '1' 

                       WHERE su_id          = '$su_id' ";
                      

    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }
   public  function fetch_pass($session_id)
      {
        $fetch_pass=$this->db->query("SELECT * from sys_users where su_id='$session_id'");
        $res=$fetch_pass->result();
      }
   public function change_pass($session_id,$new_password)
      {
        $new_password = base64_encode(trim($new_password));
        $update_pass=$this->db->query("UPDATE sys_users set password='$new_password'  where su_id='$session_id'");
      }


public function insert_edit_part($m_id, $qty,$unit,$c_p)
  {
     $sql="UPDATE sub_part SET quantity = '$qty', unit = '$unit', common_part = '$c_p'WHERE sub_id = '$m_id'";
    $exc = $this->db->query($sql);
    if ($exc ){ return true; }else{ return false; }
  }

public function insert_edit_bom($bm, $qty,$unit,$c_p)
  {
     $sql ="UPDATE bom SET quantity = '$qty', unit = '$unit', common_part = '$c_p' WHERE b_id = '$bm'";
     $exc= $this->db->query($sql);
    if ($exc){ return true; }else{ return false; }
  }

public function save_edit_part($p_id, $p_no, $p_name,$d_id)
  {
     $sql1 ="UPDATE part SET p_no = '$p_no', p_name = '$p_name', d_id = '$d_id', date_updated = CURRENT_TIMESTAMP, delete_flag = '1' WHERE p_id = '$p_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }

  public function save_edit_partb($p_id, $p_no, $p_name,$d_id)
  {
     $sql1 ="UPDATE part SET p_no = '$p_no', p_name = '$p_name', d_id = '$d_id', date_updated = CURRENT_TIMESTAMP, delete_flag = '1' WHERE p_id = '$p_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }


 public function save_edit_p($sp_id, $spg_id, $sp_name)
  {
     $sql1 ="UPDATE sys_permissions SET name = '$sp_name', spg_id = '$spg_id', date_updated = CURRENT_TIMESTAMP WHERE sp_id = '$sp_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }

  public function save_edit_pg($spg_id, $spg_name)
  {
     $sql1 ="UPDATE sys_permission_groups SET name = '$spg_name', date_updated = CURRENT_TIMESTAMP WHERE spg_id = '$spg_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }

  public function deluserg_permission($sug_id)
  {
    $sql  =  "DELETE FROM sys_users_groups_permissions WHERE sug_id = '$sug_id'";
    $query = $this->db->query($sql); 
    if ($query) { 
      return true; 
    } 
    else{
       return false;
    } 
  }

  public function insertuserg_permission($sug_id,$spg)
  {
     $sql  = "INSERT INTO sys_users_groups_permissions(sug_id, spg_id, date_created) VALUES  ('$sug_id','$spg',CURRENT_TIMESTAMP)";
     $query = $this->db->query($sql);
    if ($query) { 
      return true; 
    } 
    else{
       return false;
    }
  }

   public function save_edit_ug($sug_id, $sug_name)
  {
     $sql1 ="UPDATE sys_user_groups SET name = '$sug_name', date_updated = CURRENT_TIMESTAMP WHERE sug_id = '$sug_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }


  public function deluser_permission($su_id)
  {
    $sql  =  "DELETE FROM sys_users_permissions WHERE su_id = $su_id";
    $query = $this->db->query($sql); 
    if ($query) { 
      return true; 
    } 
    else{
       return false;
    } 
  }

  public function insertuser_permission($su_id,$sp)
  {
     $sql  = "INSERT INTO sys_users_permissions(su_id, sp_id, date_created) VALUES  ('$su_id','$sp',CURRENT_TIMESTAMP)";
     $query = $this->db->query($sql);
    if ($query) { 
      return true; 
    } 
    else{
       return false;
    }
  }

  public function save_edit_u($su_id, $username, $password,$gender, $fname, $lname, $email, $sug_id)
  {
     $sql ="UPDATE sys_users SET sug_id = '$sug_id', username = '$username', password = '$password', firstname = '$fname', lastname = '$lname',
      gender = '$gender', email = '$email', date_updated = CURRENT_TIMESTAMP WHERE su_id = '$su_id'";
    $exc_user = $this->db->query($sql);
    if ($exc_user ){ return true; }else{ return false; }
  }


  public function insert_dcn($dcn_no,$path,$file,$code,$tf_id)
  {
    $path = quotemeta($path);
    $num= $this->db->query("SELECT * FROM dcn where dcn_no = '$dcn_no'"); 
  $chk= $num->num_rows();

 if($chk < 1){
    $sql  = "INSERT INTO dcn (dcn_no, date_created, delete_flag, enable, path_file, file_name, file_code,tf_id) VALUES  
    ('$dcn_no', CURRENT_TIMESTAMP, '1', '1','$path','$file','$code','$tf_id')";
  $query= $this->db->query($sql); 
  if($query){
      return true;
  }
 }else{
    return false;
 }

  }


  public function save_dcn($dcn_id,$dcn_no,$path_file,$file_name)
  {
     $sql ="UPDATE dcn SET dcn_no = '$dcn_no', path_file = '$path_file', file_name = '$file_name', date_updated = CURRENT_TIMESTAMP WHERE dcn_id = '$dcn_id'";
    $exc_user = $this->db->query($sql);
    if ($exc_user ){ 
      return true; 
    }else{ 
      return false; 
    }
  }

    public function download_record($su_id,$su_name,$data)
  {
    $sql  = "INSERT INTO `download_record`(`su_id`, `su_name`, `content`, `date_download`) 
    VALUES ('$su_id','$su_name','$data',CURRENT_TIMESTAMP)";
  $query= $this->db->query($sql); 
  if($query){
      return true;
  }else{
    return false;
 }
 }

 public function opencsv($id)
  { 
    if($this->session->userdata('sug_id')=="1"){
        return true;
    }else{
        $sql =  "SELECT * FROM sys_users_permissions 
    where su_id = '$id' AND sp_id = 69 ";
    $query = $this->db->query($sql); 
    $result= $query->result();
    if($result != null){
      return true;
    }else{
      return false;
    }
 }

  }

  public function issue_by_id($id)
{
        $sql ="SELECT d.file_code,tf.tf_fol  FROM drawing as d
        left join type_file as tf on tf.tf_id = d.tf_id
        WHERE d_id='$id' AND delete_flag != 0  ";
          $query = $this->db->query($sql);  
         $data = $query->result(); 
         return $data;

}

public function issue_by_vid($id)
{
        $sql ="SELECT v.file_code,tf.tf_fol  FROM version as v
        left join type_file as tf on tf.tf_id = v.tf_id
        WHERE v.v_id='$id' AND v.delete_flag != 0  ";
          $query = $this->db->query($sql);  
         $data = $query->result(); 
         return $data;

}

 public function insert_cus($cusname,$cusdes)
 {
  $num= $this->db->query("SELECT * FROM customers where cus_name = '$cusname'"); 
  $chk= $num->num_rows();
 if($chk!=1){
  $sql ="INSERT INTO customers (cus_name,cus_des,date_created,delete_flag) VALUES ( '$cusname', '$cusdes', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return 3;
   }
  }
  return false;
 }

public function save_edit_cus($cus_id, $cus_name,$cus_des)
  {
     $sql1 ="UPDATE customers SET cus_name = '$cus_name',cus_des = '$cus_des', date_updated = CURRENT_TIMESTAMP WHERE cus_id = '$cus_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }

public function delete_cus($id) {
   $sql ="UPDATE customers SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE cus_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }


// public function drawing_search($s_dno,$s_name,$s_pno)
//   {
// if($s_dno !=0){
//     $s_dno =  implode('|',(array)$s_dno);
//   }
// if($s_name !=0){
//     $s_name =  implode('|',(array)$s_name);
//   }
// if($s_pno !=0){
//     $s_pno =  implode('|',(array)$s_pno);
//   }
//       $sql =  "SELECT pd.d_id,pd.p_id , d.d_no,d.d_name,c.cus_id,c.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no ,pd.p_id,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
//       from part_drawing as pd
//         left join drawing as d on d.d_id = pd.d_id
//         left join customers as c on c.cus_id = d.cus_id
//         left join dcn as dc on dc.dcn_id = d.dcn_id
//         left join part as p on p.p_id = pd.p_id
// where d.delete_flag != 0 AND d.d_no RLIKE '$s_dno' OR d.d_name RLIKE '$s_name' OR p.p_no RLIKE '$s_pno'";
//       $query = $this->db->query($sql); 
//       $result =  $query->result();

//       return $result;
//   }

public function drawing_search($s_dno,$s_name,$s_pno,$type)
  {
if($s_dno !=0){
    $s_dno =  implode('|',(array)$s_dno);
  }
if($s_name !=0){
    $s_name =  implode('|',(array)$s_name);
  }
if($s_pno !=0){
    $s_pno =  implode('|',(array)$s_pno);
  }
if($type !=0){
    $type =  implode('|',(array)$type);
  }
      $sql =  "SELECT d.d_id,p.p_id,pd.p_id as pd_pid,pd.d_id as pd_did,d.d_no,d.d_name,c.cus_id,c.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
      from drawing as d
        left join part_drawing as pd on pd.d_id = d.d_id
        left join customers as c on c.cus_id = d.cus_id
        left join dcn as dc on dc.dcn_id = d.dcn_id
        left join part as p on p.p_id = pd.p_id
where d.delete_flag != 0 AND d.d_no RLIKE '$s_dno' OR d.d_name RLIKE '$s_name' OR p.p_no RLIKE '$s_pno' OR d.tf_id = '$type'";
      $query = $this->db->query($sql); 
      $result =  $query->result();

      return $result;
  }

  public function button_show($id,$pg_id)        
  {
  $query= $this->db->query(" SELECT * FROM `sys_permissions` sp inner join sys_users_permissions sup on sup.sp_id = sp.sp_id where su_id = $id and sp.spg_id =$pg_id"); 
            $data = $query->result(); 
            foreach ($data as $r ) {
                  $this->session->set_flashdata($r->button,'');
            }

  }
  public function link_to_dcn($id)        
  {
            $query= $this->db->query(" SELECT * FROM `sys_permissions` sp inner join sys_users_permissions sup on sup.sp_id = sp.sp_id where su_id = $id and sp.controller = 'dcn/manage'"); 
            $data = $query->result(); 
            if(!$data){
            }
            else{
              $this->session->set_flashdata($data[0]->button,'');
            }

  }

  public function get_tfid($d_id)
  { 
    $sql =  "SELECT tf_id FROM drawing where d_id = '$d_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->tf_id;
      
  }

  public function checkfolder($tf_id)
  { 
    $sql =  "SELECT tf_fol FROM type_file where tf_id = '$tf_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->tf_fol;
      
  }

    public function get_filecode($d_id)
  { 
    $sql =  "SELECT file_code FROM drawing where d_id = '$d_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->file_code;
      
  }

      public function get_file($d_id)
  { 
    $sql =  "SELECT file_name FROM drawing where d_id = '$d_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->file_name;
      
  }

  public function del_img($id)
  {
   $sql ="DELETE FROM part_drawing WHERE pd_id = '$id'";
     $query = $this->db->query($sql);  
    if($query){
      return true;
    }
    else{
      return false;
    }
  }

  public function bom($bm)
  {
    $array=[];
    $res_bom= $this->model->hook_bom($bm) ;
    $data= $this->model->sub_bom($res_bom[0]->b_master,$res_bom[0]->b_id) ;
    $bm =  $res_bom[0]->b_id;
    if($data != false){  
        $m_id =$data[0]->p_id;
        foreach($data as $r){
            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
            $a=array('lv'=>2,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
            array_push($array,$a);
            if($data != false){  
                foreach($data as $r){
                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                    $a=array('lv'=>3,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                    
                    array_push($array,$a);
                    if($data != false){  
            
                        foreach($data as $r){

                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                            $a=array('lv'=>4,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                            
                            array_push($array,$a);
                            if($data != false){  
                    
                                foreach($data as $r){

                                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                    $a=array('lv'=>5,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                    
                                    array_push($array,$a);
                                    if($data != false){  
                            
                                        foreach($data as $r){

                                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                            $a=array('lv'=>6,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                            
                                            array_push($array,$a);
                                            if($data != false){  
                                    
                                                foreach($data as $r){

                                                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                    $a=array('lv'=>7,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                    
                                                    array_push($array,$a);
                                                    if($data != false){  
                                            
                                                        foreach($data as $r){

                                                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                            $a=array('lv'=>8,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                            
                                                            array_push($array,$a);
                                                            if($data != false){                                                             
                                                                foreach($data as $r){

                                                                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                                    $a=array('lv'=>9,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                                    
                                                                    array_push($array,$a);
                                                                    if($data != false){                                                             
                                                                        foreach($data as $r){
   
                                                                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                                            $a=array('lv'=>10,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                                            
                                                                            array_push($array,$a);
                                                                        }
                                                                    }
                                                               }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
     }
    }
    return  $array;
  }

  public function filter($sub_id,$bm)
  {
    $sql =  'SELECT * FROM sub_part where sub_id = '.$sub_id.'  AND delete_flag != 0';
    $query = $this->db->query($sql); 
    $res= $query->result();
    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_part.p_id = '.$res[0]->m_id.' AND b_id = '.$bm.'  AND sub_part.delete_flag != 0'); 
    $data= $query->result();
    $array=[];
    foreach($data as $r){
        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
        array_push($array,$a);
        foreach($data as $r){

            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
            $data= $query->result();
            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
            array_push($array,$a);
            foreach($data as $r){

                $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                $data= $query->result();
                $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                array_push($array,$a);
                foreach($data as $r){
    
                    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                    $data= $query->result();
                    $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                    array_push($array,$a);
                    foreach($data as $r){
                        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                        $data= $query->result();
                        $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                        array_push($array,$a);
                        foreach($data as $r){
                            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                            $data= $query->result();
                            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                            array_push($array,$a);
                        
                        foreach($data as $r){
                            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                            $data= $query->result();
                            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                            array_push($array,$a);
                        
                        foreach($data as $r){
                            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                            $data= $query->result();
                            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                            array_push($array,$a);
                        
                        foreach($data as $r){
                            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                            $data= $query->result();
                            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                            array_push($array,$a);
                        
                        foreach($data as $r){
                            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                            $data= $query->result();
                            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                            array_push($array,$a);
                                  }
                                }
                             }
                           }
                        }
                    }
                }
            }
        }
    }
    return $array;
  }
  public function tree_down($sub_id,$bm)
  {
    $array=[];
    $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_id = '.$sub_id.' AND  b_id = '.$bm.' AND sub_part.delete_flag != 0';
    $query = $this->db->query($sql); 
    $res= $query->result();
   
    foreach($res as $r ){

    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_part.p_id = '.$r->p_id.' AND b_id = '.$bm.'  AND sub_part.delete_flag != 0'); 
    $data= $query->result();

    foreach($data as $r){
 
        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
        array_push($array,$a);
        foreach($data as $r){

          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
          $data= $query->result();
          $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
          array_push($array,$a);
          foreach($data as $r){
  
            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
            $data= $query->result();
            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
            array_push($array,$a);
            foreach($data as $r){
    
              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
              $data= $query->result();
              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
              array_push($array,$a);
              foreach($data as $r){
                $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                $data= $query->result();
                $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                array_push($array,$a);
                foreach($data as $r){
                  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                  $data= $query->result();
                  $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                  array_push($array,$a);
                  foreach($data as $r){
                    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                    $data= $query->result();
                    $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                    array_push($array,$a);
                    foreach($data as $r){
                      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                      $data= $query->result();
                      $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                      array_push($array,$a);
               
                    }
                  }
                }
              }
            }
          }
        }
    }

  }


    return $array;
   
  }
  public function tree_up($sub_id,$bm)
  {
    $array=[];
    $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_id = '.$sub_id.' AND  b_id = '.$bm.' AND sub_part.delete_flag != 0';
    $query = $this->db->query($sql); 
    $res= $query->result();
   
    foreach($res as $r ){

    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_part.p_id = '.$r->p_id.' AND b_id = '.$bm.'  AND sub_part.delete_flag != 0 '); 
    $data= $query->result();
    foreach($data as $r){

        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
        array_push($array,$a);
        foreach($data as $r){

          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
          $data= $query->result();
          $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
          array_push($array,$a);
          foreach($data as $r){
  
            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
            $data= $query->result();
            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
            array_push($array,$a);
            foreach($data as $r){
    
              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
              $data= $query->result();
              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
              array_push($array,$a);
              foreach($data as $r){
                $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                $data= $query->result();
                $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                array_push($array,$a);
                foreach($data as $r){
                  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                  $data= $query->result();
                  $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                  array_push($array,$a);
                  foreach($data as $r){
                    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                    $data= $query->result();
                    $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                    array_push($array,$a);
                    foreach($data as $r){
                      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                      $data= $query->result();
                      $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                      array_push($array,$a);
               
                    }
                  }
                }
              }
            }
          }
        }
    }

  }
    return $array;
   
  }
  
}

?>