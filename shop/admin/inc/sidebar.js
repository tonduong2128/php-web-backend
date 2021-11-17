$(document).ready(()=>{
    var itemsMenu = $("ul.section.menu > li > a");
    itemsMenu[window.localStorage.getItem("indexSideBar") || 0].click();
    itemsMenu.each(function(index){
        $( this ).click(()=>{
            window.localStorage.setItem("indexSideBar", index);
        });
    })
})