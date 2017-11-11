PROCESS FOR ADDING NEW SVGS:

1. Edit separator-template.ai in Illustrator,
2. Make sure all layers have a name with the format: SEPARATOR_ID|SEPARATOR_NAME|SEPARATOR_HEIGHT
3. Make sure all layers are visible
4. Save As, format: SVG, 
5. Use SVG 1.1, Show more options, CSS Properties: Style Elements, then click OK
6. run -dev-process-svg.php in your browser or console: view-source:http://local.wordpress.dev/wp-content/plugins/row-separators/row_separators/lib/_DEV_processSvg.php