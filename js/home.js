
$('#dodajForm').submit(function(){
    event.preventDefault();
    console.log("Dodavanje");
    const $form = $(this);
    const $input = $form.find("input, select, button");

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);
    let obj = $form.serializeArray().reduce(function (json, { name, value }) {
        json[name] = value;
        return json;
      }, {});
      console.log(obj);

    $input.prop("disabled", true);

    request = $.ajax({
        url:'handler/insert.php',
        type:'post',
        data: serijalizacija,
    });

    request.done(function(response,textStatus,jqXHR){
        if(response==="Success"){
            alert("Uspesno ste zakazali trening");
            console.log("Uspesno dodat trening");
            
            location.reload(true);
        }else console.log("Trening nije dodat "+response);
        console.log(response);
    });

    request.fail(function(jqXHR, textStatus,errorThrown){
        console.error('Desila se greska: '+textStatus, errorThrown);
    });
});



$("#btn-obrisi").click(function(){
    console.log("Brisanje treninga");

    const checked = $("input[type=radio]:checked");

    request = $.ajax({
        url: 'handler/delete.php',
        type:'post',
        data: {'id':checked.val()}
    });

    request.done(function(response, textStatus, jqXHR){
        if(response === "Success"){
            checked.closest("tr").remove();
            alert('Obrisan trening');
            console.log('Obrisan trening');
        }else{
            console.log("Trening nije obrisan "+response);
            alert("Trening nije obrisan");
        }
        console.log(response);
    });
});



$('#btn-pretraga').click(function () {

    var para = document.querySelector('#myInput');
    console.log(para);
    var style = window.getComputedStyle(para);
    console.log(style);
    if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") == "hidden")) {
        console.log('block');
        $('#myInput').show();
        document.querySelector("#myInput").style.visibility = "";
    } else {
       document.querySelector("#myInput").style.visibility = "hidden";
    }
});



$('#btn').click(function () {
    $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
    $("#myModal").modal("toggle");
    return false;
});

