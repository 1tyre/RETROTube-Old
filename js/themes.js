/*

    RETROTube JS file lolololol
    themes.js

*/

let theme = localStorage.getItem('data-theme');
const togdark = document.getElementById("tdark");
const toglight = document.getElementById("tlight");
const togolive = document.getElementById("tolive");

const changeThemeToDark = () => {
    document.documentElement.setAttribute("data-theme", "dark")
    localStorage.setItem("data-theme", "dark")
}

const changeThemeToLight = () => {
    document.documentElement.setAttribute("data-theme", "light")
    localStorage.setItem("data-theme", 'light')
}

const changeThemeToOlive = () => {
    document.documentElement.setAttribute("data-theme", "olive")
    localStorage.setItem("data-theme", 'olive')
}

toglight.addEventListener('click', () => {
    let theme = localStorage.getItem('data-theme'); // Retrieve saved them from local storage
    if (!(theme == 'light')){
        changeThemeToLight()
        console.log("Changed to Light theme")
    } 
})

togdark.addEventListener('click', () => {
    let theme = localStorage.getItem('data-theme'); // Retrieve saved them from local storage
    if (!(theme == 'dark')){
        changeThemeToDark()
        console.log("Changed to Dark theme")
    } 
})

togolive.addEventListener('click', () => {
    let theme = localStorage.getItem('data-theme'); // Retrieve saved them from local storage
    if (!(theme == 'olive')){
        changeThemeToOlive()
        console.log("Changed to Olive theme")
    } 
})

if (theme == "dark") {
    changeThemeToDark()
}

if (theme == "light") {
    changeThemeToLight()
}

if (theme == "olive") {
    changeThemeToOlive()
}