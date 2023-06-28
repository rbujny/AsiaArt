let angle_down = document.getElementById("angle-down")
let angle_up = document.getElementById("angle-up")
let main_list = document.getElementById("main_list")
let photos = document.getElementById("photos")
let content = document.getElementById("content")
let allParagraphs = document.getElementsByTagName("p");
const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

if(isMobile)
{
    angle_up.style.display = "none"
    angle_down.style.display = "none"
}
else
{
    main_list.style.display = "none"
    angle_up.style.display = "none"
}

function showMenu()
{
    angle_down.style.display = 'none'
    main_list.style.display = ""
    angle_up.style.display = ""
    photos.style.flexDirection = "column"
    content.style.marginLeft = "15%"
    content.style.width = "32.5%"
    for (let i=0, max=allParagraphs.length; i < max; i++) {
        allParagraphs[i].style.marginLeft= "30px"
    }
}
function hideMenu()
{
    angle_down.style.display = ''
    main_list.style.display = "none"
    angle_up.style.display = "none"
    photos.style.flexDirection = "row"
    content.style.marginLeft = ""
    content.style.width = ""
    for (let i=0, max=allParagraphs.length; i < max; i++) {
        allParagraphs[i].style.marginLeft= ""
    }
}