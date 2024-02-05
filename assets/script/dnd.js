// Système de drag and drop sur la page raconte.tpl
document.addEventListener('DOMContentLoaded', function() {
  // Sélection des éléments de la zone de dépôt et de l'entrée de fichier
  let dropArea = document.getElementById('drop-area');
  let fileInput = document.getElementById('fileElem');

  // Empêche les comportements par défaut pour éviter les conflits avec le dnd
  ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
  });

  // Met en évidence la zone de dépôt lorsqu'un fichier est survolé
  ['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
  });

  // Enlève la mise en évidence lorsque les fichiers sont déplacés ou déposés
  ['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
  });

  // Gère le dépôt de fichiers
  dropArea.addEventListener('drop', handleDrop, false);
  // Gère la sélection de fichiers via l'interface utilisateur
  fileInput.addEventListener('change', function(event) {
    handleFiles(this.files);
  });

  // Fonctions pour le traitement des événements
  function preventDefaults(event) {
    event.preventDefault();
    event.stopPropagation();
  }
  
  function highlight() {
    dropArea.classList.add('highlight');
  }
  
  function unhighlight() {
    dropArea.classList.remove('highlight');
  }
  
  // Traite les fichiers déposés, préparant pour la lecture ou le téléversement
  function handleDrop(event) {
    let files = event.dataTransfer.files;
    handleFiles(files);
  }
  
  // Vérifie la limite de fichiers et crée des prévisualisations pour les fichiers sélectionnés
  function handleFiles(files) {
    files = [...files];
    if (files.length + document.getElementById('gallery').children.length > 20) {
      alert('Vous ne pouvez pas ajouter plus de 20 photos.');
      return;
    }
    files.forEach(previewFile);
  }
  
  // Génère une prévisualisation d'image et un bouton de suppression pour chaque fichier
  function previewFile(file) {
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = function() {
      let img = document.createElement('img');
      img.src = reader.result;
      
      let div = document.createElement('div');
      div.classList.add('image-container');

      let deleteBtn = document.createElement('button');
      deleteBtn.innerText = 'X';
      deleteBtn.classList.add('delete-btn');
      deleteBtn.addEventListener('click', function() { div.remove(); });

      div.appendChild(img);
      div.appendChild(deleteBtn);
      
      document.getElementById('gallery').appendChild(div);
    };
  }
});