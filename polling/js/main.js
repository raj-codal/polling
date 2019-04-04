var options_count = 2;
function add(){
    if(options_count > 4){
        var x = document.getElementById("box");
        var height = parseInt(x.style.height);
        var newHeight = height + 43;
        x.style.height = newHeight + 'px';
        console.log(">"+height);
    }
    document.getElementById('options').innerHTML +=
            '<input type = "text" name="pollA[]" id="'+'op'+options_count.toString()+'" placeholder="enter a option" />';
    options_count++;
    return false;
}