function table2excl_function(source_filename){
	$(".table2excel").table2excel({
			exclude: ".noExl",
			name: "Excel Document Name",
			filename: source_filename,
			fileext: ".xls",
			exclude_img: true,
			exclude_links: true,
			exclude_inputs: true
		});
		
}

function myProduct(p1, p2){
	return p1 * p2;
}

function myDivision(p1, p2){
	//var value=(p1/p2).toFixed(2);
	//var value=(p1/p2).toFixed(2);
	var value=(p1/p2);
	return value;
}

function myArraySum(sumArray){
	var total=0,value=0;
	for(var i in sumArray){
		value=(isNaN(parseFloat(sumArray[i]))?0:parseFloat(sumArray[i]));
		total += value;
	}
	return total;
}

$(document).ready(function(){
	$(".select-search").select2({
		width: "100%"
	});
});

$(window).load(function(){
	
	$(".loader").fadeOut("slow");
	
	$(".width_th").each(function(){
		var html_value=$(this).html();
		var new_html='<span style="padding: 0px 130px 0px 30px;"> '+html_value+' </span>';
		$(this).html(new_html);
	});
	
	$(".sm_width_th").each(function(){
		var html_value=$(this).html();
		var new_html='<span style="padding: 0px 90px 0px 30px;"> '+html_value+' </span>';
		$(this).html(new_html);
	});
	
	$(document).on('keyup','.intNumberOnly',function(){ 
       this.value = this.value.replace(/[^0-9]/g,'');           
    });
	
    $(document).on('keyup','.floatNumberOnly',function(){ 
	   this.value    = this.value.replace(/[^0-9\.]/g,''); 
    });
	
    $(document).on('keyup','.noSpecialChar',function(){
       this.value = this.value.replace(/[^\w\d\*\-\.\?]+/gim," ");
    });
	
    $(document).on('keyup','.alphaNumeric',function(){
       this.value = this.value.replace(/[^a-zA-z0-9]/g,''); 
    });
	
});
