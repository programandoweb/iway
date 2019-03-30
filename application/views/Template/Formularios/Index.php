<?php
	if($this->uri->segment(2)!='ProgramarEntrevistas'){
		$this->load->view("Template/Formularios/Entrevista/".$this->uri->segment(3));
	}else{
		$this->load->view("Template/Formularios/Entrevista/List");
	}
?>