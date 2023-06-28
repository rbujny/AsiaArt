let angle_down = document.getElementById("angle-down")
let angle_up = document.getElementById("angle-up")
let main_list = document.getElementById("main_list")
let content = document.getElementById("content")
let menu = document.getElementById("menu")
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
    menu.style.marginLeft = "15%"
}
function hideMenu()
{
    angle_down.style.display = ''
    main_list.style.display = "none"
    angle_up.style.display = "none"
    menu.style.marginLeft = "38%"
}