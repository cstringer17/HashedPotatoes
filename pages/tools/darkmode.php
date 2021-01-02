<script src="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/theme.js"></script>
<script>
    const themeConfig = new ThemeConfig();
    // place customizations here
    themeConfig.initTheme();
    const darkSwitch = writeDarkSwitch(themeConfig);

    var hElements = document.querySelectorAll("h1, h2, h3, h4, h5, h6")



    for (var i = 0; i < hElements.length; i++) {
        if (themeConfig == "light") {
            hElements[i].style.color = "#000";
        } else if (themeConfig == "dark") {
            hElements[i].style.color = "#fff";
        }
    }



    //themeConfig.themeChangeHandlers.push(theme => console.log(`using theme: ${theme}`));
    themeConfig.saveTheme = theme => {
        // custom logic


        var hElements = document.querySelectorAll("h1, h2, h3, h4, h5, h6")



        for (var i = 0; i < hElements.length; i++) {
            if (theme == "light") {
                hElements[i].style.color = "#000";
            } else if (theme == "dark") {
                hElements[i].style.color = "#fff";
            }
        }

    };
</script>