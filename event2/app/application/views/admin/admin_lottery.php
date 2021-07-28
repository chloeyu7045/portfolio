<!doctype html>
<html>
<head>
<meta name="viewport" content="width=100, target-densitydpi=device-dpi, maximum-scale=2.0, user-scalable=yes" />
<meta charset="utf-8">
<title>華航全新777直飛法蘭克福 - 不在故事書裡的童話王國 想玩跟我們來</title>
<link rel="stylesheet" href="<?php echo base_url();?>css/lottery.css" />
<script src="<?php echo base_url();?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url();?>js/particle.js"></script>
<script src="<?php echo base_url();?>js/jslots.js"></script>

<script>
var base_url = '<?php echo base_url();?>';
</script>
<script src="<?php echo base_url();?>js/lottery.js"></script>
</head>

<body>


<div id="wrap">
	<img src="<?php echo base_url();?>images/lottery/f.gif" />
	<div id="coverbg"></div>
    
  <div id="lotterySlot" class="jSlots-wrapper">
        <ul class="slot"> 
			 <li><img src="<?php echo base_url();?>images/lottery/g1.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g2.jpg" /></li>  
			<li><img src="<?php echo base_url();?>images/lottery/g3.jpg" /></li>  
			<li><img src="<?php echo base_url();?>images/lottery/g4.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g5.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g6.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g7.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g8.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g9.jpg" /></li>	
        </ul>  
    </div>
    
    <div id="lotterySlot2" class="jSlots-wrapper">
        <ul class="slot2">  
            <li><img src="<?php echo base_url();?>images/lottery/g1.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g2.jpg" /></li>  
			<li><img src="<?php echo base_url();?>images/lottery/g3.jpg" /></li>  
			<li><img src="<?php echo base_url();?>images/lottery/g4.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g5.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g6.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g7.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g8.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g9.jpg" /></li>	
        </ul>  
    </div>
    
    <div id="lotterySlot3" class="jSlots-wrapper">
        <ul class="slot3">  
             <li><img src="<?php echo base_url();?>images/lottery/g1.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g2.jpg" /></li>  
			<li><img src="<?php echo base_url();?>images/lottery/g3.jpg" /></li>  
			<li><img src="<?php echo base_url();?>images/lottery/g4.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g5.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g6.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g7.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g8.jpg" /></li>
			<li><img src="<?php echo base_url();?>images/lottery/g9.jpg" /></li>	
        </ul>  
    </div>
    <div id="airplan"><img src="<?php echo base_url();?>images/lottery/airplan.png" /></div>
  <div id="cover"></div>
    
    
     
    
  <div id="stage">
    獎項
    <select name="stid" id="stid">
      <option value="0">請選擇抽獎獎項...</option>
    	<?php foreach($gifts as $key=>$data){ ?>
   	  <option value="<?php echo $key;?>"><?php echo $data;?></option>
    	<?php } ?>
    </select>
    <input type="button" name="lottery" id="lottery" value="抽獎" />
    <input type="hidden" name="lotteryStart" id="lotteryStart" />
  </div>
     
   <input type="button" name="lottery_list_btn" id="lottery_list_btn" value="得獎名單" />
    
    <div id="header">
    <img src="<?php echo base_url();?>images/lottery/logo.jpg" />
    <div id="title" class="title">
		<span>許願。抽機票</span>
		
	</div>
    </div>
    
    <div id="list">
    <h3>得獎名單</h3>
    <div id="list-content"></div>
    </div>
    
    
    
</div>

<div id="loading"><div id="loading-icon"><img src="<?php echo base_url();?>images/lottery/ajax-loader2.gif" /></div></div>

<div id="listpopup" class="popup">
<div class="closePopup"><a href="#"><img src="<?php echo base_url();?>images/lottery/close.png" /></a></div>
<div id="listpopupContent"></div>
</div>



</body>
</html>
