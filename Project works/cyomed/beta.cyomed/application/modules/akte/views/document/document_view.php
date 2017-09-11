
  <div id="fileManager"></div>

  <script type="text/javascript">

    $(document).ready(function() {
       $('#fileManager').elfinder({
          resizable: false,
          url : $.siteUrl + '/akte/document/connector',  // connector URL (REQUIRED)
          uiOptions : {
            toolbar : [
              ['back', 'forward', 'up', 'home', 'reload'],
              ['mkdir', 'mkfile', 'upload'],
              // ['copy', 'cut', 'paste'],
              // ['open', 'download', 'getfile'],
              // ['info'],
              // ['quicklook'],
              // ['rm'],
              // ['duplicate', 'rename', 'edit', 'resize'],
              // ['extract', 'archive'],
              ['view', 'sort'],
              // ['help'],
              ['search'],
            ]
          },
          height: 500 
       });
       
       $('.elfinder-cwd-wrapper, .elfinder-navbar').niceScroll();
    });

  </script>