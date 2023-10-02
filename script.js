$(document).ready( function () {
    $('#myTable').DataTable();
} );

var edit = document.getElementsByClassName('edit')
Array.from(edit).forEach(function(elem){
    elem.addEventListener("click",function(dets){
       var tr =  dets.target.parentNode.parentNode;
       var sno = tr.getElementsByTagName('td')[0].innerText;
       var title = tr.getElementsByTagName('td')[1].innerText;
       var description = tr.getElementsByTagName('td')[2].innerText;
       console.log(title, description)
       document.querySelector(".modal").style.display = "block";
       document.querySelector(".title-edit").value = title
       document.querySelector(".description-edit").value = description
       document.querySelector(".hidden-sno").value = dets.target.id;
    })
})

var deletes = document.getElementsByClassName('delete')
Array.from(deletes).forEach(function(elem){
    elem.addEventListener("click",function(dets){
        var del = dets.target.id.substr(1,)
        document.querySelector(".modal-del").style.display = "block";
        document.querySelector(".overlay").style.display = "block";
        document.querySelector(".del").value = del
        console.log(document.querySelector(".del").value)
    })
})

var cancel = document.querySelector(".btn-del-cancel")
cancel.addEventListener("click",function(dets){
    document.querySelector(".modal-del").style.display = "none";
    document.querySelector(".overlay").style.display = "none";
})
