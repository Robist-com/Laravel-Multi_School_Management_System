<script type="text/javascript">
$(document).ready(function(){
    var semesterFee = $('#semesterFee').val();
    var admissionFee = $('#admissionFee').val();
    $('#totalFee').val(parseFloat(admissionFee) + parseFloat(semesterFee));

})

    // $(document).on("change keyup", "#Amount",function(){

    //     var fee = $('#totalFee').val();
    //     var amt = $('#Amount').val();
    //     var paid = $('#Paid').val($('#Amount').val());

    //     if(paid!='' && amt !='')
    //     {
    //         paid = parseFloat($('#Amount').val())
    //         // var dis = (((parseFloat(fee) - parseFloat(paid))* 100) / fee);
    //         $('#balance').val(parseFloat(amt) - parseFloat(paid));

    //     }
        // if(amt=='' && paid =='')
        // {
        //     $('#Paid').val()
        //     // $('#Discount').val()
        // }
        // if (parseFloat (amt)> parseFloat(fee))
        // {
        //     // $('#Discount').css("color", 'red');
        // }else{
        //     $('#Discount').css({"color":"black"})
        // }
        // $('#Discount').val(parseInt(dis))
    // });


    // //==============================================================
    // $(document).on("change keyup", "#Discount",function(){

    //         var fee = parseFloat($('#Fee').val());
    //         var dis = 0;
    //         dis = ((fee * parseFloat($(this).val()))) / 100;
    //         var amt = fee - dis;

    //         $('#Paid').val(parseInt(amt))
    //         $('#Amount').val(parseInt(amt))
    // });
    
    
    //=================================================================

     $(document).on("change keyup", "#Paid",function(){

          var totalFee = $('#totalFee').val();
          var pay_amount = $('#Paid').val();

            if (pay_amount==''){$('#balance').val(0)};
            if(pay_amount!=''){
                paid = parseFloat($('#Paid').val());
            }

            if(pay_amount!='' && totalFee !='')
            {
                var balance = parseFloat(totalFee) - parseFloat(paid)
                $('#balance').val(parseInt(balance).toFixed(2))
                $('#balance1').val(parseInt(balance))
            }

            if($('#balance').val()<0)
            {
                $('#balance').css('color', 'red');
                $('.message-alert').html('<div class=" badge-danger" style="text-align:center; color:red; font-weight:bold">Amount is Ec</div>')
                $('#btn-go').hide();
                alert("You enter incorrect amount! please check your amount.")
            }
            else if($('#balance').val()>0){
                $('#balance').css('color', 'green');
                $('.message-alert').html('<div class=" badge-danger" style="text-align:center; color:green; font-weight:bold">Amount is Ec</div>')
                $('#btn-go').show();
                
            }else{
                $('#balance').css('color', 'black');
                $('#btn-go').show();

            }

     });

// $(document).ready(function(){


// $('#panel_fee').hide();



// $('#btn_fetch_fee').on('click', function(){
//     alert(1)
// })



// });

     

            //=================================================================

    //  $(document).on("change keyup", "#Pay",function(){

    //         b = $('#Amount').val()
            
    //         var pay=$('#Pay').val();

    //         if (pay==''){
    //             $('#balance').val(0)}
    //         if(pay!=''){
    //             paid = parseFloat($('#Pay').val());
    //         }

    //         if(pay!='' && b !='')
    //         {
    //             var lack = parseFloat(b) - parseFloat(paid)
    //             $('#balance').val(parseInt(lack))
    //         }
    //         if($('#Lack').val()<0)
    //         {
    //             $('#balance').css('color','red');
    //         }else{
    //             $('#balance').css('color', 'black');
    //         }

    // });

$(document).ready(function(){
	$('#studentid').on('change', function(){
		var studentid = $(this).val();
		loadexamMarks(studentid);
	})
	loadexamMarks(1);
});

function loadexamMarks(studentid)
{
	$.ajax({
		type : 'get',
		url  : "{{url('getExamMarks')}}",
		data :  {studentid:studentid},
		dataType: 'json',
		success : function(data)
		{
			console.log(data);
			//alert(data);
			
		}
	});
}

function margeTableCells(table)
{
	var firstColumnBreaks = [];
	$.each(table.find('th'),function(i){
			var previous = null, celToExtend = null, rowspan = 1;
			table.find("td:nth-child(" + i + ")").each(function(index, e){
			var jthis = $(this), content = jthis.text();
			if (previous == content && content !== "" && $.inArray(index, firstColumnBreaks) === -1){
				jthis.addClass('hidden');
				celToExtend.attr("rowspan", (rowspan = rowspan+1));
			}else
			{
				if(i === 1) firstColumnBreaks.push(index);
				rowspan = 1;
				previous = content;
				celToExtend = jthis;
			}
			});
	});
	$('td.hidden').remove();
}


// $(document).ready(function(){  
$('#semester_id').on('change', function(){
		var semesterid = $("#semester_id").val();
		var departmentid = $("#department_id").val();
		var levelid = $("#level_id").val();
// alert(1)
		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/semester/department/level')}}',
            data: {'semester_id': semesterid, 'department_id': departmentid, 'level_id':levelid},
			// data: 'course_id=' + courseid + '&level_id=' + levelid,
			success:function(data){
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
				console.log(data);
			    if($("#classAssignings").html(data)){}
                // $('#footer').hide();

			}
		});
	});

    $('#department_id').on('change', function(){
		var semesterid = $("#semester_id").val();
		var departmentid = $("#department_id").val();
		var levelid = $("#level_id").val();
// alert(1)
		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/semester/department/level')}}',
            data: {'semester_id': semesterid, 'department_id': departmentid, 'level_id':levelid},
			// data: 'course_id=' + courseid + '&level_id=' + levelid,
			success:function(data){
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
				console.log(data);
			    $("#classAssignings").html(data);
                // $('#footer').hide();

			}
		});
	});

    $('#level_id').on('change', function(){
		var semesterid = $("#semester_id").val();
		var departmentid = $("#department_id").val();
		var levelid = $("#level_id").val();
// alert(1)
		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/semester/department/level')}}',
            data: {'semester_id': semesterid, 'department_id': departmentid, 'level_id':levelid},
			// data: 'course_id=' + courseid + '&level_id=' + levelid,
			success:function(data){
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
				console.log(data);
			    $("#classAssignings").html(data);
                    $('#footer').hide();
               
			}
		});
	});

    $(document).ready(function(){

		var semesterid1 = $("#semester_id1").val();
		var departmentid1 = $("#department_id1").val();;
		var levelid1 = $("#level_id1").val();
        $("#note").html('<div class=" alert alert-info" > Note, Please Choose the Correct Courses for Semester (<b>' +semesterid1+ '</b>) Department  (<b>' +departmentid1+ '</b>) And Degree (<b>' +levelid1+ '</b>)</div>');

	});

</script>