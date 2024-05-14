const fs = require('fs');
const path = require('path');

const dossierIcons = './';

// Obtenez tous les fichiers SVG dans le dossier
fs.readdir(dossierIcons, (err, files) => {
    if (err) {
        console.error('Erreur de lecture du dossier :', err);
        return;
    }

    // Filtrer les fichiers pour inclure uniquement les fichiers SVG
    const svgFiles = files.filter(file => path.extname(file).toLowerCase() === '.svg');

    // Générer le code HTML
    const htmlContent = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    margin: 20px;
                }
                h1 {
                    text-align: center;
                }
                #icons-container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                }
                .icon-container {
                    margin: 10px;
                    text-align: center;
                }
                .icon-container object {
                    width: 100px;
                    height: 100px;
                }
                .icon-name {
                    margin-top: 5px;
                }
            </style>
            <title>Icons Viewer</title>
        </head>
        <body>
        
            <h1>Icons Viewer</h1>
            
            <div id="icons-container">
                ${svgFiles.map(file => `
                    <div class="icon-container">
                        <object type="image/svg+xml" data="${dossierIcons}${file}"></object>
                        <div class="icon-name">${path.parse(file).name}</div>
                    </div>`).join('\n')}
            </div>
        
        </body>
        </html>
    `;

    // Écrire le contenu dans un fichier HTML
    fs.writeFile('iconsViewer.html', htmlContent, (err) => {
        if (err) {
            console.error('Erreur d\'écriture du fichier HTML :', err);
        } else {
            console.log('Fichier HTML généré avec succès : iconsViewer.html');
        }
    });
});