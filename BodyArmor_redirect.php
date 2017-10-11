<?php error_reporting(0); ?>

<html>
<head>

<?php


if ($_REQUEST['site'] == "yes") {
	
	
	
	
	
	if ($_REQUEST['order'] == "yes") {
		
		
		
		
				if ($_POST['type'] == "CT") { ?>
				
				<script language="javascript" type="text/javascript">
				
				window.location.href = 'http://php.eos.net/~restyler/BodyArmor/BodyArmor-CT.php?site=yes&order=yes';
				
				</script>
				
				<?php
				
				}else{ ?>
				
				<script language="javascript" type="text/javascript">
				
				window.location.href = 'http://php.eos.net/~restyler/BodyArmor/BodyArmor-MR.php?site=yes&order=yes';
				
				</script>
                
				
                <?php } 
		
	
	
	}else{
    
    
    
    
  				 if ($_POST['type'] == "CT") { ?>
				
				<script language="javascript" type="text/javascript">
				
				window.location.href = 'http://php.eos.net/~restyler/BodyArmor/BodyArmor-CT.php?site=yes';
				
				</script>
				
				<?php
				
				}else{ ?>
				
				<script language="javascript" type="text/javascript">
				
				window.location.href = 'http://php.eos.net/~restyler/BodyArmor/BodyArmor-MR.php?site=yes';
				
				</script>
                
				
                <?php } ?>
		
		
        
		
	<?php } // end of request order if statement ?>
	
	
	      
                
<?php }else{               



				if ($_POST['type'] == "CT") { ?>
				
				<script language="javascript" type="text/javascript">
				
				window.location.href = 'http://php.eos.net/~restyler/BodyArmor/BodyArmor-CT.php';
				
				</script>
				
				<?php
				
				}else{ ?>
				
				<script language="javascript" type="text/javascript">
				
				window.location.href = 'http://php.eos.net/~restyler/BodyArmor/BodyArmor-MR.php';
				
				</script>
				
				<?php } ?>
                
<?php } ?>                

                

</head>
<body>
</body>
</html>