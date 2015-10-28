	function ShowPreview(url,count) {
	
		var p = $("#picture"+count );
		var delay=setTimeout(function(){
			$("#divPreview").html('<img src="spo/index.php?file='+url+'" />');
			
			var position = p.position();
			$( "#divPreview" ).css( {left:  position.left-20 , top:  position.top-10 });
			$( "#divPreview" ).fadeIn("fast");
		},1000);
		p.mouseout(function(){clearTimeout(delay);});
	};
	function HidePreview() {
		$( "#divPreview" ).fadeOut("fast");
	};
	
	function SwitchCheckFile(count) {
        $("#check"+count).prop("checked", !checkBoxes.prop("checked"));
	};
