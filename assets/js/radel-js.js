setTimeout(function () {
    var elems = document.getElementsByClassName('vanish');
    for (var i = 0; i < elems.length; i += 1) {
        elems[i].style.display = 'none';
    }
}, 2000);