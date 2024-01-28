document.addEventListener('DOMContentLoaded', function() {
    let dropArea = document.getElementById('drop-area');
    let fileInput = document.getElementById('fileElem');
  
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, preventDefaults, false);
    });
  
    ['dragenter', 'dragover'].forEach(eventName => {
      dropArea.addEventListener(eventName, highlight, false);
    });
  
    ['dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, unhighlight, false);
    });
  
    dropArea.addEventListener('drop', handleDrop, false);
    fileInput.addEventListener('change', function(e) {
      handleFiles(this.files);
    });
  
    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }
  
    function highlight() {
      dropArea.classList.add('highlight');
    }
  
    function unhighlight() {
      dropArea.classList.remove('highlight');
    }
  
    function handleDrop(e) {
      let dt = e.dataTransfer;
      let files = dt.files;
      handleFiles(files);
    }
  
    function handleFiles(files) {
      files = [...files];
      if (files.length + document.getElementById('gallery').children.length > 20) {
        alert('Vous ne pouvez pas ajouter plus de 20 photos.');
        return;
      }
      files.forEach(previewFile);
    }
  
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
        deleteBtn.addEventListener('click', function() {
          div.remove();
        });
  
        div.appendChild(img);
        div.appendChild(deleteBtn);
        
        document.getElementById('gallery').appendChild(div);
      };
    }
  });