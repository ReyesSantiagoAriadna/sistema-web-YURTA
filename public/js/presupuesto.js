 $(function(){
    $('#tabla-material').on('change', onSelectTabla);
});

function onSelectTabla() {
    var obra_id = $(this).val();
    alert(obra_id);
}