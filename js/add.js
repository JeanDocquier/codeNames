var ajouter = document.querySelector('.ajouter');
console.log(ajouter);

ajouter.addEventListener("click", function () {
    var wordtoadd = document.querySelector('.mot-utilisateur').value ;
    var message = document.querySelector('.message');
    console.log(wordtoadd);
    $.get('addwordPDO.php', {
        mywordtoadd : wordtoadd
    }).done(function (data) {
        message.textContent = data;
    });
});