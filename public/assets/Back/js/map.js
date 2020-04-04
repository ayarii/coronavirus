var map = document.querySelector('#mapTun')

var paths = document.querySelectorAll('#mapTun a')

var mapSelect = document.querySelector('#mapSelect')

paths.forEach(function (path){
    path.addEventListener('mouseenter', function() {
        var id = this.id
        if (id.includes("Tunis-")) {
            id = "Tunis"
        }
        if (id.includes("Sfax-")) {
            id = "Sfax"
        }
        if (id.includes("Nabeul-")) {
            id = "Nabeul"
        }
        document.getElementById("mapSelect").value = id
        
        map.querySelectorAll('.isActive').forEach(function (item) {
            item.classList.remove('isActive')
        })
        this.classList.add('isActive')
        console.log('WELL')
        // document.getElementById('myform').submit()
    })
})

map.addEventListener('mouseleave', function(){
    map.querySelectorAll('.isActive').forEach(function (item) {
        item.classList.remove('isActive')
    })
    document.getElementById("mapSelect").value = ""
})

