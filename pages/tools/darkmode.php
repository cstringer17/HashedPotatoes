<script src="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/theme.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script>
    const themeConfig = new ThemeConfig();
    // place customizations here
    themeConfig.setTheme('light');
    themeConfig.initTheme();
    const darkSwitch = writeDarkSwitch(themeConfig);


    themeConfig.loadTheme = theme => {
        // custom logic
        console.log(darkSwitch);
        var hElements = document.querySelectorAll("h1, h2, h3, h4, h5, h6")



        for (var i = 0; i < hElements.length; i++) {
            if (theme == "light") {
                hElements[i].style.color = "#000";
            } else if (theme == "dark") {
                hElements[i].style.color = "#fff";
            }
        }
        return 'dark';
    };

    themeConfig.saveTheme = theme => {
        // custom logic
        console.log(darkSwitch);
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