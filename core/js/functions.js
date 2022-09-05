export default function bind() {
    $("nav").load("modules/navigation");
    $("footer").load("modules/footer");
}

export function appBind() {
    $("#surfaceType").on("change",() => {
        let type = $("#surfaceType").val();
        $("#surfaceType option:selected").attr('disabled', 'disabled');
        $("#surfaceType").val(0);
        let element = '<div class="surface col-md-12 col-xl-12 row"><div class="surfaceType col-xs-4 col-sm-6 col-md-6">'+type+'</div><div class="surfaceSize col-xs-4 col-sm-3 col-md-3"><input class="col-xs-3 col-sm-12 col-md-12" type="number" min="1" /></div><div class="surfaceSpace col-xs-2 col-sm-2 col-md-2">m<sup>2</sup></div><div class="surfaceDelete col-xs-1 col-sm-1 col-md-1" tabindex="0" title="Double click to delete"></div> </div>';
        $("#elements").append(element);

        deleteElements();
    });
}

export function deleteElements() {
    $(".surfaceDelete").off();
    $(".surfaceDelete").dblclick(function(){
        let value = $(this).parent().find(".surfaceType").text();
        $.each($("#surfaceType option"),function(){
            if($(this).text()==value) {
                $(this).removeAttr("disabled");
            }
        });
        $(this).parent().remove();
    });
}