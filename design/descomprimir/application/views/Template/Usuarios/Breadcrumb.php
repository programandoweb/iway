<div style="width:100%; height:10px;"></div>
<?php #print_r($this->Breadcrumb);
return;?>
<ol class="breadcrumb">
	<?php 	for($a=1;$a<=count($this->Breadcrumb);$a++){	
				if($a==1){
	?>
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url($this->uri->segment(1));?>"><?php echo $this->Breadcrumb[$a];?></a>
                    </li>
    <?php			
				}else if($a==count($this->Breadcrumb)){
	?>
    				<li class="breadcrumb-item active">
						<?php echo $this->Breadcrumb[$a];?>
                    </li>
    <?php				
				}else{
	?>
    				<li class="breadcrumb-item <?php if($this->Breadcrumb[$a]==$this->Uri_Last){echo 'active';}?>">
                        <a href="<?php echo base_url($this->uri->segment(1).'/'.$this->Breadcrumb[$a]);?>"><?php echo $this->Breadcrumb[$a];?></a>
                    </li>
    <?php			
				}
			}
	?>
</ol>
