<div>
    <form action="javascript:void(null);" method="post"  id="link_form">
        <p>
            <div>Ссылка</div>
            <input type="text" id="name" name="name" title="Введите ссылку"  value="" placeholder="Вставьте сюда ссылку" />
        </p>
        <p>
            <input type="submit" id="link_save" name="link_save" value="Сохранить" />
        </p>
    </form>
</div>

<script type="text/javascript"><!--
    $(document).ready(function() {
        $('#link_save').click(function(){
         $.ajax({
            type: 'post',
            url: 'index.php?controller=cutter&action=addlink',
            dataType: 'json',
            data: $('#link_form').serialize(),
            beforeSend: function() {
                $('.error').remove();
                $('#link').remove();

                $('#link_save').attr("disable", "disable");
            },
            complete: function() {
                $("#link_save").removeAttr("disable");
            },
            success: function(data, status) {
               if (data.error) {
                   $('.error').remove();
                   if (data.error=='error') {
                        $("#name").after("<label class='error'>"+data.err_name+"</label>");

                   }
                   if (data.error=='repeat') {
                         $("#name").after("<label class='error'>"+data.err_name+" <a href='"+data.err_link+"'>"+data.err_link+"</a></label>");
                   }
               }
                if (data.success) {
                    $("#name").after("<div id='link'><a href='"+data.link+"'>"+data.link+"</a></div>");
                }
            },
             error: function (data,status, error)
             {
                alert(error);
             }
        });
    });
    });
    //--></script>