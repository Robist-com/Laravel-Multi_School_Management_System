<script type="text/javascript">

var n = $('#disabled').val();

    $('.create-fee').on('click', function(e){ $('#createFeeOpup').modal('show')});

    //----------------------Create Fee-----------------------------

    $('#frmFee').on('submit',function(e){
        e.preventDefault(); 
        enableFormElement($(this));
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url,data,function(data){
           location.reload();
        // console.log(data);
        })
        
    })

    //-------------Enable Form Element---------------------------

    function enableFormElement(frmName)
    {
        $.each($(frmName).find('input,select'),function(i,element){
            $(element).attr('disabled',false).css({'background': '#fff', 'border': '1px solid #ccc'});
        })
    }

    //----------------------------------------------------------

    $('.btn-paid').on('click',function(e){
        e.preventDefault();
        s_fee_id = $(this).data('id-paid');
        balance = $(this).val();
        $.get("{{ route('pay')}}",{s_fee_id:s_fee_id},function(data){
                $('#Paid').attr('id','Pay');
                $('#student_fee_id').val(data.student_fee_id);
                $('#Student_ID').val(data.student_id);
                $('#LevelID').val(data.degree_id);
                $('#semesterFee').val(data.semester_fee);
                $('#admissionFee').val(data.semester_fee);
                $('#FeeID').val(data.fee_structure_id);
                $('#Amount').val(data.semester_fee_amount);
                // $('#Discount').val(data.discount);
                $('#Pay').val(balance);
                $('#Pay').focus();
                $('#Pay').select();
                $('#b').val(balance);
                addItem(data);
                showStudentLevel(data);
                $('#update-payment-table').show();
        // console.log(data);

        })    
    })

    //-----------------------------------------

    function addItem(data){
        $('#program_id').empty().append($("<option/>",{
                    value : data.program_id,
                    text : data.program
        }))

        $('#Level_ID').empty().append($("<option/>",{
                    value : data.level_id,
                    text : data.level
        }))
    }

//--------------------------------------------------
    function showStudentLevel(data){

    $.get("{{ route('showStudentLevel')}}", {level_id:data.level_id,student_id:data.student_id},function(data){
        // console.log(data);
                    $('.academicDetail').text(data.details).css({'font-weight':'bold',' font-family':' time news romain','font-size':'100%'});
    })
}
//====================================================
        $('.btn-reset').on('click', function(e){
            e.preventDefault();
            var caption = $(this).val();
            if (caption = "Reset")
            {
                $(this).val('cancel');
                $('#btn-go').val('save');
                $('#Pay').attr('id','Paid');
                $('#frmPayment').attr('action',"{{ route('savePayment')}}");
                enableFormElement('#frmPayment');

                return;
            }
            location.reload();
        })
    //------------------------------------------------

    function  disabled_input()
    {
        $.each($('body').find('.d'),function(i,item){
            $(item).attr('disabled',true).css({'background':'#f5f5f5', 'border':'1px solid #ccc'})

            $(item).attr('readonly',false);
        });
    }

    //------------------------------------------------
    $(document).ready(function(){
        if (n==0)
        {
            disabled_input();
        }
    })
</script>