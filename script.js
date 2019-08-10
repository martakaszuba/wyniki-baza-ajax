$("#show").click(function(){
    $("#res").html("");
    $("table").html("");
    if ($("table").html().trim() ===""){
    $.ajax({
        url:"response.php",
        method:"get",
    })
    .done(function(response){
        var result = JSON.parse(response);
        var count = 1;
        $("table").append(`<tr class="b">
        <td>Numer</td>
        <td>Imię</td>
        <td>Nazwisko</td>
        <td>Wiek</td>
        </tr>`);
        result.forEach(function(val){
        $("table").append(`<tr>
        <td>${count}</td>
        <td>${val.name}</td>
        <td>${val.surname}</td>
        <td>${val.age}</td>
        </tr>`);
        count++;
})
    })
    }
})

$("#add").click(function(){
    $("table").html("");
    $("#res").html("");
    $("#res").append(`
    <div class="r">
    <p>Wpisz imię: <input type="text" id="name"></p>
<p>Wpisz nazwisko: <input type="text" id="surname"></p>
<p>Wpisz wiek: <input type="number" id="age"></p>
<button id="submit" class="btn btn-info">Dodaj</button>
<p id="err"></p>
</div>
    `)
    $("#submit").click(function(){
        var name = $("#name").val().trim();
        var surname = $("#surname").val().trim();
        var age = $("#age").val().trim();
        if (name.length === 0 || surname.length === 0 || age.length === 0 || age <=0 
        || age.match([/a-z/])) {
            $("#err").text("Wpisz prawidłowe dane!");
        }
        else {
        $("#err").text("");
        $.ajax({
        url:"add.php",
        method:"post",
        data: {
        name:name,
        surname:surname,
        age:age
        }
    })
    .done(function(res){
        if (res.trim()==="success"){
            $("#res").html("");
        }
        else {
            $("#err").html(res);
        }
    })
        }

    })
})

$("#delete").click(function(){
    $("table").html("");
    $("#res").html("");
    $("#res").append(`
    <p>Usuń dane rekordu o numerze id: <input type="number" id="num"></p>
<button id="del" class="btn btn-info">Usuń</button>
<p id="err"></p>
    `)
    $("#del").click(function(){
        var num = $("#num").val().trim();
        $("#err").text("");
        $.ajax({
        url:"delete.php",
        method:"post",
        data: {
        num:num
        }
    })
    .done(function(res){
        if (res.trim() ==="success"){
            $("#res").html("");
        }
        else {
            $("#err").html(res);
        }
    })
    })
})

$("#find").click(function(){
    $("table").html("");
    $("#res").html("");
    $("#res").append(`
    <p>Wpisz imię albo nazwisko: <input type="text" id="txt"></p>
<button id="search" class="btn btn-info">Szukaj</button>
<p id="err"></p>
    `)

    $("#search").click(function(){
        var txt = $("#txt").val().trim();
        $("table").html("");
        if (txt.length <2){
            $("#err").text("Wpisz dłuższy wyraz!");
        }
        else {
        $.ajax({
        url:"find.php",
        method:"post",
        data: {
        txt:txt
        }
    })
    .done(function(response){
        if (response.trim() === "Nie ma takiego wyniku!"){
            $("#err").text("Nie ma takiego wyniku!");
        }
        else if (response.trim() ==="Wpisz dłuższy wyraz!"){
            $("#err").text("Wpisz dłuższy wyraz!");
        }
        else {
            $("#err").text("");
        var result = JSON.parse(response);
        var count = 1;
        $("table").append(`<tr class="b">
        <td>Numer</td>
        <td>Imię</td>
        <td>Nazwisko</td>
        <td>Wiek</td>
        </tr>`);
        result.forEach(function(val){
        $("table").append(`<tr>
        <td>${count}</td>
        <td>${val.name}</td>
        <td>${val.surname}</td>
        <td>${val.age}</td>
        </tr>`);
        count++;
})
        }
    })
        }
})

})