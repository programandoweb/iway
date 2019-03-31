<?php

defined('BASEPATH') OR exit('No direct script access allowed');


  function menu($rol_id=NULL){
    $ci   =&  get_instance();
    $tabla            = "sys_roles";
    $ci->db->select("*")->from($tabla);
    if(!empty($rol_id)){
      $ci->db->where("rol_id",$rol_id);
    }
    $roles            = $ci->roles          = $ci->db->get()->row();
    $menu_search        = json_decode(@$roles->json);
    $menu_edit          = json_decode($roles->json_edit);
    if(is_array($menu_search)&& is_array($menu_edit)){
      $in             = array_merge($menu_search,$menu_edit);
    }else if(is_array($menu_search)&& !is_array($menu_edit)){
      $in             = $menu_search;
    }else if(!is_array($menu_search)&& is_array($menu_edit)){
      $in             = $menu_edit;
    }else{
      $in             = array();
    }
    $tabla            = "sys_roles_modulos";
    $roles_modulos_padre  = $ci->db->select("*")->from($tabla)->where('modulo_padre',0)->order_by('order','ASC')->get()->result();
    $roles_modulos_hijos  = array();
    $roles_modulos_nietos = array();
    foreach($roles_modulos_padre as $k =>$v){
      $hijos                  = $ci->db->select("*")->from($tabla)->where('modulo_padre',$v->id)->order_by('order','ASC')->get()->result();
      $roles_modulos_hijos[$v->id][]  = $hijos;
      foreach($hijos as $k2 => $v2){
        $roles_modulos_nietos[$v2->id]  = $ci->db->select("*")->from($tabla)->where('modulo_padre',$v2->id)->order_by('order','ASC')->get()->result();
      }
    }
    return array( "roles_modulos_padre" =>  $roles_modulos_padre,
            "roles_modulos_hijos" =>  $roles_modulos_hijos,
            "roles_modulos_nietos"  =>  $roles_modulos_nietos,
            "roles_modulos_permitidos"  =>  $in,
            "modulo_search"       =>  $menu_search,
            "modulo_edit"       =>  $menu_edit);
  }

  function set_template_mail($var=array()){
    $ci   =&  get_instance();
    $view = PATH_VIEW.'/Template/Emails/'.$var['view'].'.php';
    if(file_exists($view)){
      return $ci->load->view('Template/Emails/'.$var['view'],$var['data'],TRUE);
    }else{
      return false;
    }
  }

  function insert_links($id){
    $ci   =&  get_instance();
    $tabla  = "op_links";
    $row  = $ci->db->select("contador")->from($tabla)
                          ->where('user_id',$ci->user->user_id)
                          ->where('id_link',$id["id"])
                          ->get()
                          ->row();
    if(empty($row)){
      $contador = 1;
      $ci->db->insert($tabla,array("id_link"=>$id["id"],"contador"=>$contador,"user_id"=>$ci->user->user_id));
    }else{
      $contador = $row->contador + 1 ;
      $ci->db->where('user_id',$ci->user->user_id);
      $ci->db->where('id_link',$id["id"]);
      $ci->db->update($tabla,array("contador"=>$contador));
    }
    $links = get_links();
    return $links;
  }

  function get_links(){
    $ci   =&  get_instance();
    $tabla  = "op_links t1";
    $rows  = $ci->db->select("t1.id_link,t1.contador,t2.modulo,t2.url")->from($tabla)
                          ->join("sys_roles_modulos t2","t1.id_link = t2.id","left")
                          ->where('user_id',$ci->user->user_id)
                          ->order_by("t1.contador","DESC")
                          ->get()
                          ->result();
    return $rows;
  }

  function user_x_token($token){
    $ci   =&  get_instance();
    $tabla            = "usuarios";
    return $ci->db->select("*")->from($tabla)->where("token",$token)->get()->row();
  }

  function MakeRoles($name,$estado=null,$extra=array(),$ids= null){
    $ci   =&  get_instance();
    $tabla            = "sys_roles";
    $ci->db->select("*")->from($tabla);
    $ci->db->where("estado",1);
    ///$ci->db->where_in("rol_id",12);
    if(!empty($ids)){
      $ci->db->where_in("rol_id",$ids);
    }
    $ci->db->where("empresa_id",$ci->user->empresa_id);
    $ci->db->order_by('rol','ASC');
    $options    = $ci->db->get()->result();
    $option     =   array(""=>"Seleccione");
    foreach($options as $v){
      $option[$v->rol_id]   =   $v->rol;
    }
    return form_dropdown($name, $option, $estado,$extra);
  }



 function MakeTipoIdentidad($name,$estado=null,$extra=array(),$ids= null){
  $ci   =&  get_instance();
  $tabla            = "sys_tipo_identidad";
  $ci->db->select("*")->from($tabla);
  $options    = $ci->db->get()->result();
  $option     =   array(""=>"Seleccione");
  foreach($options as $v){
    $option[$v->id]   =   $v->tipo_identidad;
  }
  //pre($option); return;
  return form_dropdown($name, $option, $estado,$extra);
}

  function set_input_hidden($name,$id='',$row,$format = false){
    if($id==''){
      $id = $name;
    }
    $data = array(
        'type'  =>  'hidden',
        'name'  =>  $name,
        'id'    =>  $id
    );
    if(is_object($row)){
      if(isset($row->$name)){
        if($format){
          $data['value']  = format($row->$name,true);
        }else{
          $data['value']  = $row->$name;
        }
      }
    }else{
      if($format){
        $data['value']  = format($row,true);
      }else{
        $data['value']  = $row;
      }
    }
    echo form_input($data);
  }

  function set_input($name,$row,$placeholder='',$require=false,$class='',$extra=NULL,$format=false,$id_por_defecto=true){
    $data = array(
      'type'      =>  'text',
      'name'      =>  $name,
      'placeholder'   =>  $placeholder,
      'class'     =>  'form-control '.$class
    );

    if($id_por_defecto){
      $data['id'] = $name;
    }
    if(is_array($extra)){
      foreach($extra as $k => $v){
        $data[$k] = @$v;
      }
    }
    //pre($data);
    if($require){
      $data['require']= $require;
    }
    if(is_array($row)){
      if($format){
        $data['value']  = format(@$row[$name],true);
      }else{
        $data['value']  = @$row[$name];
      }
    }else if(is_object($row)){
      if($format){
        $data['value']  = format(@$row->$name,true);
      }else{
        $data['value']  = @$row->$name;
      }
    }else{
      if($format){
        $data['value']  = format(@$row,true);
      }else{
        $data['value']  = @$row;
      }
    }
    echo form_input($data);
  }

  /*function get_dinamic_data($name){
    $ci = get_instance();
    pre($ci->db->field_data("usuarios"));
    if($ci->db->table_exists("sys_estado_civil")){
      echo "Si funciona";
    }else{
      echo "No funciona";
    }; return;
    foreach( $query()  as  $field )
    {
            echo  $field ;
    }
    if($ci->db->table_exists('sys_estado_civil')){
      echo "Existe";
    }else{
      echo "No existe";
    }
  }*/

  function MakeSelect($name,$estado,$extra = array("class"=>"form-control"),$data,$key = false){
    $options = array();
    if(!empty($data)){
      if(is_array($data)){
        foreach ($data as $k => $v){
          if($key){
            $options[$v] = $v;
          }else{
            $options[$k] = $v;
          }
        }
      }
    }
    return form_dropdown($name, $options, $estado,$extra);
  }

  function MakeSiNo($name,$estado=null,$extra=array()){
    $options = array(
      ""     => "Seleccione",
       1       => 'Si',
       0       => 'No',

    );
    return form_dropdown($name, $options, $estado,$extra);
  }

  function MakeDivisa($name,$estado=null,$extra=array()){
    $options = array(
      ""     => "Seleccione",
      'COP'       => 'COP',
      'USD'       => 'USD',
      'EUR'       =>'EUR'

    );
    return form_dropdown($name, $options, $estado,$extra);
  }

  function menu_usuarios($rol_id=NULL,$id_empresa = NULL){
    $ci   =&  get_instance();
    $tabla            = "sys_roles t1";
    $ci->db->select("*")->from($tabla);
    //$ci->db->join("opciones_roles t2", 't1.id=t2.rol_id', 'left');
    if(!empty($rol_id)){
      $ci->db->where("rol_id",$rol_id);
     // $ci->db->where("t2.empresa_id",$id_empresa);
    }
    $roles              = $ci->roles          = $ci->db->get()->row();
    $menu_search        = json_decode($roles->json);
    $menu_edit          = json_decode($roles->json_edit);
    //print_r($menu_edit);return false;
    if(is_array($menu_search)&& is_array($menu_edit)){
      $in             = array_merge($menu_search,$menu_edit);
    }else if(is_array($menu_search)&& !is_array($menu_edit)){
      $in             = $menu_search;
    }else if(!is_array($menu_search)&& is_array($menu_edit)){
      $in             = $menu_edit;
    }else{
      $in             = array();
    }

    $tabla            = "sys_roles_modulos";
    $roles_modulos_padre  = $ci->db->select("*")->from($tabla)->where('modulo_padre',0)->order_by('order','ASC')->get()->result();
    $roles_modulos_hijos  = array();
    $roles_modulos_nietos = array();
    foreach($roles_modulos_padre as $k =>$v){
      $hijos                  = $ci->db->select("*")->from($tabla)->where('modulo_padre',$v->id)->get()->result();
      $roles_modulos_hijos[$v->id][]      = $hijos;
      foreach($hijos as $k2 => $v2){
        $roles_modulos_nietos[$v2->id]    = $ci->db->select("*")->from($tabla)->where('modulo_padre',$v2->id)->get()->result();
      }
    }
    return array( "roles_modulos_padre"   =>  $roles_modulos_padre,
            "roles_modulos_hijos"   =>  $roles_modulos_hijos,
            "roles_modulos_nietos"    =>  $roles_modulos_nietos,
            "roles_modulos_permitidos"  =>  $in,
            "modulo_search"       =>  $menu_search,
            "modulo_edit"       =>  $menu_edit);
  }

  function listados($view){
    $ci   =&  get_instance();
    $ci->load->view('Template/Header');
    $ci->load->view('Template/Flash');
    if($ci->uri->segment(1) == "Apanel"){
      $ci->load->view('Template/Apanel/Menu');
    }
    $ci->load->view('Template/Breadcrumb');
    $ci->load->view('Template/'.$view);
    $ci->load->view('Template/Footer');
  }

  function cpanel($domain=false){
    include(PATH_APP.'third_party/xmlapi-php-master/xmlapi.php');
    $cpanelusr  =   'dpatinoz';
    $cpanelpass =   'Andres2018..';
    $xmlapi   =   new xmlapi('p3plvcpnl29130.prod.phx3.secureserver.net');
    $xmlapi->set_port( 2083 );
    $xmlapi->password_auth($cpanelusr,$cpanelpass);
    $xmlapi->set_output('json');
    $xmlapi->set_debug(1);

    $get_domain_list  =   $xmlapi->api2_query(
      @cP_user, 'DomainLookup', 'getbasedomains'       //--> todos los dominios
    );
    $domains  = json_decode($get_domain_list)->cpanelresult->data;
    if($domain){
      return $domains;
    }
    $return   = array();
    foreach($domains as $v){
      $get_email_list   =   $xmlapi->api2_query(
        @cP_user, 'Email', 'listpopswithdisk',
        array( 'domain' => $v->domain )
      );
      foreach(json_decode($get_email_list)->cpanelresult->data as $v2){
        //$return[$v->domain][] =   $v2;
        $return[]=$v2;
      }
    }
    return $return;
  }

  function object_to_array($json){
    $array_dominios   = array();
    foreach($json as $k => $v){
      $array_dominios[$v->domain] = $v->domain;
    }
    return $array_dominios;
  }

  function expedicion($row,$name,$placeholder='',$require=false){
    if(empty($row)){
      $row=new stdClass();
      $row->$name='';
    }
    $ci   =&  get_instance();
    $tabla  = "sys_municipios";
    $rows = $ci->db->select("*")->from($tabla)->get()->result();
    if(is_object($row)){
      $row = $row->$name;
    }
    if(!empty($row)){
      $ci   =&  get_instance();
      $tabla  = "sys_municipios";
      $rowid = $ci->db->select("*")->from($tabla)->where('id',$row)->get()->row();
    }

    $html = '';
    //  $rowid = $ci->db->select("*")->from($tabla)->where('id',$row)->get()->row();
    $html .=  '<input type="text" class="form-control" id="'.$name.'" placeholder="'.$placeholder.'" maxlength="150"  value="'.@$rowid->union.'"';
    $html .=  ($require)? 'require="require"':'""';
    $html .=  '/>';
    $html	.=	'<input type="hidden" name="'.$name.'" id="content'.$name.'" require="require"  value="'.@$row.'" />';
    $html .=  ' <script>
              $(function(){
                var projects = [';
                  foreach($rows as $k => $v){
                    $html .=  '{
                            value: "'.$v->id.'",
                            label: "'.$v->union.'"

                          },';
                  }

    $html .=  '     ];


               $( "#'.$name.'" ).autocomplete({
                  minLength: 0,
                  source: projects,
                  change: function (event, ui){
                    if (ui.item===null) {
                      this.value = "";
                      $("#text-alert").text("Por favor seleccione una ciudad válida del listado")
                      $("#myModal").modal("show");

                    }
                  },
                  focus: function( event, ui ) {
                    $("#content'.$name.'" ).val( ui.item.value );
                    $( "#'.$name.'" ).val( ui.item.label );
                    return false;
                  },
									select: function( event, ui ) {

										$("#content'.$name.'" ).val( ui.item.value );
										$( "#'.$name.'" ).val( ui.item.label );
										return false;
									}
                });
              });

              $( "#'.$name.'" ).autocomplete();
            </script>
          ';
    return $html;
  }

  function tiempo_session($user){
    $ci           =&  get_instance();
    $session        = $ci->db->select('*')->from("sys_session")->where('user_id',$user->user_id)->get()->row();
    $fechaGuardada      =   $session->fecha;
    $ahora          =   date("Y-m-d H:i:s");
    $tiempo_transcurrido  =   (strtotime($ahora)-strtotime($fechaGuardada));
    $user->session_id   = $session->session_id;
    if($tiempo_transcurrido>=3600){
      destruye_session($user);
      return ini_session($user);
    }else{
      return false;
    }
  }

  function reactivar_session($session){
    $ci = get_instance();
    pre($ci->user); return;
  }

function TaskBar($items=array()){
  $ci=&get_instance();
  $iconos = array();
  $iconos['title']      = new stdClass();
  $iconos['title']->url   = current_url();
  $iconos['title']->icono   = (isset($items['name']['icono']))?$items['name']['icono']:'<i class="fas fa-angle-right"></i>';
  $iconos['title']->title   = '';

  $title  = '';
  if(isset($items['name'])){
    if(is_array($items['name'])){
      if(isset($items['name']['title']) && isset($items['name']['url'])){
        $title  .=  $iconos['title']->icono.' '.$items['name']['title'];
      }else{
        $title  .=  $iconos['title']->icono.' '.$items['name']['title'];
      }
      unset($items['name']);
    }
  }

  $iconos['back']       = new stdClass();
  if($ci->agent->referrer() && @$items['back']==TRUE){
    $iconos['back']->url  = $ci->agent->referrer();
  }else{
    $iconos['back']->url  = "ocultar";
  }
  $iconos['back']->icono    = '<i class="fas fa-chevron-circle-left"></i>';
  $iconos['back']->title    = 'Volver Atrás';

  $iconos['impresion']      = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['impresion']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/print';
  }else{
    $iconos['impresion']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/print';
  }

  $iconos['impresion']->icono   = '<i class="fas fa-print"></i>';
  $iconos['impresion']->title   = 'Imprimir Documento';

  $iconos['import']       = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['import']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/import';
  }else{
    $iconos['import']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/import';
  }
  $iconos['import']->icono    = '<i class="fas fa-upload"></i>';
  $iconos['import']->title    = 'Importar Documento';

  $iconos['check']        = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['check']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/check';
  }else{
    $iconos['check']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/check';
  }
  $iconos['check']->icono   = '<i class="fas fa-check"></i>';
  $iconos['check']->title   = 'Verificar Documento';

  $iconos['config']       = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['config']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/config';
  }else{
    $iconos['config']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/config';
  }
  if(empty($items['config']['icono'])){
    $iconos['config']->icono    = '<i class="fas fa-check"></i>';
  }else{
    $iconos['config']->icono    = $items['config']['icono'];
  }
  $iconos['config']->title    = 'Configuración';
  $iconos['config']->size     = 'modal-lg';
  $iconos['config']->height   = 450;

  $iconos['inbox']        = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['inbox']->url   = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/recibir';
  }else{
    $iconos['inbox']->url   = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/recibir';
  }
  $iconos['inbox']->icono   = '<i class="fas fa-inbox"></i>';
  $iconos['inbox']->title   = 'Recibir Pagos';

  $iconos['anular']     = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['anular']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/anular';
  }else{
    $iconos['anular']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/anular';
  }
  $iconos['anular']->icono  = '<i class="fas fa-ban"></i>';
  $iconos['anular']->title  = 'Anular Pagos';

  $iconos['pago']     = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['pago']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/pago';
  }else{
    $iconos['pago']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/pago';
  }
  $iconos['pago']->icono  = '<i class="fas fa-dollar"></i>';
  $iconos['pago']->title  = 'Pagar';

  $iconos['pdf']        = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['pdf']->url   = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/PDF';
  }else{
    $iconos['pdf']->url   = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/PDF';
  }
  $iconos['pdf']->icono   = '<i class="fas fa-file-pdf"></i>';
  $iconos['pdf']->title   = 'Documento en PDF';

  $iconos['excel']        = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['excel']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/excel';
  }else{
    $iconos['excel']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/excel';
  }
  $iconos['excel']->icono   = '<i class="fa fa-file-excel" aria-hidden="true"></i>';
  $iconos['excel']->title   = 'Descargar Excel';

  $iconos['mail']       = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['mail']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/mail';
  }else{
    $iconos['mail']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/mail';
  }
  $iconos['mail']->icono    = '<i class="far fa-envelope"></i>';
  $iconos['mail']->title    = 'Enviar por Email';

  $iconos['pageleft']     = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    if($ci->uri->segment(3)>1){
      $left           = $ci->uri->segment(3)- 1;
      $iconos['pageleft']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$left.'/'.$ci->uri->segment(4);
      $iconos['pageleft']->icono  = '<i class="fas fa-caret-square-left"></i>';
      $iconos['pageleft']->title  = 'Documento anterior';

    }else{
      $iconos['pageleft']->url  = "ocultar";
      $iconos['pageleft']->icono  = '<i class="fas fa-caret-square-left"></i>';
      $iconos['pageleft']->title  = 'Documento anterior';
    }
  }else{
    $iconos['pageleft']->url  = $ci->uri->segment(1).'/'.$ci->uri->segment(2);
  }


  $iconos['pageright']      = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $right  = $ci->uri->segment(3)+1;
    $iconos['pageright']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$right.'/'.$ci->uri->segment(4);
  }else{
    $iconos['pageright']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2);
  }
  $iconos['pageright']->icono = '<i class="fas fa-caret-square-right"></i>';
  $iconos['pageright']->title = 'Documento siguiente';

  $iconos['add']        = new stdClass();
  if(is_numeric($ci->uri->segment(3))){
    $iconos['add']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/add';
  }else{
    $iconos['add']->url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/add';
  }
  $iconos['add']->icono   = '<i class="fa fa-plus"></i>';
  $iconos['add']->title   = 'Agregar Documento';
      $return           = '<div class="row filters">';
      $return           .=  '<div class="col-md-12">';
        $return           .=  '<nav id="submenu" class="navbar navbar-toggleable-md navbar-light bg-faded nav-short p-2">';
          $return           .=  '<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">';
            $return           .=  '<span class="navbar-toggler-icon"></span>';
          $return           .=  '</button>';
          $return           .=  '<a class="navbar-brand">';
            $return           .=  '<h4 class="font-weight-700 text-uppercase orange ">';
              $return           .=  $title;
            $return           .=  '</h4>';
          $return           .=  '</a>';
          $return           .=  '<div class="collapse navbar-collapse" id="navbarNavDropdown">';
            $return           .=  '<div class="btn-group  ml-auto" role="group" aria-label="Small button group">';
              foreach($items as $k => $v){
                if(is_array($v) && $v){
                  if(isset($v['title'])){
                    $title_link = $v['title'];
                  }else{
                    $title_link = $iconos[$k]->title;
                  }
                  if(isset($v['url'])){
                    $url_link = $v['url'];
                  }else{
                    $url_link = $iconos[$k]->url;
                  }
                  if(isset($v['lightbox'])){
                    $atributos  = 'class="nav-link lightbox '.$k.' " data-type="iframe"';
                  }else if(isset($v['confirm'])){
                    $atributos  = 'class="nav-link confirm" confirm="true" data-title="Deseas anular esta factura?"  data-message="Para continuar pulsa aceptar."';
                  }else if(isset($v['popup'])){
                    $atributos  = 'class="nav-link popup" popup="true" data-title="Popup"';
                  }else{
                    $atributos  = 'class="nav-link '.$k.'"';
                  }
                  if(isset($v['atributo'])){
                    $atributos  = 'class="nav-link" '.$v['atributo'];
                  }
                  if(isset($v['target'])){
                    $atributos  .=  'class="nav-link " target="_blank"';
                  }
                  if(isset($v['id'])){
                    $atributos  .=  'id="'.$v['id'].'"';
                    $contenedor  =  '<div id="Opciones_excel" style="display:none;">
                              <form action="'.current_url().'/mail" method="post">
                                <table width="100%">
                                  <tr>
                                    <td>
                                      <input id="email" type="email" name="email" placeholder="correo electronico" class="form-control" required="1" />
                                    </td>
                                    <td style="text-align: right;">
                                    <button id="enviar" class="btn btn-primary" type="button" disabled>Enviar</button>
                                    </td>
                                  </tr>
                                </table>
                              </form>
                            </div>';
                  }
                  if(isset($v['size'])){
                    $atributos  .=  ' data-size="'.$v['size'].'" ';
                  }
                  if(isset($v['size'])){
                    $atributos  .=  ' data-height="'.$v['height'].'" ';
                  }
                  $return           .=  '<a '.$atributos.' title="'.$title_link.'" href="'.$url_link.'" >';
                    if(isset($v['icono'])){
                      $return           .=  $v['icono'];
                    }else{
                      $return           .=  $iconos[$k]->icono;
                    }
                  $return           .=  '</a>';
                }else{
                  if($iconos[$k]->title=='Imprimir Documento'){
                    $atributos  = 'class="nav-link "';
                  }else if($iconos[$k]->title=='Documento en PDF'){
                    $atributos  = 'class="nav-link " target="_blank" ';
                  }else{
                    if($v==='lightbox'){
                      $atributos  = 'class="nav-link lightbox '.$k.'" data-type="iframe"';
                    }else{
                      $atributos  = 'class="nav-link '.$k.'"';
                    }
                  }
                  if($iconos[$k]->url!='ocultar'){
                    $return           .=  '<a '.$atributos.' class="'.$k.'" title="'.$iconos[$k]->title.'" href="'.$iconos[$k]->url.'" >';
                      $return           .=  $iconos[$k]->icono;
                    $return           .=  '</a>';
                  }
                }
              }
            $return           .=  '</div>';
          $return           .=  '</div>';
        $return           .=  '</nav>';
      $return           .=  '</div>';
    $return           .=  '</div>';
  $return           .=  @$contenedor;
  if(isset($items['config']['atributo'])){
    $row        =   get_NotificacionEmail(base_url("Utilidades/CorreoNotificacion/SolicitudPlataformas"));
    $hidden     =   array("Modulo"=>$ci->uri->segment(1));
  $return .= '<div class="modal fade" id="OpcionesEmail">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Configuración envio email</h4>
                    <button type="button" class="close cerrar" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="form">
                    <form action="'.base_url('Utilidades/ConfigEmail').'" method="post" accept-charset="utf-8">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="container">
                        <div class="form-group">
                          <div class="input-group mt-3">
                            <div class="row col-md-12">
                                <input type="email" id="correos_notificacion" class="form-control" placeholder="Email" >
                                <div id="submit" class="btn btn-primary ml-4" style="cursor:pointer">Agregar</div>
                                <div class="alert alert-danger col-md-12 mt-2" id="message" role="alert" style="display:none;">
                              </div>
                              <div class="col-md-12 mt-1">
                                    <table class="display table table-hover" ordercol=1 order="asc">
                                      <tr>
                                    <th>Correo</th>
                                    <th>Accion</th>
                                      </tr>
                                        <tbody id="correo">';
                                                if(!empty($row)){
                                                    foreach ($row as $k => $v) {
                                $return .=' <tr>
                                                <td>'.$v->correo.'</td>
                                                <td class="text-center">
                                                    <a href="'.base_url("Utilidades/deleteItem/".$v->id_email).'">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>';
                                                    }
                                                }
                            $return .=  '</tbody>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript" charset="utf-8" async defer>
                              $(document).ready(function(){
                                function isValidEmailAddress(emailAddress) {
                                  var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                                  return pattern.test(emailAddress);
                                  }

                                $("#id_modelo").attr("name","nombre_modelo");
                                    $("#submit").click(function() {
                                  var valido= true;
                                  var correo = $("#correos_notificacion").val();
                                    console.log(correo);
                                  if ((valido)&&(correo == "")){
                                    valido = false;
                                    $("#message").fadeIn();
                                    $("#message").html("El campo no puede estar vacío");

                                  }

                                      if ((valido)&&(!isValidEmailAddress(correo) )){
                                    valido = false;
                                    $("#message").fadeIn();
                                    $("#message").html("correo no valido");

                                  }
                                  if (valido){
                                                                      $.post("'.base_url("Utilidades/CorreoNotificacion/SolicitudPlataformas").'",{correo:correo}, function($data){
                                      console.log($data);
                                      var $json = JSON.parse($data);
                                      if($json.message){
                                        $("#message").fadeIn();
                                        $("#message").html($json.message);
                                      }
                                      if($json.correo){
                                        eval(agregar_correo_tabla($json));
                                      }
                                      console.log($json);
                                      $("#Usuario").val($json.nickname);
                                    }); //fin post
                                  }

                                    });
                              });
                            </script>

                          </div>';
                          /*<div class="input-group mt-3">
                            <input type="text" name="Asunto" value="'.@$items['config']['Asunto'].'" id="Asunto" placeholder="Asunto" class="form-control inputconfigEmail" require="1">
                            <div class="form-control cont" style="display:none;">
                            </div>
                          </div>
                          <div class="input-group mt-3 row">
                            <label for="enviarPdf" class="col-md-6">
                              <b>Adjuntar PDF</b>
                            </label>
                            <div class="col-md-3 col-xs-6">
                              <label for="enviarPdf" style="vertical-align: top;">
                                <b>Si </b>
                              </label>
                              <label class="custom-control custom-checkbox"><input type="radio" name="enviarPDF" value="Si" id="enviarPDF" class="custom-control-input enviarPDF inputconfigEmail">
                                                                <span class="custom-control-indicator"></span>
                                                            </label>
                            </div>
                            <div class="col-md-3 col-xs-6">
                              <label for="enviarPdf" style="vertical-align: top;">
                                <b>No </b>
                              </label>
                                <label class="custom-control custom-checkbox"><input type="radio" name="enviarPDF" value="No" id="enviarPDF" class="custom-control-input enviarPDF inputconfigEmail">
                                <span class="custom-control-indicator"></span>
                              </label>
                            </div>
                          </div>
                          <div class="input-group mt-3" id="pdf" style="display:none;">
                            <input type="text" name="namePdf" value="'.@$items['config']['namePdf'].'" id="namePdf" placeholder="Nombre PDF" class="form-control inputconfigEmail">
                            <div class="form-control cont" style="display:none;">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="message">
                              <b>Mensaje del correo</b>
                            </label>
                            <textarea name="message" class="form-control inputconfigEmail" require=true;>
                              '.@$items['config']['message'].'
                            </textarea>
                            <div class="form-control cont" style="display:none;">
                            </div>
                          </div>
                          <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="container row">
                        '.OpcionesConfigEmail($items['config']['data']).'
                      </div>
                    </div>*/
              $return .='     </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
            </div>
        </div>';
  }
  return $return;

}
function Form($view){
  $ci 	=& 	get_instance();
  $ci->load->view('Template/Header');
  $ci->load->view('Template/Flash');
  $ci->load->view('Template/Apanel/Menu');
  $ci->load->view('Template/Breadcrumb');
  $ci->load->view('Template/'.$view);
  $ci->load->view('Template/Footer');
}

function FormAjax($view){
    $ci   =&  get_instance();
    $ci->load->view('Template/Header_form');
    $ci->load->view('Template/Flash');
    $ci->load->view('Template/'.$view);
    $ci->load->view('Template/Footer');
  }

  function destruye_session($user){
    $ci           =&  get_instance();
    if(is_object($user)){
      $ci->db->where('session_id', $user->session_id);
      $ci->db->delete("sys_session");
      return true;
    }else{
      $ci->db->where('session_id', $user["session_id"]);
      $ci->db->delete("sys_session");
      return true;
    }
  }

  function ini_session($user){
    $ci   =&  get_instance();
    $session_id   = md5(date("Y-m-d H:i:s"));
    if(is_object($user)){
      $user->session_id   = $session_id;
      $insert         = $ci->db->insert("sys_session",array( "fecha"=>date("Y-m-d H:i:s"),
                                            "user_id"=>$user->user_id,
                                            "session_id"=>$user->session_id));
    }else if(is_array($user)){
      $user['session_id']   = $session_id;
      $insert         = $ci->db->insert("sys_session",array( "fecha"=>date("Y-m-d H:i:s"),
                                            "user_id"=>$user["user_id"],
                                            "session_id"=>$user["session_id"]));
    }
    if($insert){
      return $user;
    }else{
      return false;
    }
  }

  function encriptar($var){
    $ci = get_instance();
    $ci->load->library("encryption");
    return $ci->encryption->encrypt($var);
  }

  function desencriptar($var){
    $ci = get_instance();
    $ci->load->library("encryption");
    return $ci->encryption->decrypt($var);
  }

  function send_mail($vars,$return=false){
    if($return){
      echo $vars["body"];
      return;
    }

    $ci   =&  get_instance();
    $config = array(
      'protocol'    =>  PROTOCOL,
      'smtp_host'   =>  SMTP_HOST,
      'smtp_port'   =>  SMTP_PORT,
      'smtp_user'   =>  SMTP_USER,
      'smtp_pass'   =>  SMTP_PASS,
      'smtp_timeout'  =>  SMTP_TIMEOUT,
      'mailtype'    =>  MAILTYPE,
      'charset'     =>  CHARSET
    );
    $ci->load->library('email', $config);
    $ci->email->set_newline("\r\n");
    $ci->email->from(FROM_EMAIL, FROM_NAME);
    $ci->email->to($vars["recipient"]);
    $ci->email->subject($vars["subject"]);
    if(isset($vars["adjunto"])){
      $ci->email->attach($vars["adjunto"]);
    }
    $ci->email->message($vars["body"]);
    if($ci->email->send()){
      //pre($vars); return;
      return array("error"  =>  false);
    }else{
      return array("error"  =>  true, "debugger"=>$ci->email->print_debugger() );
    }
  }

  function id_representante(){
    $ci   =&  get_instance();
    $tabla  = "usuarios";
    $row  = $ci->db->select("MAX(user_id) as representante_legal")->from($tabla)
                          ->get()
                          ->row();
    return $insert_id      = (empty($row->representante_legal))?1:$row->representante_legal + 1;
  }

  function pre($var){
    echo '<pre>';
      print_r($var);
    echo '</pre>';
  }

  function post($var=""){
    $ci   =&  get_instance();
    if($var==''){
      return $ci->input->post();
    }else{
      return $ci->input->post($var, TRUE);
    }
  }

  function logs($user,$tipo_transaccion,$tabla_afectada,$registro_afectado_id=NULL,$modulo_donde_produjo_cambio=NULL,$accion=1,$json=array()){
    $ci   =&  get_instance();
    $ci->db->insert("sys_logs",array(
                    "fecha"=>date("Y-m-d H:i:s"),
                    "user_id"=>$user,
                    "tipo_transaccion"=>$tipo_transaccion,
                    "tabla_afectada"=>$tabla_afectada,
                    "registro_afectado_id"=>$registro_afectado_id,
                    "modulo_donde_produjo_cambio"=>$modulo_donde_produjo_cambio,
                    "accion"=>$accion,
                    "json"=>json_encode($json)));

  }

  function Destroy($session_id){
    $ci           =&  get_instance();
    $ci->db->where('session_id', $session_id);
    $ci->db->delete("sys_session");
  }

  function roles($select = "*"){
    $ci   =&  get_instance();
    $tabla =  "sys_roles";
    $resultado= $ci->db->select($select)->from($tabla)->where("empresa_id",$ci->user->empresa_id)->get()->result();
    return $resultado;

  }

  function session_flash(){
    $ci   =&  get_instance();
    if($error = $ci->session->flashdata('error')){
      echo '<div class="alert alert-danger">';
      echo $error;
      echo '<i class="glyphicon glyphicon-alert"></i></div>';
    }elseif($info = $ci->session->flashdata('info')){
      echo '<div class="alert alert-info">';
      echo $info;
      echo '<i class="glyphicon  glyphicon-ok"></i></div>';
    }else if($success = $ci->session->flashdata('success')){
      echo '<div class="alert alert-success">';
      echo $success;
      echo '<i class="glyphicon  glyphicon-ok"></i></div>';
    }else if($success = $ci->session->flashdata('danger')){
      echo '<div class="alert alert-danger">';
      echo $success;
      echo '<i class="glyphicon  glyphicon-ok"></i></div>';
    }
  }

  function chequea_session($user,$bool=false){
    $ci           =&  get_instance();
    $session        = $ci->db->select('*')->from("sys_session")->where('session_id',$user->session_id)->get()->row();
    $fechaGuardada      =   $session->fecha;
    $ahora          =   date("Y-m-d H:i:s");
    $tiempo_transcurrido  =   (strtotime($ahora)-strtotime($fechaGuardada));
    if($tiempo_transcurrido>=SESSION_TIME){
      if($bool){
        return false;
      }else{
        redirect(base_url("autenticacion/salir"));
      }
    }else{
      if($bool){
        return true;
      }else{
        $ci->db->where('session_id', $user->session_id);
        $ci->db->update("sys_session",array("fecha"=>$ahora));
      }
    }
  }

  function img_logo($empresa_id){
    return image("uploads/perfiles/".$empresa_id.'/logo.jpg');
  }

  function get_empresa($id){
    $ci   =&  get_instance();
    $tabla            = "mae_cliente_joberp";
    return $ci->db->select("*")->from($tabla)->where("id",$id)->get()->row();
  }

  function answers_json($array){
    return json_encode($array);
  }

  function get_municipios(){
    $ci   =&  get_instance();
    $tabla  = "sys_municipios";
    return $ci->db->select("*")->from($tabla)->get()->result();
  }

  function ciudad($row,$name,$placeholder='',$require=false){
    if(empty($row)){
      $row=new stdClass();
      $row->$name='';
    }
    if(is_object($row)){
      $row = $row->$name;
    }
    if(!empty($row)){
      $ci   =&  get_instance();
      $tabla  = "sys_municipios";
      $rowid = $ci->db->select("*")->from($tabla)->where('id',$row)->get()->row();
    }

    $html = '';
    $html .=  '<input type="text" class="form-control" id="'.$name.'" placeholder="'.$placeholder.'" maxlength="150"  value="'.@$rowid->union.'"';
    $html .=  ($require)? 'require="require"':'""';
    $html .=  '/>';
    $html	.=	'<input type="hidden" name="'.$name.'" id="content'.$name.'" require="require"  value="'.@$row.'" />';

    $html .=  ' <script>
              $(function(){
                var projects = [';
                  foreach(get_municipios() as $k => $v){
                    $html .=  '{
                      value: "'.$v->id.'",
                      label: "'.$v->union.'",

                          },';
                  }



    $html .=  '     ];
    $( "#'.$name.'" ).autocomplete({
      minLength: 0,
      source: projects,
      change: function (event, ui){
        if (ui.item===null) {
          this.value = "";
          $("#text-alert").text("Por favor seleccione una ciudad válida del listado")
          $("#myModal").modal("show");

        }
      },
      focus: function( event, ui ) {
        $("#content'.$name.'" ).val( ui.item.value );
        $( "#'.$name.'" ).val( ui.item.label );
        return false;
      },


      select: function( event, ui ) {

        $("#content'.$name.'" ).val( ui.item.value );
        $( "#'.$name.'" ).val( ui.item.label );
        return false;
      }
    });
  });
   </script>
          ';
    return $html;
  }

 function identidad(){
    $ci   =&  get_instance();
    $tabla =  "sys_tipo_identidad";
    $resultado= $ci->db->select("*")->from($tabla)->get()->result();
    return $resultado;
 }

 function get_cargo(){
    $ci   =&  get_instance();
    $tabla =  "sys_profesiones";
    $resultado= $ci->db->select("*")->from($tabla)->get()->result();
    return $resultado;
 }

 function cargo($row,$name,$placeholder='',$require=false){
  if(empty($row)){
    $row=new stdClass();
    $row->$name='';
  }
  //pre($row); return;

  if(is_object($row)){
    $row = $row->cargo;
  }
  if(!empty($row)){
    $ci   =&  get_instance();
    $tabla  = "sys_profesiones";
    $rowid = $ci->db->select("*")->from($tabla)->where('id',$row)->get()->row();
  }

  $html = '';
  $html .=  '<input type="text" class="form-control" id="'.$name.'" placeholder="'.$placeholder.'" maxlength="150"  value="'.@$rowid->profecion.'"';
    $html .=  ($require)? 'require="require"':'""';
    $html .=  '/>';
  $html	.=	'<input type="hidden" name="'.$name.'" id="content'.$name.'" require="require"  value="'.@$row.'" />';

  $html .=  ' <script>
            $(function(){
              var projects = [';
                foreach(get_cargo() as $k => $v){
                  $html .=  '{
                    value: "'.$v->id.'",
                    label: "'.$v->profecion	.'",

                        },';
                }

  $html .=  '     ];
  $( "#'.$name.'" ).autocomplete({
    minLength: 0,
    source: projects,
    change: function (event, ui){
      if (ui.item===null) {
        this.value = "";
        $("#text-alert").text("Por favor seleccione un cargo válido")
        $("#myModal").modal("show");
      }
    },
    focus: function( event, ui ) {
      $("#content'.$name.'" ).val( ui.item.value );
      $( "#'.$name.'" ).val( ui.item.label );
      return false;
    },
    select: function( event, ui ) {

      $("#content'.$name.'" ).val( ui.item.value );
      $( "#'.$name.'" ).val( ui.item.label );
      return false;
    }
  });
});
 </script>
        ';
  return $html;
 }

  function get_ciclos_pagos_end(){
    $ci   =&  get_instance();
    $tabla  = "cf_ciclos_pagos";
    $row  = $ci->db->select("*")->from($tabla)->where('fecha_desde<=',date("Y-m-d"))->where('fecha_hasta>=',date("Y-m-d"))->where('id_empresa',$ci->user->empresa_id)->get()->row();
    return @$row;
  }

  function image($image,$html=false,$imageTag=false,$attr=array()){
    $return_image=null;
    if(file_exists(PATH_IMG.$image)){
      $return_image = IMG.$image;
    }else{
      $return_image = IMG."No_image.png";
    }
    if(!$html){
      return $return_image;
    }else{
      $atributos  = '';
      foreach($attr as $k => $v){
        $atributos  .=   $k.'="'.$v.'"';
      }
      if(!$imageTag){
        return '<img src="'.$return_image.'" '.$atributos.' />';
      }else{
        return '<div class="image_rect image_default" style="background-image:url('.$return_image.');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>';
      }
    }
  }

  function me_img_profile(){
    $ci   =&  get_instance();
    return image("uploads/perfiles/".$ci->user->user_id.'/profile.jpg');
  }

   function tip_identificacion($id){
    $ci   =&  get_instance();
    $tabla  = "sys_tipo_identidad";
    $rowid = $ci->db->select("*")->from($tabla)->where('id',$id)->get()->row();
    return $rowid;
   }

   function ciudad_expedicion($id){
    $ci   =&  get_instance();
    $tabla  = "sys_municipios";
    $rowid = $ci->db->select("*")->from($tabla)->where('id',$id)->get()->row();
    return $rowid;
   }

   function rol($id){
    $ci   =&  get_instance();
    $tabla  = "sys_roles";
    $rowid = $ci->db->select("*")->from($tabla)->where('rol_id',$id)->get()->row();
    return $rowid;
   }

   function upload($file='userfile',$path='images/uploads/',$config=array("allowed_types"=>'gif|jpg|png')){
		$config['upload_path']        = 	PATH_BASE.$path;
		if(!is_dir($config['upload_path'])){
			if(mkdir($config['upload_path'], 0755,true)){
				$fp		=	fopen($config['upload_path'].'/index.html',"w");
				fwrite($fp,'<a href="http://programandoweb.net">PROGRAMANDOWEB</a>');
				fclose($fp);
			}else{
				return false;
			}
		}
		$config['encrypt_name']       = 	TRUE;
		$ci 	=& 	get_instance();
		$ci->load->library('upload', $config);
		//print_r($file);return;
		if(isset($_FILES[$file])){
			if ($ci->upload -> do_upload($file)){
				return array('upload_data' => $ci->upload->data());
			}else{
				return array('error' => $ci->upload->display_errors());
			}
		}
  }

 function img_foto($producto_id){
  return img("uploads/productos/".$producto_id.'/producto.jpg');
 }

 function img($image,$html=false,$imageTag=false,$attr=array()){
  $return_image=null;
  if(file_exists(PATH_IMG.$image)){
    $return_image = IMG.$image;
  }else{
    $return_image = IMG."no_foto.png";
  }
  if(!$html){
    return $return_image;
  }else{
    $atributos  = '';
    foreach($attr as $k => $v){
      $atributos  .=   $k.'="'.$v.'"';
    }
    if(!$imageTag){
      return '<img src="'.$return_image.'" '.$atributos.' />';
    }else{
      return '<div class="image_rect image_default" style="background-image:url('.$return_image.');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>';
    }
  }
 }

 function MakeEstado($name,$estado=null,$extra=array()){
  $options = array(
    '1'         => 'Activo',
    '0'       => 'Inactivo'
  );
  return form_dropdown($name, $options, $estado,$extra);
}


function GetColor($id){
  $ci 	=& 	get_instance();
  $tabla						=	"mae_cliente_joberp";
  return $ci->db->select("*")->from($tabla)->where("id",$id)->get()->row();
}

function get_estadoCivil(){
  $ci   =&  get_instance();
  $tabla            = "sys_estado_civil";
 $ci->db->select("*")->from($tabla);
 $options    = $ci->db->get()->result();
 $option     =   array(""=>"Seleccione");
 foreach($options as $v){
   $option[$v->id]   =   $v->Estado;
 }
 return $option;
}

function get_bancos(){
  $ci   =&  get_instance();
  $tabla            = "sys_bancos";
 $ci->db->select("id, Entidad")->from($tabla);
 $options    = $ci->db->get()->result();
 $option     =   array(""=>"Seleccione");
 foreach($options as $v){
   $option[$v->id]   =   $v->Entidad;
 }
 return $option;
}
