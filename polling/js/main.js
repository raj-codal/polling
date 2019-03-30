var options_count = 2;
function add(e){
    document.getElementById('options').innerHTML +=
            '<input type = "text" name="pollA[]" id="'+'op'+options_count.toString()+'" placeholder="enter a option" />';
    options_count++;
    return false;
}